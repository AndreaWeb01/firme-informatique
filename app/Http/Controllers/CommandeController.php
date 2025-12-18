<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeItem;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommandeController extends Controller
{
    private $statutsLisibles = [
        'en_attente'     => 'En attente',
        'en_preparation' => 'En préparation',
        'expediee'       => 'Expédiée',
        'livree'         => 'Livrée',
        'annulee'        => 'Annulée'
    ];

    private $badgeColors = [
        'en_attente'     => 'secondary',
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

        $panier = session()->get('panier', []);
        if (empty($panier)) {
            return back()->with('error', 'Le panier est vide.');
        }
       

        $total = collect($panier)->sum(fn ($item) => $item['prix'] * $item['quantity']);

        // Création commande
        $commande = Commande::create([
            'user_id' => auth()->id()?? null, // un nom ≠ ID utilisateur
            'numero_commande' => 'CMD-' . Str::upper(Str::random(10)),
            'montant_total' => $total,
            'statut' => 'en_attente',
            'mode_paiement' => $request->mode_paiement ?? 'mobile_money',
            'adresse_livraison' => $request->adresse_livraison,
            'ville' => $request->ville,
            'numero' => $request->numero,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'notes' => $request->notes,
        ]);

        // Items du panier
        foreach ($panier as $item) {
            if (!Produit::find($item['id'])) {
                continue; // sécurité
            }

            CommandeItem::create([
                'commande_id' => $commande->id,
                'produit_id' => $item['id'],
                'quantite' => $item['quantity'],
                'prix_unitaire' => $item['prix'],
                'total' => $item['prix'] * $item['quantity'],
            ]);
        }

        session()->forget('panier');

        return redirect()
            ->route('commandes.show', $commande->id)
            ->with('success', 'Commande passée avec succès !');
    }

    public function changerStatut(Request $request, Commande $commande)
    {
        if ($commande->statut == 'annulee' || $commande->statut == 'livree') {
            return back()->with('error', 'Impossible de modifier le statut d\'une commande annulée ou livrée.');    
        }
        
        $request->validate([
            'statut' => 'required|in:en_attente,en_preparation,expediee,livree,annulee',
        ]);

        $commande->update([
            'statut' => $request->statut,
        ]);

        return redirect()->back()->with('success', 'Statut mis à jour !');
    }
}
