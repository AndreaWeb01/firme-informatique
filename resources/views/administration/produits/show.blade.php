@extends('layouts.back.master')

@section('contenu')

     <!-- Start Content-->
 <div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Voir le produit <i>{{ $produit->name }}</i></h4>
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
                    <a href="{{ route('produits.index') }}" class="btn btn-soft-danger"> Retour</a>
                    <p class="sub-header"></p>

                    <p><img src="{{ url('/uploads/produits', $produit->image_principale ) }}" alt="" height="200" width="500"></p>
                    <p><b>Nom du produit:</b> {{ $produit->name }}</p>
                    <p><b>Prix du produit:</b> {{ $produit->prix }}</p>
                    <p><b>Code du produit:</b> {{ $produit->sku }}</p>
                    <p><b>Categorie du produit:</b> {{ $produit->categorie->Nom_Categorie }}</p>
                    <p><b>Description du produit:</b> {{ $produit->description }}</p>


                   
                </div>
            </div> 
        </div> 


        
    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection