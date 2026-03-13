<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function afficher()
    {
        return view('home.panier.detail'); // Ce fichier sera resources/views/panier/detail.blade.php
    }

    public function confirm_pay()
    {
        // Récupération similaires aux autres pages
        if (auth()->check()) {
            $userId = auth()->id();
            $recentlyViewed = \App\Models\RecentlyViewed::where('user_id', $userId)
                ->latest()
                ->take(5)
                ->with('produit')
                ->get();
        } else {
            $views = session()->get('recently_viewed', []);
            $recentProducts = \App\Models\Produit::whereIn('id', $views)->get();
            $recentlyViewed = $recentProducts->map(fn($p) => (object)['produit' => $p]);
        }

        return view('home.panier.confirm_payment', compact('recentlyViewed'));
    }



    // Supprimer un produit du panier
    public function supprimer(Request $request)
    {
        $id = $request->input('id');
        $panier = session()->get('panier', []);

        $panier = array_filter($panier, function ($item) use ($id) {
            return $item['id'] != $id;
        });

        session()->put('panier', array_values($panier)); // réindexer le tableau
        return response()->json(['success' => true]);
    }

    // public function ajouter(Request $request)
    // {

    // }

    // public function afficher()
    // {

    // }


    // Mettre à jour la quantité d’un produit
    public function mettreAJourQuantite(Request $request)
    {
        $id = $request->input('id');
        $quantity = (int) $request->input('quantity');

        $panier = session()->get('panier', []);

        $stockActuel = (int) Stock::where('produit_id', $id)->sum('quantité');

        // Si plus de stock: on retire du panier
        if ($stockActuel <= 0) {
            $panier = array_filter($panier, fn ($item) => $item['id'] != $id);
            session()->put('panier', array_values($panier));

            return response()->json([
                'success' => false,
                'message' => "Stock indisponible pour ce produit.",
                'stock' => $stockActuel,
                'quantity' => 0,
            ], 409);
        }

        // Clamp à [1..stockActuel]
        if ($quantity < 1) {
            $quantity = 1;
        }
        if ($quantity > $stockActuel) {
            $quantity = $stockActuel;
        }

        // Mise à jour avec un foreach
        foreach ($panier as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] = $quantity; // Ajoute ou met à jour la quantité
                break;
            }
        }

        session()->put('panier', $panier);

        // Log::info("Après mise à jour :", $panier);

        // Log::info("Mise à jour panier : ID $id => $quantity");
        // Log::info("Avant :", $panier);

        // if (isset($panier[$id])) {
        //     $panier[$id]['quantity'] = $quantity;
        //     session()->put('panier', $panier);
        //     Log::info("Après :", $panier);
        // }

        return response()->json([
            'success' => true,
            'stock' => $stockActuel,
            'quantity' => $quantity,
        ]);
    }

}
