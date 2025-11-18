@extends('layouts.back.master')

@section('contenu')

     <!-- Start Content-->
 <div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Voir le Conseil <i>{{ $actuconseil->titre }}</i></h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Conseils</li>
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
                    <a href="{{ route('actuconseils.index') }}" class="btn btn-soft-danger"> Retour</a>
                    <p class="sub-header"></p>

                    <p><img src="{{ url('uploads/conseils', $actuconseil->image )}}" alt="" width="100" width="100"></p>
                    <p><strong>Nom:</strong> {{ $actuconseil->titre }}</p>
                    <p><strong>Description:</strong> {{ $actuconseil->description }}</p>


                 

                </div>
            </div> 
        </div> 


        
    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection