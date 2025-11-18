<?php

namespace App\Http\Controllers;

use App\Models\Conseils;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ActuConseilsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actuconseils = Conseils::all();
        return view('administration.actuconseils.index', compact('actuconseils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administration.actuconseils.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'imgconseil' => 'required|mimes:jpeg,jpg,png|max:2048',
            'titreconseil' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // dd($request->all());

        if ($request->hasFile('imgconseil')) {

            $file = $request->file('imgconseil');
            $extension = $file->getClientOriginalExtension();

            $imagePath = "conseils_".time().'.'.$extension;
            $file->move('uploads/conseils/', $imagePath);

        }

        $conseils = new Conseils();
        $conseils->image = $imagePath;
        $conseils->slug = Str::slug($request->get('titreconseil'),'-');
        $conseils->titre = $request->titreconseil;
        $conseils->description = $request->description;
        $conseils->statut = true;  // L'article est par défaut inactif
        $conseils->save();

    
        return redirect()->route('actuconseils.index')->with('message', 'Le conseil a été ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Conseils $actuconseil)
    {
        return view('administration.actuconseils.show', compact('actuconseil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conseils $actuconseil)
    {
        return view('administration.actuconseils.edit', compact('actuconseil'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conseils $actuconseil)
    {
        $request->validate([
            'imgconseil' => 'nullable|mimes:jpeg,jpg,png|max:2048',
            'titreconseil' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Si une nouvelle image est uploadée
        if ($request->hasFile('imgconseil')) {

            $file = $request->file('imgconseil');
            $extension = $file->getClientOriginalExtension();
            $imagePath = "conseils_" . time() . '.' . $extension;
            $file->move('uploads/conseils/', $imagePath);

            // Supprimer l'ancienne image si elle existe
            if ($actuconseil->image && file_exists(public_path('uploads/conseils/' . $actuconseil->image))) {
                unlink(public_path('uploads/conseils/' . $actuconseil->image));
            }

            $actuconseil->image = $imagePath;
        }else {
            // Si aucune image n'est téléchargée, garder l'ancienne image
            $imagePath = $actuconseil->image;
        }

        // Mise à jour des autres champs
        $actuconseil->slug = Str::slug($request->get('titreconseil'), '-');
        $actuconseil->titre = $request->titreconseil;
        $actuconseil->description = $request->description;
        $actuconseil->save();

        return redirect()->route('actuconseils.index')->with('success', 'Le conseil a été mis à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conseils $actuconseil)
    {
        // Supprimer l'image associée si elle existe
        if ($actuconseil->image && file_exists(public_path('uploads/conseils/' . $actuconseil->image))) {
            unlink(public_path('uploads/conseils/' . $actuconseil->image));
        }

        // Supprimer l'enregistrement de la base de données
        $actuconseil->delete();

        return redirect()->route('actuconseils.index')->with('success', 'Le conseil a été supprimé avec succès.');

    }
}
