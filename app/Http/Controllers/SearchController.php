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

        if (!$query) {
            return response()->json([]);
        }
        $produits = Produit::where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->limit(5)
            ->get(['id', 'slug', 'name']);

        $conseils = Conseils::where('titre', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->limit(5)
            ->get(['id', 'slug', 'titre']);
            
           
            $results = $produits
            ->concat($conseils)
            ->values(); // réindexer proprement
            
            return response()->json($results);

    }
}
