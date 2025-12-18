<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\RecentlyViewed;
use App\Models\ImageProduit;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\TypeProduits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::with('categorie','stocks')->orderBy('created_at', 'desc')->get();
        return view('administration.produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeproduits = TypeProduits::with('categories')->get(); 
        return view('administration.produits.create', compact('typeproduits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomproduit'    => 'required|string|max:255',
            'imgproduit'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories'    => 'required|exists:categories,id',
            'prix'          => 'required|numeric|min:0',
            'stock'         => 'required|integer|min:0',
            'sku'           => 'nullable|string|max:255|unique:produits,sku',
            'description'   => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            // Generate unique slug
            $slug = $this->generateUniqueSlug($validated['nomproduit']);

            // Upload main image
            $imagePath = $this->uploadImage($request->file('imgproduit'), 'produits');

            // Create product
            $produit = Produit::create([
                'name' => $validated['nomproduit'],
                'slug' => $slug,
                'sku' => $validated['sku'],
                'description' => $validated['description'],
                'image_principale' => $imagePath,
                'categorie_id' => $validated['categories'],
                'prix' => $validated['prix'],
            ]);

            // Handle secondary images (limit to 3)
            if ($request->hasFile('images')) {
                $images = array_slice($request->file('images'), 0, 3);
                
                foreach ($images as $image) {
                    $chemin = $this->uploadImage($image, 'produit_images');
                    
                    ImageProduit::create([
                        'produit_id' => $produit->id,
                        'chemin_image' => $chemin,
                    ]);
                }
            }

            // Create initial stock record
            Stock::create([
                'produit_id' => $produit->id,
                'quantité' => $validated['stock'],
                'mouvement' => 'ajout'
            ]);

            DB::commit();

            return redirect()
                ->route('produits.index')
                ->with('success', 'Produit enregistré avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Clean up uploaded images if transaction fails
            if (isset($imagePath)) {
                Storage::delete($imagePath);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de l\'enregistrement du produit.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {

    $userId = auth()->id() ?? null; // Assurez-vous que l'utilisateur est connecté

 
    // Récupérer le produit
    $product = Produit::findOrFail($produit->id);
    $produit->load('images', 'categorie', 'stocks');
    return view('administration.produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        $typeproduits = TypeProduits::with('categories')->get(); 
        return view('administration.produits.edit', compact('produit', 'typeproduits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        $validated = $request->validate([
            'nomproduit'    => 'required|string|max:255',
            'imgproduit'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories'    => 'required|exists:categories,id',
            'prix'          => 'required|numeric|min:0',
            'sku'           => 'nullable|string|max:255|unique:produits,sku,' . $produit->id,
            'description'   => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $oldImagePath = $produit->image_principale;

            // Update slug if name changed
            if ($produit->name !== $validated['nomproduit']) {
                $produit->slug = $this->generateUniqueSlug($validated['nomproduit'], $produit->id);
            }

            // Handle main image upload
            if ($request->hasFile('imgproduit')) {
                $newImagePath = $this->uploadImage($request->file('imgproduit'), 'produits');
                $produit->image_principale = $newImagePath;

                // Delete old image
                if ($oldImagePath && Storage::exists($oldImagePath)) {
                    Storage::delete($oldImagePath);
                }
            }

            // Update product fields
            $produit->update([
                'name' => $validated['nomproduit'],
                'sku' => $validated['sku'],
                'description' => $validated['description'],
                'categorie_id' => $validated['categories'],
                'prix' => $validated['prix'],
            ]);

            // Update stock if quantity changed


            // Handle secondary images
            if ($request->hasFile('images')) {
                $currentImagesCount = $produit->images()->count();
                $maxNewImages = max(0, 3 - $currentImagesCount);
                $images = array_slice($request->file('images'), 0, $maxNewImages);
                
                foreach ($images as $image) {
                    $chemin = $this->uploadImage($image, 'produit_images');
                    
                    ImageProduit::create([
                        'produit_id' => $produit->id,
                        'chemin_image' => $chemin,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('produits.index')
                ->with('success', 'Produit mis à jour avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour du produit.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        DB::beginTransaction();

        try {
            // Delete main image
            if ($produit->image_principale && Storage::exists($produit->image_principale)) {
                Storage::delete($produit->image_principale);
            }

            // Delete secondary images
            foreach ($produit->images as $image) {
                if (Storage::exists($image->chemin_image)) {
                    Storage::delete($image->chemin_image);
                }
                $image->delete();
            }

            // Delete stocks
            Stock::where('produit_id', $produit->id)->delete();

            // Delete product
            $produit->delete();

            DB::commit();

            return redirect()
                ->route('produits.index')
                ->with('success', 'Produit supprimé avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la suppression du produit.');
        }
    }

    /**
     * Generate a unique slug from a name
     */
    private function generateUniqueSlug(string $name, ?int $excludeId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        $query = Produit::where('slug', $slug);
        
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
            $query = Produit::where('slug', $slug);
            
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }

        return $slug;
    }

    /**
     * Upload and store an image
     */
    private function uploadImage($file, string $directory): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $extension;
        
        // Store in storage/app/public directory
        return $file->storeAs($directory, $filename, 'public');
    }

    /**
     * Search products by name or category (case-insensitive)
     */
    public function search(Request $request)
    {
        try {
            $query = Produit::with('categorie');

            if ($request->filled('search')) {
                $term = $request->search;

                $query->where(function($q) use ($term) {
                    $q->where('name', 'LIKE', '%' . $term . '%')
                      ->orWhereHas('categorie', function($sub) use ($term) {
                          $sub->where('Nom_Categorie', 'LIKE', '%' . $term . '%');
                      });
                });
            }

            $produits = $query->select('id', 'name', 'prix', 'image_principale', 'slug', 'categorie_id')
                ->take(10)
                ->get()
                ->map(function($produit) {
                    return [
                        'id' => $produit->id,
                        'nom' => $produit->name,
                        'prix' => $produit->prix,
                        'image' => $produit->image_principale,
                        'slug' => $produit->slug,
                        'categorie' => $produit->categorie ? $produit->categorie->Nom_Categorie : ''
                    ];
                });

            return response()->json($produits);
        
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors de la recherche',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
