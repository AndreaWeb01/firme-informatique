@extends('layouts.back.master')

@section('contenu')

<!-- Start Content-->
<div class="container-fluid">
        
  <!-- start page title -->
  <div class="py-3 py-lg-4">
      <div class="row">
          <div class="col-lg-6">
              <h4 class="page-title mb-0">Ajouter Permission</h4>
          </div>
          <div class="col-lg-6">
              <div class="d-none d-lg-block">
              <ol class="breadcrumb m-0 float-end">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Tableau de bord</a></li>
                  <li class="breadcrumb-item active">Permissions</li>
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
                  <a href="{{ route('permissions.index') }}" class="btn btn-soft-danger"> Liste Permissions</a>
                  <p class="sub-header"></p>

                  <form action="{{ route('permissions.store') }}" method="POST">
                      @csrf 
                      <div class="mb-3">
                          <label for="" class="form-label">Titre</label>
                          <input type="text" name="titre" class="form-control @error('titre') is-invalid @enderror" id="titre" placeholder="Donner le titre de la permission" required>
                          @error('titre')
                              <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <button type="submit" class="btn btn-primary">Soumettre</button>
                  </form>

              </div> <!-- end card-body-->
          </div> <!-- end card-->
      </div> <!-- end col-->


      
  </div>
  <!-- end row -->

</div> <!-- container -->



@endsection