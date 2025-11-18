<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\TypeProduits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        // $categories = Category::all();
        $categories = Category::with('typeProduit')->get();
        return view('administration.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typesProduits = TypeProduits::all();
        return view('administration.categories.create', compact('typesProduits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomcategorie' => 'required|string',
            'typeproduit' => 'required|string',
        ]);

        $category = new Category();
        $category->Nom_Categorie = $request->nomcategorie;
        $category->slug = Str::slug($request->get('nomcategorie'),'-');
        $category->ID_TypeProduit = $request->typeproduit;
        $category->save();

        return redirect()->route('categories.index')->with('message', 'La categorie a été bien enregistré');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $subcategories = $category->subcategories;
        return view('administration.categories.show', compact('category', 'subcategories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('administration.categories.edit', compact('category'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nomcategorie' => 'required|string',
            'description' => 'string',
        ]);

        // Générer le slug à partir du titre
        $slug = Str::slug($request->nomcategorie);

        // Vérifier si le slug existe déjà dans la base de données
        $existingCategory = Category::where('slug', $slug)->where('id', '!=', $category->id)->first();  // Exclure la catégorie actuelle
        if ($existingCategory) {
            $slug = $slug . '-' . time();  // Ajouter un suffixe unique basé sur le timestamp
        }


        $category->name = $request->nomcategorie;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('categories.index')->with('message', 'La categorie a été bien enregistré');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('status', 'Categorie supprimé avec succès');
    }
}
