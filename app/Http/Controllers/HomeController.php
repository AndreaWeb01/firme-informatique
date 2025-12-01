<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Commande;
use App\Models\Conseils;
use App\Models\Devis;
use App\Models\Produit;
use App\Models\TypeProduits;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function accueil()
    {
        $conseilsRecents = Conseils::where('statut', true)->latest()->take(3)->get();
        $productsRecents = Produit::where('statut', true)->latest()->take(5)->get();
        $categories = Category::all();

        // return view('home.accueil');
        return view('home.accueil', compact('conseilsRecents', 'productsRecents', 'categories'));
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






    public function descriptionProduit($slug)
    {
        $produit = Produit::where('slug', $slug)->firstOrFail();
        return view('home.descriptionproduit', compact('produit'));
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

    public function accessoiresmaterielinfo()
    {
        $accessoires = Produit::get();
        $materiels = Produit::get();
        $types = TypeProduits::with('categories')->get();
        $categories = Category::all();
        return view('home.boutique.accessoiresmaterielinfo', compact('accessoires', 'materiels', 'categories', 'types'));
    }

    public function materielinfo()
    {
        $materiels = Produit::get();
        $categories = Category::all();
        return view('home.boutique.materielinfo', compact('materiels', 'categories'));    
    }

    public function solution()
    {
        return view('home.boutique.solution');
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
    public function mescommandes()
    {
        $commandes = Commande::where('user_id', auth()->user()->id)->get();
        return view('home.commande', compact('commandes'));
    }
    public function detailcommande($numero_commande)
    {
        $commande = Commande::where('numero_commande', $numero_commande)->firstOrFail();
        return view('home.detailcommande', compact('commande'));
    }   
}
