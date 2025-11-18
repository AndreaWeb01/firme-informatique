@extends('layouts.back.master')

@section('contenu')

 <!-- Start Content-->
 <div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Modifier la categorie <i>{{ $category->name }}</i></h4>
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

                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nomcategorie" class="form-label">Nom</label>
                            <input type="text" name="nomcategorie" class="form-control" id="nomcategorie"  value="{{ $category->name }}">
                            @error('nomcategorie')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description (optionel)</label>
                            <textarea name="description" class="form-control" id="description" cols="30" rows="8" >{{ $category->description }}</textarea> 
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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