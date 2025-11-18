<?php

namespace App\Http\Controllers;

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
        return view('home.panier.confirm_payment');
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
        $quantity = $request->input('quantity');

        $panier = session()->get('panier', []);

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

        return response()->json(['success' => true]);
    }

}
