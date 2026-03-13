<?php

namespace App\Http\Controllers;

use App\Models\Conseils;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActuConseilsController extends Controller
{
    private function makeUniqueSlug(string $titre, ?int $ignoreId = null): string
    {
        $base = Str::slug($titre, '-');
        $slug = $base;
        $i = 2;

        while (
            Conseils::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actuconseils = Conseils::latest()->paginate(15);
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
            'imgconseil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'titreconseil' => 'required|string|max:255',
            'description' => 'required|string',
            'statut' => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('imgconseil')) {
            $file = $request->file('imgconseil');
            $extension = $file->getClientOriginalExtension();
            $filename = "conseils_" . time() . '_' . uniqid() . '.' . $extension;

            // Utiliser le disque 'public' pour stocker les fichiers
            $imagePath = $file->storeAs('conseils', $filename, 'public');
        }

        $conseils = new Conseils();
        $conseils->image = $imagePath;
        $conseils->slug = $this->makeUniqueSlug($request->get('titreconseil'));
        $conseils->titre = $request->titreconseil;
        $conseils->description = $request->description;
        $conseils->statut = (bool) $request->boolean('statut', true);
        $conseils->save();

        return redirect()->route('actuconseils.index')->with('success', 'Le conseil a été ajouté avec succès.');
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
            'imgconseil' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'titreconseil' => 'required|string|max:255',
            'description' => 'required|string',
            'statut' => 'nullable|boolean',
        ]);

        // Si une nouvelle image est uploadée
        if ($request->hasFile('imgconseil')) {
            $file = $request->file('imgconseil');
            $extension = $file->getClientOriginalExtension();
            $filename = "conseils_" . time() . '_' . uniqid() . '.' . $extension;

            // Stocker la nouvelle image
            $imagePath = $file->storeAs('conseils', $filename, 'public');

            // Supprimer l'ancienne image si elle existe
            if ($actuconseil->image && Storage::disk('public')->exists($actuconseil->image)) {
                Storage::disk('public')->delete($actuconseil->image);
            }

            $actuconseil->image = $imagePath;
        }

        // Mise à jour des autres champs
        $actuconseil->slug = $this->makeUniqueSlug($request->get('titreconseil'), $actuconseil->id);
        $actuconseil->titre = $request->titreconseil;
        $actuconseil->description = $request->description;
        $actuconseil->statut = (bool) $request->boolean('statut', $actuconseil->statut);
        $actuconseil->save();

        return redirect()->route('actuconseils.index')->with('success', 'Le conseil a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conseils $actuconseil)
    {
        // Supprimer l'image associée si elle existe
        if ($actuconseil->image && Storage::disk('public')->exists($actuconseil->image)) {
            Storage::disk('public')->delete($actuconseil->image);
        }

        // Supprimer l'enregistrement de la base de données
        $actuconseil->delete();

        return redirect()->route('actuconseils.index')->with('success', 'Le conseil a été supprimé avec succès.');
    }
}
