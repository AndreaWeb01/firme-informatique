@extends('layouts.front.app')

@section('title', 'Connexion')

@section('banner')
<div class="banner">
    <div class="imager">
        <div class="images">
            <img src="{{ url('assets/frontend/image/left-background.png') }}" alt="">
        </div>
    </div>
    <div class="contents">
        <h1>Connectez-vous pour suivre vos commandes</h1>
        <a href="{{ route('boutique') }}" class="btn-yellow">Commencer vos achats</a>
    </div>
</div>
@endsection

@section('content')
<main>
    <section class="py-5">
        <div class="wrap">
            <div class="auth-container">
                <div class="auth-card">
                    @if (session('status'))
                        <div class="alert alert-success mb-3">{{ session('status') }}</div>
                    @endif

                    <div class="title text-center mb-3">
                        <h1>Connexion</h1>
                        <p class="subtitle">Accédez à votre compte en toute sécurité</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="form">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="box" placeholder="Entrez votre email">
                            @error('email')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="password">Mot de passe</label>
                            <input id="password" type="password" name="password" required autocomplete="current-password" class="box" placeholder="Entrez votre mot de passe">
                            @error('password')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <label class="remember d-flex align-items-center">
                                <input id="remember_me" type="checkbox" name="remember">
                                <span class="ms-2">Se souvenir de moi</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                            @endif
                        </div>

                        <button type="submit" class="btn">Se connecter</button>
                    </form>

                    <div class="authentication mt-3">
                        <p>Nouveau sur la plateforme ? <a href="{{ route('accueil') }}">Créer un compte</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
/* Styles ciblés pour la page de connexion */
.auth-container{display:flex;justify-content:center;align-items:center}
.auth-card{max-width:520px;width:100%;background:#fff;border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,0.08);padding:2rem}
.auth-card .title h1{font-size:1.8rem;text-transform:uppercase}
.auth-card .subtitle{color:#666;font-size:.95rem}
.form .form-group label{font-weight:600;margin-bottom:.35rem;display:block}
.form .box{width:100%;border:1px solid #ddd;border-radius:8px;padding:.8rem 1rem;font-size:1rem}
.remember input{accent-color:#f0b90b}
.btn{display:block;width:100%;margin-top:1.5rem;background:#f0b90b;color:#1a1a1a;border:none;border-radius:8px;padding:.8rem 1rem;font-weight:700;text-transform:uppercase}
.btn:hover{filter:brightness(0.95)}
.link{color:#1a1a1a;text-decoration:underline}
.text-danger{color:#dc3545}
@media (max-width: 576px){.auth-card{padding:1.25rem}}
</style>
@endsection
