@extends('layouts.back.master')

@section('contenu')

 <!-- Start Content-->
 <div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Ajouter une categorie</h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Categories</li>
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
                    <a href="{{ route('categories.index') }}" class="btn btn-soft-danger"> Liste Categories</a>
                    <p class="sub-header"></p>

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nomcategorie" class="form-label">Nom categorie</label>
                            <input type="text" name="nomcategorie" class="form-control" id="nomcategorie" placeholder="Entrez le nom de la categorie" required>
                            @error('nomcategorie')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="typeproduit" class="form-label">Type produit</label>
                            <select name="typeproduit" id="typeproduit" class="form-control">
                                <option>Choisir un type produit</option>
                                @foreach ($typesProduits as $type)
                                    <option value="{{ $type->id }}">{{ $type->Nom_TypeProduit }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button class="btn btn-primary" type="submit">Soumettre</button>
                    </form>

                </div>
            </div> 
        </div> 


        
    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection