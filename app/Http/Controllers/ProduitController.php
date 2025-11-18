<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ImageProduit;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\TypeProduits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::all();
        // $brands = Brand::all();
        return view('administration.produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = Category::all(); 
        // $typeproduits = TypeProduits::all(); 
        $typeproduits = TypeProduits::with('categories')->get(); 
        return view('administration.produits.create', compact('typeproduits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomproduit'     => 'required|string|max:255',
            'imgproduit'     => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories'   => 'required|exists:categories,id',
            'prix'           => 'required|numeric|min:0',
            'stock'          => 'integer|min:0',
            'sku'            => 'nullable|string|max:255',
            'description'    => 'required|string',
        ]);

         // Génération du slug à partir du nom
        $slug = Str::slug($request->nomproduit);

        // Vérifie l'unicité du slug (ajout d'un suffixe si nécessaire)
        $originalSlug = $slug;
        $counter = 1;
        while (Produit::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }


        // Upload de l'image
        if($request->has('imgproduit'))
        {
            $file = $request->file('imgproduit');
            $extension = $file->getClientOriginalExtension();

            $imagePath = "produits_".time().'.'.$extension;
            $file->move('uploads/produits/', $imagePath);
        }

        // dd($all_products);

        // Enregistrement du produit principal
        $produit = Produit::create([
            'name' => $request->nomproduit,
            'slug' => $slug,
            'sku' => $request->sku,
            'description' => $request->description,
            'image_principale' => $imagePath,
            'categorie_id' => $request->categories,
            'prix' => $request->prix,
        ]);

        

        // Images secondaires
        if ($request->hasFile('images')) {

            $images = $request->file('images');

            // Limiter à 3 images maximum
            $images = array_slice($images, 0, 3);

            foreach ($request->file('images') as $image) {


                $extension = $image->getClientOriginalExtension();
                $imageName = 'image_' . time() . '_' . uniqid() . '.' . $extension;
                 // Déplacement dans public/uploads/produit_images/
                $image->move(public_path('uploads/produit_images/'), $imageName);
                $chemin = 'uploads/produit_images/' . $imageName;

                ImageProduit::create([
                    'produit_id' => $produit->id,
                    'chemin_image' => $chemin,
                ]);
            }
        }

        // Enregistrer la quantité dans la table "stocks"
        Stock::create([
            'produit_id' => $produit->id,
            'quantité' => $request->stock, // Par exemple 10
            'mouvement' => 'ajout'
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit enregistré avec succès.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        return view('administration.produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        // $brands = Brand::all();
        $categories = Category::all(); 
        $typeproduits = TypeProduits::with('categories')->get(); 

        return view('administration.produits.edit', compact('produit', 'typeproduits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nomproduit'     => 'required|string|max:255',
            'imgproduit'     => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories'   => 'required|exists:categories,id',
            'prix'           => 'required|numeric|min:0',
            'stock'          => 'integer|min:0',
            'sku'            => 'nullable|string|max:255',
            'description'    => 'required|string',
        ]);

        // Mise à jour du slug uniquement si le nom change
        if ($produit->name !== $request->nomproduit) {
            $slug = Str::slug($request->nomproduit);
            $originalSlug = $slug;
            $counter = 1;
            while (Produit::where('slug', $slug)->where('id', '!=', $produit->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            $produit->slug = $slug;
        }

        // Gestion de l’image
        if ($request->hasFile('imgproduit')) {
            $file = $request->file('imgproduit');
            $extension = $file->getClientOriginalExtension();
            $imagePath = "produits_" . time() . '.' . $extension;
            $file->move('uploads/produits/', $imagePath);
            $produit->image_principale = $imagePath;
        }else {
            // Si aucune image n'est téléchargée, garder l'ancienne image
            $imagePath = $produit->image;
        }

        // Mise à jour des autres champs
        $produit->update([
            'name' => $request->nomproduit,
            'sku' => $request->sku,
            'description' => $request->description,
            'categorie_id' => $request->categories,
            'prix' => $request->prix,
        ]);

        // Mise à jour du stock
        $stock = Stock::where('produit_id', $produit->id)->latest()->first();
        if ($stock && $stock->quantité != $request->stock) {
            Stock::create([
                'produit_id' => $produit->id,
                'quantité' => $request->stock,
                'mouvement' => 'modification'
            ]);
        }

        // Ajout d’images secondaires (facultatif)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $chemin = $image->store('produits', 'public');
                ImageProduit::create([
                    'produit_id' => $produit->id,
                    'chemin_image' => $chemin,
                ]);
            }
        }

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        // Supprimer les images secondaires
        foreach ($produit->images as $image) {
            // Optionnel : supprimer le fichier physique avec Storage::delete()
            $image->delete();
        }

        // Supprimer les stocks associés
        Stock::where('produit_id', $produit->id)->delete();

        // Supprimer le produit
        $produit->delete();

        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }

}
