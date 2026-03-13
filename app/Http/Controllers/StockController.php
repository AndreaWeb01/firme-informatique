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
        $stocks = Stock::with('produit')->latest()->get();

        $stockActuelParProduit = Stock::query()
            ->selectRaw('produit_id, SUM(quantité) as stock_actuel')
            ->groupBy('produit_id')
            ->pluck('stock_actuel', 'produit_id');

        return view('administration.stocks.index', compact('stocks', 'stockActuelParProduit'));
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

        return redirect()
            ->route('stocks.index')
            ->with('status', 'Stock ajouté avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        $produits = Produit::all();

        return view('administration.stocks.edit', compact('stock', 'produits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantité' => 'required|integer|min:1',
            'mouvement' => 'required|string|max:255',
        ]);

        $stock->update([
            'produit_id' => $request->input('produit_id'),
            'quantité'   => $request->input('quantité'),
            'mouvement'  => $request->input('mouvement'),
        ]);

        return redirect()
            ->route('stocks.index')
            ->with('status', 'Stock mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return redirect()
            ->route('stocks.index')
            ->with('status', 'Stock supprimé avec succès.');
    }
}
