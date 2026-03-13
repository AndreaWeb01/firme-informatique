<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'motdepasse' => 'required|min:8|confirmed',
            'role' => 'required|in:administrateur,client',
        ]);

        $user = User::create([
            'name' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->motdepasse),

        ]);

        // Assigner le rôle à l'utilisateur (utilise le guard par défaut "administrateur")
        $user->assignRole($request->role);

        // redirection selon le rôle attribué
        if ($user->hasRole('administrateur')) {
            return redirect()->route('admin.dashboard');
        }

        // rediriger vers la page d'accueil publique
        return redirect()->route('accueil');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function loginstore(\App\Http\Requests\Auth\LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Vérifier si l'utilisateur est un admin
        $user = User::find(Auth::id());
        if ($user && $user->hasRole('administrateur')) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        // Utilisateur "classique" : redirection vers la page d'accueil
        return redirect()->intended(route('accueil', absolute: false));
    }


    public function dashboard()
    {
            $commandesrecent = Commande::orderBy('created_at', 'desc')->limit(10)->get();


    return view('dashboard-admin', [
        'produits'  => Produit::count(),
        'commandes' => Commande::count(),
        'clients'   => User::count(),
        'ca'        => Commande::sum('montant_total') . ' FCFA',
        'commandesrecent' => $commandesrecent,
    ]);
}
}
