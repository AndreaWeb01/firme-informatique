<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeItem;
use App\Models\Produit;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CommandeController extends Controller
{
    private $statutsLisibles = [
        'en_attente'     => 'En attente',
        'payee'          => 'Payée',
        'en_preparation' => 'En préparation',
        'expediee'       => 'Expédiée',
        'livree'         => 'Livrée',
        'annulee'        => 'Annulée'
    ];

    private $badgeColors = [
        'en_attente'     => 'secondary',
        'payee'          => 'primary',
        'en_preparation' => 'warning',
        'expediee'       => 'info',
        'livree'         => 'success',
        'annulee'        => 'danger'
    ];

    public function index()
    {
        $commandes = Commande::with('user')->get();

        return view('administration.commande.index', [
            'commandes'        => $commandes,
            'statutsLisibles'  => $this->statutsLisibles,
            'badgeColors'      => $this->badgeColors,
        ]);
    }

    public function show($numero_commande)
    {
       $commande = Commande::where('numero_commande', $numero_commande)->firstOrFail();

        return view('administration.commande.show', [
            'commande'        => $commande,
            'statutsLisibles' => $this->statutsLisibles,
            'badgeColors'     => $this->badgeColors,
        ]);
    }

    public function validerPanier(Request $request)
    {
        $request->validate([
            'mode_paiement' => 'nullable|string|max:50',
            'adresse_livraison' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'numero' => 'required|string|max:50',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $panier = session()->get('panier', []);
        if (empty($panier)) {
            return back()->with('error', 'Le panier est vide.');
        }

        try {
            $commande = DB::transaction(function () use ($panier, $request) {
                $erreursStock = [];

                foreach ($panier as $item) {
                    $produitId = (int) ($item['id'] ?? 0);
                    $quantiteDemandee = (int) ($item['quantity'] ?? 0);
                    if ($produitId <= 0 || $quantiteDemandee <= 0) {
                        continue;
                    }

                    $produit = Produit::find($produitId);
                    if (!$produit) {
                        continue;
                    }

                    // Stock actuel = somme des mouvements (entrées positives / sorties négatives)
                    $stockActuel = (int) $produit->stocks()->lockForUpdate()->sum('quantité');
                    if ($quantiteDemandee > $stockActuel) {
                        $erreursStock[] = "Stock insuffisant pour {$produit->name} (disponible: {$stockActuel}, demandé: {$quantiteDemandee}).";
                    }
                }

                if (!empty($erreursStock)) {
                    throw ValidationException::withMessages([
                        'stock' => $erreursStock,
                    ]);
                }

                $total = collect($panier)->sum(fn ($item) => ((float) ($item['prix'] ?? 0)) * ((int) ($item['quantity'] ?? 0)));

                // Détermination du statut en fonction du type de commande
                $typeCommande = $request->input('type_commande');
                $statut = $typeCommande === 'livraison' ? 'en_attente' : 'payee';

                // Mode de paiement : si paiement à la livraison, on stocke une valeur explicite
                $modePaiement = $typeCommande === 'livraison'
                    ? 'paiement_a_la_livraison'
                    : ($request->mode_paiement ?? 'mobile_money');

                // Création commande
                $commande = Commande::create([
                    'user_id' => auth()->id() ?? null,
                    'numero_commande' => 'CMD-' . Str::upper(Str::random(10)),
                    'montant_total' => $total,
                    'statut' => $statut,
                    'mode_paiement' => $modePaiement,
                    'adresse_livraison' => $request->adresse_livraison,
                    'ville' => $request->ville,
                    'numero' => $request->numero,
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'notes' => $request->notes,
                ]);

                // Items du panier
                foreach ($panier as $item) {
                    $produitId = (int) ($item['id'] ?? 0);
                    $quantite = (int) ($item['quantity'] ?? 0);
                    if ($produitId <= 0 || $quantite <= 0) {
                        continue;
                    }

                    if (!Produit::find($produitId)) {
                        continue; // sécurité
                    }

                    $prix = (float) ($item['prix'] ?? 0);

                    CommandeItem::create([
                        'commande_id' => $commande->id,
                        'produit_id' => $produitId,
                        'quantite' => $quantite,
                        'prix_unitaire' => $prix,
                        'total' => $prix * $quantite,
                    ]);
                }

                // Décrémentation du stock pour chaque produit commandé
                $this->decrementerStockCommande($commande);

                return $commande;
            }, 3);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        session()->forget('panier');

        return redirect()
            ->route('mescommandes')
            ->with('success', 'Commande enregistrée avec succès ! Numéro : ' . $commande->numero_commande);

    }

    public function changerStatut(Request $request, Commande $commande)
    {
        if ($commande->statut == 'annulee' || $commande->statut == 'livree') {
            return back()->with('error', 'Impossible de modifier le statut d\'une commande annulée ou livrée.');
        }

        $request->validate([
            'statut' => 'required|in:en_attente,payee,en_preparation,expediee,livree,annulee',
        ]);

        $commande->update([
            'statut' => $request->statut,
        ]);

        return redirect()->back()->with('success', 'Statut mis à jour !');
    }

    /**
     * Décrémente le stock des produits pour une commande validée.
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
