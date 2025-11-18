@extends('layouts.back.master')

@section('contenu')

 <!-- Start Content-->
 <div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Ajouter un Produit</h4>
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
                    <a href="{{ route('typeproduits.index') }}" class="btn btn-soft-danger"> Liste Type de Produits</a>
                    <p class="sub-header"></p>

                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('typeproduits.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    
                                    <label for="nomtypeproduit" class="form-label">Nom Type Produits</label>
                                    <input type="text" name="nomtypeproduit" class="form-control" id="nomtypeproduit" placeholder="Entrez le nom du type produit" >
                                    @error('nomtypeproduit')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    
                                </div>
                                
                                <button class="btn btn-primary" type="submit">Soumettre</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div> 
        </div> 


        
    </div>

</div>
    

@endsection


