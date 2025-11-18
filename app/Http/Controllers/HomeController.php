<?php

namespace App\Http\Controllers;

use App\Models\Conseils;
use App\Models\Devis;
use App\Models\Produit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function accueil()
    {
        $conseilsRecents = Conseils::where('statut', true)->latest()->take(3)->get(); 
        $productsRecents = Produit::where('statut', true)->latest()->take(5)->get(); 
        
        // return view('home.accueil');
        return view('home.accueil', compact('conseilsRecents', 'productsRecents'));
    }

    public function boutique()
    {
        $allproducts = Produit::all();
        return view('home.boutique', compact('allproducts'));
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
        $devis->prenom = $request->nom;
        $devis->email = $request->nom;
        $devis->telephone = $request->telephone;
        $devis->service = $request->digit;
        $devis->besoin = $request->besoin;
        $devis->save();

        // dd($request->all());

        return redirect()->back()->with('success', 'Formulaire envoyé avec succès !');
    }

    public function accessoiresmaterielinfo()
    {
        return view('home.boutique.accessoiresmaterielinfo');
    }

    public function materielinfo()
    {
        return view('home.boutique.materielinfo');

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


}
