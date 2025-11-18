@extends('layouts.back.master')

@section('contenu')

 <!-- Start Content-->
 <div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Modifier un conseil</h4>
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
                    <a href="{{ route('actuconseils.index') }}" class="btn btn-soft-danger"> Liste Conseils</a>
                    <p class="sub-header"></p>

                    <form action="{{ route('actuconseils.update', $actuconseil->id ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="imgconseil" class="form-label">Image du conseil</label>
                                <input type="file" name="imgconseil" class="form-control" id="imgconseil">
                                 @if($actuconseil->image)
                                    <div>
                                        <img src="{{ asset('uploads/conseils/' . $actuconseil->image) }}" alt="Image actuelle" width="100">
                                    </div>
                                @endif
                                @error('imgconseil')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="titreconseil" class="form-label">Titre du conseil</label>
                                <input type="text" name="titreconseil" class="form-control" id="titreconseil" value="{{ $actuconseil->titre }}">
                                @error('titreconseil')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description </label>
                            <textarea name="description" class="form-control" id="" cols="30" rows="8" placeholder="Ecrivez la description de la categorie">{{ $actuconseil->description }}</textarea> 
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