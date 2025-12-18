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
        $produits = Produit::where('name', 'LIKE', '%' . $term . '%')
            ->orWhere('description', 'LIKE', '%' . $term . '%')
            ->limit(5)
            ->get(['id', 'slug', 'name']);

        $conseils = Conseils::where('titre', 'LIKE', '%' . $term . '%')
            ->orWhere('description', 'LIKE', '%' . $term . '%')
            ->limit(5)
            ->get(['id', 'slug', 'titre']);
            
           
            $results = $produits
            ->concat($conseils)
            ->values();
            
            return response()->json($results);

    }
}
