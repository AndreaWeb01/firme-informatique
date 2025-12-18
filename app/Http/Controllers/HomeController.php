<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Commande;
use App\Models\Conseils;

use App\Models\Devis;
use App\Models\Produit;
use App\Models\RecentlyViewed;
use App\Models\TypeProduits;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function accueil()
    {
        $conseilsRecents = Conseils::where('statut', true)->latest()->take(3)->get();
        $productsRecents = Produit::where('statut', true)->latest()->take(5)->get();
        $categories = Category::all();
        $type = TypeProduits::with('categories')->get();
        // return view('home.accueil');
        return view('home.accueil', compact('conseilsRecents', 'productsRecents', 'categories', 'type'));  
    }
    public function boutique()
    {
        $types = TypeProduits::with('categories')->get();
        $allproducts = Produit::with('categorie')->get();
        $categories = Category::all();
        return view('home.boutique', compact('types', 'allproducts', 'categories'));
    }
    public function filterAjax($id)
    {
        if ($id === 'all') {
            $products = Produit::all();
        } else {
            // Récupérer les catégories du type
            $categoryIds = Category::where('ID_TypeProduit', $id)->pluck('id');

            // Récupérer les produits appartenant à ces catégories
            $products = Produit::whereIn('categorie_id', $categoryIds)->get();
        }

        $categories = Category::all();

        return view('home.partials.products', compact('products', 'categories'))->render();
    }

    public function filterByCategory($id)
    {
        // Filtrer les produits par catégorie
        $products = Produit::where('categorie_id', $id)->get();
        $categories = Category::all();

        return view('home.partials.products', compact('products', 'categories'))->render();
    }
    public function filterCombined(Request $request)
    {
        $typeId = $request->get('type_id');
        $categoryId = $request->get('category_id');
        
        $query = Produit::query();
        
        if ($typeId && $typeId !== 'all') {
            $categoryIds = Category::where('ID_TypeProduit', $typeId)->pluck('id');
            $query->whereIn('categorie_id', $categoryIds);
        }
        
        if ($categoryId && $categoryId !== 'all') {
            $query->where('categorie_id', $categoryId);
        }
        
        $products = $query->get();
        $categories = Category::all();
        
        return view('home.partials.products', compact('products', 'categories'))->render();
    }
    public function search(Request $request)
    {
        $query = Produit::query();

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $produits = $query->select('id', 'name as nom', 'prix', 'image_principale as image', 'slug')
            ->take(10)->get();

        return response()->json($produits);
    }


    public function descriptionProduit($slug, $id)
{
 /*   $userId = auth()->id()?? null; // Assurez-vous que l'utilisateur est connecté

    // Enregistrer le produit comme récemment vu
    RecentlyViewed::updateOrCreate(
        ['user_id' => $userId, 'produit_id' => $id],
        ['created_at' => now()] // Optionnel : mise à jour de la date
    );
*/
    // Récupérer le produit
    $produit = Produit::where('slug', $slug)->firstOrFail();
    $produits = RecentlyViewed::
        with('produit') // Charger les détails du produit
        ->get();
   

    return view('home.descriptionproduit', compact('produit', 'produits'));
}


    public function about()
    {
        return view('home.apropos');
    }

    public function conseils()
    {
        $conseils = Conseils::all();
        return view('home.conseils', compact('conseils'));
    }

    public function conseilshow($slug)
    {
        $conseilsRecents = Conseils::where('statut', true)->latest()->take(3)->get();

        // Récupérer l'article par son slug
        $conseil = Conseils::where('slug', $slug)->firstOrFail();

        // Retourner la vue avec l'article
        return view('home.conseilshow', compact('conseil', 'conseilsRecents'));
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function contact_store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'required|string|max:20',
            'digit' => 'required|string',
            'besoin' => 'required|string',
        ]);

        $devis = new Devis();
        $devis->nom = $request->nom;
        $devis->prenom = $request->prenom;
        $devis->email = $request->email;
        $devis->telephone = $request->telephone;
        $devis->service = $request->digit;
        $devis->besoin = $request->besoin;
        $devis->save();

        // dd($request->all());

        return redirect()->back()->with('success', 'Formulaire envoyé avec succès !');
    }

    public function accessoiresmaterielinfo($Id = null)
    {
        // Charger tous les types pour l'affichage des filtres
        $types = TypeProduits::with('categories')->get();
        // Déterminer le type sélectionné (paramètre ou premier type disponible)
        $selectedTypeId = $Id ?? ($types->first()->id ?? null);
        // Récupérer les produits liés au type sélectionné
        $accessoires = collect();
        if ($selectedTypeId) {
            // récupérer les catégories liées au type (colonne: ID_TypeProduit)
            $categoryIds = Category::where('ID_TypeProduit', $selectedTypeId)->pluck('id');
            // récupérer les produits appartenant à ces catégories
            $accessoires = Produit::whereIn('categorie_id', $categoryIds)->get();
        }
        // Toutes les catégories (pour affichage éventuel)
        $categories = Category::all();

        return view('home.boutique.accessoiresmaterielinfo', compact('types', 'accessoires', 'categories'));
    }

    public function materielinfo()
    {
        // Page de présentation du matériel informatique
        return view('home.boutique.materielinfo');
    }

    public function solution($Id = null)
    {
        // Charger les types et calculer les produits liés au type sélectionné
        $types = TypeProduits::with('categories')->get();
        $selectedTypeId = $Id ?? ($types->first()->id ?? null);

        $solutions = collect();
        if ($selectedTypeId) {
            $categoryIds = Category::where('ID_TypeProduit', $selectedTypeId)->pluck('id');
            $solutions = Produit::whereIn('categorie_id', $categoryIds)->get();
        }

        $categories = Category::all();

        return view('home.boutique.solution', compact('solutions', 'categories', 'types', 'selectedTypeId'));
    }

    public function installationcamera()
    {
        return view('home.services.installationcamera');
    }

    public function maintenance()
    {
        return view('home.services.maintenance');
    }


    public function cablage()
    {
        $conseilsRecents = Conseils::where('statut', true)->latest()->take(3)->get();

        return view('home.services.cablage', compact('conseilsRecents'));
    }

    public function dashboard()
    {
        $userId = auth()->id(); // Assurez-vous que l'utilisateur est connecté
        // Récupérer les produits récemment vus
        $recentlyViewedProducts = RecentlyViewed::where('user_id', $userId)
            ->latest() // Trier par date de consultation
            ->take(5) // Afficher les 5 derniers produits vus
            ->pluck('produit_id'); // Récupérer uniquement les IDs des produits
        // Récupérer les détails des produits
        $products = Produit::whereIn('id', $recentlyViewedProducts)->get();
        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à vos commandes.');
        }
        $commandes = Commande::where('user_id', auth()->user()->id)->get();
        return view('dashboard', compact('commandes', 'products'));
    }
    public function detailcommande($numero_commande)
    {
        $commande = Commande::where('numero_commande', $numero_commande)->firstOrFail();
        return view('home.detailcommande', compact('commande'));
    }   
}
