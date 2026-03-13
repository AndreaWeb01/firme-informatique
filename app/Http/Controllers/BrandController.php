<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'nommarque' => 'required|string|max:255',
            'description' => 'nullable|string',
            'imgmarque' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $marque = new Brand();
        $marque->nom = $request->nommarque;
        $marque->description = $request->description;

        // Gérer l'upload du logo si présent
        if ($request->hasFile('imgmarque')) {
            $file = $request->file('imgmarque');
            $extension = $file->getClientOriginalExtension();
            $filename = "brands_" . time() . '_' . uniqid() . '.' . $extension;

            // Utiliser le disque 'public' pour stocker les fichiers
            $imagePath = $file->storeAs('brands', $filename, 'public');
            $marque->logo = $imagePath;
        }

        $marque->save();

        return redirect()->route('produits.create')->with('success', 'Marque enregistrée avec succès.');
    }
}
