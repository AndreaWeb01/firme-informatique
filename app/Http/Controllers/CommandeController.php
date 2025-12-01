<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeItem;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommandeController extends Controller
{
    public function index()
    {
         $statutsLisibles = [
    'en_attente' => 'En attente',
    'en_preparation' => 'En préparation',
    'expediee' => 'Expédiée',
    'livree' => 'Livrée',
    'annulee' => 'Annulée'
];

$badgeColors = [
    'en_attente' => 'secondary',
    'en_preparation' => 'warning',
    'expediee' => 'info',
    'livree' => 'success',
    'annulee' => 'danger'
];
        $commandes = Commande::with('user')->get();
        return view('administration.commande.index', compact('commandes', 'statutsLisibles', 'badgeColors'));
    }

    public function show($id)
    {
        $commande = Commande::with('user', 'items.produit')->findOrFail($id);
        return view('administration.commande.show', compact('commande', 'statutsLisibles', 'badgeColors'));
    }

    public function validerPanier(Request $request)
    {
        $panier = session()->get('panier', []);

        if (empty($panier)) {
            return back()->with('error', 'Le panier est vide.');
        }

        // Calcul du montant total
        $total = 0;
        foreach ($panier as $item) {
            $total += $item['prix'] * $item['quantity'];
        }

        // Création de la commande
        $commande = Commande::create([
            'user_id' => auth()->id() ?? $request->nom,  
            'numero_commande' => 'CMD-' . strtoupper(uniqid()),
            'montant_total' => $total,
            'statut' => 'en_attente',
            'mode_paiement' => $request->mode_paiement ?? 'mobile_money',
            'adresse_livraison' => $request->adresse_livraison,
            'ville' => $request->ville,
            'telephone' => $request->telephone,
            'notes' => $request->notes,
        ]);

        // Créer les items
        foreach ($panier as $item) {
            CommandeItem::create([
                'commande_id' => $commande->id,
                'produit_id' => $item['id'],
                'quantite' => $item['quantity'],
                'prix_unitaire' => $item['prix'],
                'total' => $item['prix'] * $item['quantity'],
            ]);
        }

        // Vider le panier
        session()->forget('panier');

        return redirect()
            ->route('commandes.show', $commande->id)
            ->with('success', 'Commande passée avec succès !');
    }
 
public function changerStatut(Request $request, Commande $commande)
{
    $request->validate([
        'statut' => 'required|in:en_attente,en_preparation,expediee,livree,annulee',
    ]);
   

    $commande->statut = $request->statut;
    $commande->updated_at = now();
    $commande->save();

    return redirect()->back()->with('success', 'Statut mis à jour !');
}

    
}
