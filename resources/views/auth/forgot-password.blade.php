@extends('layouts.front.app')

@section('title', 'Mot de passe oublié')

@section('banner')
<div class="banner">
    <div class="imager">
        <div class="images">
            <img src="{{ url('assets/frontend/image/left-background.png') }}" alt="">
        </div>
    </div>
    <div class="contents">
        <h1>Réinitialisez votre mot de passe en quelques étapes</h1>
        <a href="{{ route('boutique') }}" class="btn-yellow">Retour à la boutique</a>
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
                        <h1>Mot de passe oublié</h1>
                        <p class="subtitle">Entrez votre adresse email, nous vous enverrons un lien de réinitialisation.</p>
                    </div>

                    <form method="POST" action="{{ route('password.email') }}" class="form">
                        @csrf
                        <div class="form-group">
                            <label for="email">Adresse email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="box" placeholder="Entrez votre email">
                            @error('email')
                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn">Envoyer le lien de réinitialisation</button>
                    </form>

                    <div class="authentication mt-3 text-center">
                        <p>Vous vous souvenez de votre mot de passe ? <a href="{{ route('login') }}">Se connecter</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
/* Styles ciblés pour la page mot de passe oublié */
.auth-container{display:flex;justify-content:center;align-items:center}
.auth-card{max-width:520px;width:100%;background:#fff;border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,0.08);padding:2rem}
.auth-card .title h1{font-size:1.8rem;text-transform:uppercase}
.auth-card .subtitle{color:#666;font-size:.95rem}
.form .form-group label{font-weight:600;margin-bottom:.35rem;display:block}
.form .box{width:100%;border:1px solid #ddd;border-radius:8px;padding:.8rem 1rem;font-size:1rem}
.btn{display:block;width:100%;margin-top:1.5rem;background:#f0b90b;color:#1a1a1a;border:none;border-radius:8px;padding:.8rem 1rem;font-weight:700;text-transform:uppercase}
.btn:hover{filter:brightness(0.95)}
.text-danger{color:#dc3545}
@media (max-width: 576px){.auth-card{padding:1.25rem}}
</style>
@endsection
