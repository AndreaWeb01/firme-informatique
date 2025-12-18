<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::all();
        return view('administration.stocks.index', compact('stocks'));
    }
    public function create()
    {
        $produits = Produit::all();
        return view('administration.stocks.create', compact('produits'));   
    }
    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantité' => 'required|integer|min:1',
        ]);

        Stock::create([
            'produit_id' => $request->input('produit_id'),
            'quantité' => $request->input('quantité'),
            'mouvement' => $request->input('mouvement'),
        ]);
        return redirect()->route('stocks.index')->with('success', 'Stock ajouté avec succès.');
    }
}
