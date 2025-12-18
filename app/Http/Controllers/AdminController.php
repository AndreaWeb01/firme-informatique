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
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'motdepasse' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->motdepasse),
        ]);

        $admin = User::where('email', $request->email)->first();
        $admin->assignRole('Client');

        return redirect()->route('admin.dashboard');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function loginstore(Request $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        
        // Vérifier si l'utilisateur est un admin
        $user = User::find(Auth::id());
        if ($user->hasRole('Administrateur')) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    
    public function dashboard()
    {
            $commandesrecent = Commande::orderBy('created_at', 'desc')
                               ->limit(10)
                               ->get();
     
    return view('dashboard-admin', [
        'produits'  => Produit::count(),
        'commandes' => Commande::count(),
        'clients'   => User::count(),
        'ca'        => Commande::sum('montant_total') . ' FCFA',
        'commandesrecent' => $commandesrecent,
    ]);
}
}