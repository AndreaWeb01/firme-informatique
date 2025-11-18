<?php

namespace App\Http\Controllers;

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

        // dd($request->all());

        // $admin = new User();
        // $admin->name = $request->nom;
        // $admin->prenom = $request->prenom;
        // $admin->email = $request->email;
        // $admin->password = $request->motdepasse;
        // $admin->save();

        User::create([
            'name' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->motdepasse),
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function loginstore(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    
    public function dashboard()
    {
        return view('dashboard-admin');
    }
}
