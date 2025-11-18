@extends('layouts.back.master')

@section('contenu')

<!-- Start Content-->
<div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Ajouter Utilisateur</h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Utilisateurs</li>
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
                    <a href="{{ route('users.index') }}" class="btn btn-soft-danger"> Liste Utilisateurs</a>
                    <p class="sub-header"></p>

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf 
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="" class="form-label">Nom</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Entrez votre nom" required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Prenom</label>
                                <input type="text" name="firstname" class="form-control @error('firstname') is-invalid @enderror" id="name" placeholder="Entrez votre nom" required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Entrez votre email" required>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="" class="form-label">Mot de passe</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Entrez votre mot de passe" required>
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Confirmation de mot de passe</label>
                                <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Confirmer votre mot de passe" required>
                                @error('confirm_password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="">Roles</label>
                            <select name="roles[]" class="form-control">
                                <option value="">Selectionner le role</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </form>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->


        
    </div>
    <!-- end row -->

</div> <!-- container -->


{{-- <h3>Ajouter un utilisateur</h3> --}}

{{-- Barre de navigation --}}

{{-- @include('layouts.back.navigation') --}}

{{-- End Barre de navigation --}}

{{-- <div class="my-5">
    <a class="btn btn-outline-primary" href="{{ route('users.index') }}" role="button">Liste des utilisateurs</a>

</div>


<form action="{{ route('users.store') }}" method="POST">
    @csrf 

    <div class="mb-3">
        <label for="" class="form-label">Nom</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Entrez votre nom" required>      
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Entrez votre email" required> 
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Mot de passe</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Entrez votre mot de passe" required>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Confirmation de mot de passe</label>
        <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Confirmer votre mot de passe" required>
    </div>

    <div class="mb-3">
        <label for="">Roles</label>
        <select name="roles[]" class="form-control">
            <option value="">Selectionner le role</option>
            @foreach ($roles as $role)
            <option value="{{ $role }}">{{ $role }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-secondary">Soumettre</button>
</form> --}}

@endsection