<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Conseils;
use App\Models\Produit;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');
        $term = $query ?: null;

        if (!$query) {
            return response()->json([]);
        }
        // Recherche uniquement sur les produits de la boutique
        $produits = Produit::where('name', 'LIKE', '%' . $term . '%')
            ->orWhere('description', 'LIKE', '%' . $term . '%')
            ->limit(5)
            ->get(['id', 'slug', 'name']);

        return response()->json($produits->values());

    }
}
