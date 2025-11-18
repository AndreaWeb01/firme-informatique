<?php

namespace App\Http\Controllers;

use App\Models\TypeProduits;
use Illuminate\Http\Request;

class TypeProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeproduits = TypeProduits::all();

        return view('administration.typeproduits.index', compact('typeproduits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administration.typeproduits.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomtypeproduit'     => 'required|string|max:255',
        ]);

        //Enregistrement du produit principal
        TypeProduits::create([
            'Nom_TypeProduit' => $request->nomtypeproduit,
            ]);

        return redirect()->route('typeproduits.index')->with('success', 'Type Produit enregistré avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeProduits $typeProduits)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeProduits $typeProduits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeProduits $typeProduits)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeProduits $typeProduits)
    {
        //
    }
}
