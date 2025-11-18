@extends('layouts.back.master')

@section('contenu')

 <!-- Start Content-->
 <div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Editer un Produit</h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Produits</li>
                </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('produits.index') }}" class="btn btn-soft-danger"> Liste Produits</a>
                    <p class="sub-header"></p>

                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3 row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nomproduit" class="form-label">Nom</label>
                                        <input type="text" name="nomproduit" class="form-control" id="nomproduit" value="{{ old('nomproduit', $produit->name) }}" >
                                        @error('nomproduit')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nomcategorie" class="form-label">Image Principal</label>
                                        <input type="file" name="imgproduit" class="form-control" id="imgproduit">
                                        @if($produit->image_principale)
                                            <div>
                                                <img src="{{ asset('uploads/produits/' . $produit->image_principale) }}" alt="Image actuelle" width="100">
                                            </div>
                                        @endif
                                        @error('imgproduit')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="categories" class="form-label">Categories</label>
                                    <select name="categories" id="categories" class="form-control">
                                        <optgroup label="">
                                            <option selected disabled >Choisir une catégorie</option>
                                        </optgroup>
                                        @foreach($typeproduits as $typeproduit)
                                            <optgroup label="{{ $typeproduit->Nom_TypeProduit  }}">
                                                @foreach ($typeproduit->categories as $categorie)
                                                    <option value="{{ $categorie->id }}"
                                                        {{ $categorie->id == old('categories', $produit->categorie_id) ? 'selected' : '' }}>
                                                            {{ $categorie->Nom_Categorie }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div id="section-prix-stock" class="row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label for="prix" class="form-label">Prix</label>
                                        <input type="number" step="0.01" name="prix" class="form-control" value="{{ old('prix', $produit->prix) }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" name="stock" class="form-control" value="{{ old('stock', optional($produit->stocks->last())->quantité ?? 0) }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="sku" class="form-label">Sku</label>
                                        <input type="text" name="sku" class="form-control" value="{{ old('sku', $produit->sku) }}">
                                    </div>
                                </div>

                                <div  class="mb-3">
                                    <label class="form-label">Autres images (optionnel)</label>
                                    <input type="file" class="form-control" name="images[]" multiple>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description </label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="5" placeholder="Ecrivez la description de la categorie">{{ old('description', $produit->description) }}</textarea> 
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-primary" type="submit">Mettre à jour</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 


        
    </div>
    <!-- end row -->

</div> <!-- container -->    

@endsection


