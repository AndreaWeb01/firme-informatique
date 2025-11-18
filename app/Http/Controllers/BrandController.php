<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'nommarque' => 'required|string|max:255',
            'description' => 'nullable|string',
            'imgmarque' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Enregistrer la marque
        $marque = new Brand();
        $marque->nom = $request->nommarque;
        $marque->description = $request->description;

        // Gérer l'upload du logo si présent
        if ($request->hasFile('imgmarque')) {

            $file = $request->file('imgmarque');
            $extension = $file->getClientOriginalExtension();

            $imagename = "brands_".time().'.'.$extension;
            $file->move('uploads/brands/', $imagename);

            $marque->logo = $imagename;
        }

        $marque->save();

        return redirect()->route('produits.create')->with('success', 'Marque enregistrée avec succès.');
    }
}
