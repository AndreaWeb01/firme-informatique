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
    public function boutique(Request $request)
    {
        $types = TypeProduits::with('categories')->get();

        // Recherche éventuelle transmise par le header (paramètre q)
        $search = $request->get('q');

        $productsQuery = Produit::with('categorie');
        if ($search) {
            $productsQuery->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('description', 'LIKE', '%' . $search . '%');
            });
        }
        $products = $productsQuery->get();
        $categories = Category::all();
        // Catégorie sélectionnée par défaut : "all"
        $selectedCategoryId = 'all';

        // Récupérer les produits récemment vus (utilisateur ou session)
        if (auth()->check()) {
            $userId = auth()->id();
            $recentlyViewed = RecentlyViewed::where('user_id', $userId)
                ->latest()
                ->take(5)
                ->with('produit')
                ->get();
        } else {
            $views = session()->get('recently_viewed', []);
            $recentProducts = Produit::whereIn('id', $views)->get();
            $recentlyViewed = $recentProducts->map(fn($p) => (object)['produit' => $p]);
        }

        // Sur la page principale, on masque le bloc "Catégories" (il s'affichera après clic sur un type)
        $showCategories = false;

        return view('home.boutique', compact('types', 'products', 'categories', 'recentlyViewed', 'selectedCategoryId', 'showCategories'));
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
        $selectedCategoryId = $id;

        $showCategories = true;

        return view('home.partials.products', compact('products', 'categories', 'selectedCategoryId', 'showCategories'))->render();
    }
    public function filterCombined(Request $request)
    {
        $typeId = $request->get('type_id');
        $categoryId = $request->get('category_id');

        $query = Produit::query();

        if ($typeId && $typeId !== 'all') {
            $categoryIds = Category::where('ID_TypeProduit', $typeId)->pluck('id');
            $query->whereIn('categorie_id', $categoryIds);
            // Ne garder que les catégories du type sélectionné
            $categories = Category::where('ID_TypeProduit', $typeId)->get();
        } else {
            // Aucun type précis : toutes les catégories restent visibles
            $categories = Category::all();
        }

        if ($categoryId && $categoryId !== 'all') {
            $query->where('categorie_id', $categoryId);
        }

        $products = $query->get();
        // Si aucune catégorie précise, on reste sur "all"
        $selectedCategoryId = $categoryId ?: 'all';

        return view('home.partials.products', compact('products', 'categories', 'selectedCategoryId'))->render();
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
    // Récupérer le produit principal
    $produit = Produit::where('slug', $slug)->firstOrFail();

    // Gestion des produits récemment vus selon l'utilisateur (ou session)
    if (auth()->check()) {
        $userId = auth()->id();
        // insert/update
        RecentlyViewed::updateOrCreate(
            ['user_id' => $userId, 'produit_id' => $id],
            ['created_at' => now(), 'updated_at' => now()]
        );

        // récupérer les 5 derniers produits vus par l'utilisateur
        $produits = RecentlyViewed::where('user_id', $userId)
            ->latest()
            ->with('produit')
            ->take(5)
            ->get();
    } else {
        // invité : on enregistre l'id dans la session (liste FIFO de 5)
        $views = session()->get('recently_viewed', []);
        // retirer l'id si déjà présent pour le remettre en tête
        $views = array_filter($views, fn($v) => $v !== $id);
        array_unshift($views, $id);
        $views = array_slice($views, 0, 5);
        session()->put('recently_viewed', $views);

        $produits = Produit::whereIn('id', $views)->get()->map(function ($p) {
            return (object) ['produit' => $p];
        });
    }

    return view('home.descriptionproduit', compact('produit', 'produits'));
}


    public function about()
    {
        return view('home.apropos');
    }

    public function conseils()
    {
        $conseils = Conseils::where('statut', true)->latest()->get();
        return view('home.conseils', compact('conseils'));
    }

    public function conseilshow($slug)
    {
        $conseil = Conseils::where('slug', $slug)->firstOrFail();

        $conseilsRecents = Conseils::where('statut', true)
            ->where('id', '!=', $conseil->id)
            ->latest()
            ->take(3)
            ->get();

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

    /**
     * Show logged-in user's devis list
     */
    public function mesDevis()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à vos devis.');
        }

        $userEmail = auth()->user()->email;
        $devis = Devis::where('email', $userEmail)->get();

        return view('home.mesdevis', compact('devis'));
    }
    public function detailcommande($numero_commande)
    {
        $commande = Commande::where('numero_commande', $numero_commande)->firstOrFail();
        return view('home.detailcommande', compact('commande'));
    }
}
