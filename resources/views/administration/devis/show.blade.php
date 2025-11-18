@extends('layouts.back.master')

@section('contenu')

     <!-- Start Content-->
 <div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Voir le devis <i>{{ $devis->id }}</i></h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Devis</li>
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
                    <a href="{{ route('devis.index') }}" class="btn btn-soft-danger"> Retour</a>
                    <p class="sub-header"></p>

                    <p><b>Nom: </b>{{ $devis->nom }}</p>
                    <p><b>Prenom: </b>{{ $devis->prenom }}</p>
                    <p><b>Email: </b>{{ $devis->email }}</p>
                    <p><b>Telephone: </b>{{ $devis->telephone }}</p>
                    <p><b>Service: </b>{{ $devis->service }}</p>
                    <hr>
                    <p><b>Besoin: </b></p>
                    <p>{{ $devis->besoin }}</p>

                </div>
            </div> 
        </div> 


        
    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection