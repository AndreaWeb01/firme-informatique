@extends('layouts.back.master')

@section('contenu')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Informations du profil</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autocomplete="name">
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        @if (session('status') === 'profile-updated')
                            <span class="ms-2 text-muted">Enregistré.</span>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Mettre à jour le mot de passe</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mot de passe actuel</label>
                            <input id="current_password" name="current_password" type="password" class="form-control" required autocomplete="current-password">
                            @error('current_password', 'updatePassword')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <input id="password" name="password" type="password" class="form-control" required autocomplete="new-password">
                            @error('password', 'updatePassword')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        @if (session('status') === 'password-updated')
                            <span class="ms-2 text-muted">Mot de passe mis à jour.</span>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Supprimer le compte</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ?')">
                        @csrf
                        @method('delete')
                        <div class="mb-3">
                            <label for="delete_password" class="form-label">Mot de passe</label>
                            <input id="delete_password" name="password" type="password" class="form-control" required>
                            @error('password', 'userDeletion')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-danger">Supprimer mon compte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
