<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Commande;
use App\Models\Stock;
use App\Services\MoneyFusionService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // initiation via formulaire générique (hors commande)
    public function create(Request $request, MoneyFusionService $moneyFusion)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'phone'  => 'required|string',
            'name'   => 'required|string',
            'commande_id' => 'sometimes|exists:commandes,id',
        ]);

        $paymentData = [
            "totalPrice" => $request->amount,
            "numeroSend" => $request->phone,
            "nomclient"  => $request->name,
            "return_url" => route('payment.callback'),
            "webhook_url" => route('payment.webhook'),
        ];

        $response = $moneyFusion->createPayment($paymentData);

        if (!isset($response['statut']) || !$response['statut']) {
            return back()->with('error', 'Erreur lors de la création du paiement.');
        }

        // Sauvegarde en base
        $payment = Payment::create([
            'token'  => $response['token'],
            'amount' => $request->amount,
            'status' => 'pending',
            'commande_id' => $request->input('commande_id'),
        ]);

        return redirect($response['url']);
    }

    /**
     * Entrée pour une commande existante : /payer/{commande}
     */
    public function payer(
        \App\Models\Commande $commande,
        MoneyFusionService $moneyFusion
    ) {
        if ($commande->statut !== 'en_attente') {
            return redirect()->back()->with('error', 'Cette commande ne peut pas être payée.');
        }

        $paymentData = [
            "totalPrice" => $commande->montant_total,
            "numeroSend" => $commande->numero ?? ($commande->user?->phone ?? null),
            "nomclient"  => trim(($commande->nom ?? '') . ' ' . ($commande->prenom ?? '')),
            "return_url" => route('payment.callback'),
            "webhook_url" => route('payment.webhook'),
        ];

        $response = $moneyFusion->createPayment($paymentData);

        if (!isset($response['statut']) || !$response['statut']) {
            return redirect()->back()->with('error', 'Erreur lors de la création du paiement.');
        }

        // Sauvegarde en base avec lien vers commande
        Payment::create([
            'token'  => $response['token'],
            'amount' => $commande->montant_total,
            'status' => 'pending',
            'commande_id' => $commande->id,
        ]);

        return redirect($response['url']);
    }

    public function callback(Request $request, MoneyFusionService $moneyFusion)
    {
        $token = $request->tokenPay ?? $request->token ?? null;
        $payment = null;

        if ($token) {
            $payment = Payment::where('token', $token)->first();
            if ($payment) {
                $statusResp = $moneyFusion->checkPayment($token);
                $status = $statusResp['data']['status'] ?? null;
                if (in_array(strtolower($status), ['accepted', 'completed', 'success'])) {
                    $payment->update(['status' => 'paid']);
                    if ($payment->commande) {
                        $commande = $payment->commande;
                        $ancienStatut = $commande->statut;
                        $commande->update(['statut' => 'payee']);
                        if ($ancienStatut === 'en_attente') {
                            $this->decrementerStockCommande($commande);
                        }
                    }
                }
            }
        }

        return view('payment.status', ['payment' => $payment]);
    }

    public function webhook(Request $request)
    {
        $data = $request->all();

        $token = $data['tokenPay'] ?? null;
        $event = $data['event'] ?? null;

        if (!$token) {
            return response()->json(['error' => 'Token manquant'], 400);
        }

        $payment = Payment::where('token', $token)->first();

        if (!$payment) {
            return response()->json(['error' => 'Paiement introuvable'], 404);
        }

        if ($event === 'payin.session.completed') {
            $payment->update(['status' => 'paid']);
            if ($payment->commande) {
                $commande = $payment->commande;
                $ancienStatut = $commande->statut;
                $commande->update(['statut' => 'payee']);
                if ($ancienStatut === 'en_attente') {
                    $this->decrementerStockCommande($commande);
                }
            }
        }

        if ($event === 'payin.session.failed') {
            $payment->update(['status' => 'failed']);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Décrémente le stock des produits pour une commande validée (paiement reçu).
     * Enregistre un mouvement de sortie (quantité négative) pour chaque ligne de commande.
     */
    private function decrementerStockCommande(Commande $commande): void
    {
        $commande->load('items');

        foreach ($commande->items as $item) {
            Stock::create([
                'produit_id' => $item->produit_id,
                'quantité'   => -$item->quantite,
                'mouvement'  => 'Vente - ' . $commande->numero_commande,
            ]);
        }
    }
}
