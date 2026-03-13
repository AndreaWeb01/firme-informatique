@extends('layouts.front.app')

@section('title', 'Accès refusé')

@section('content')
    {{-- Redirection automatique vers l\'accueil après quelques secondes --}}
    <meta http-equiv="refresh" content="5;url={{ route('accueil') }}">

    <main style="min-height:60vh; display:flex; align-items:center; justify-content:center;">
        <div style="max-width:520px; text-align:center; padding:24px;">
            <h1 style="font-size:28px; font-weight:700; margin-bottom:12px; color:#111827;">
                Accès refusé (403)
            </h1>

            <p style="color:#b91c1c; font-weight:600; margin-bottom:8px;">
                Vous n'avez pas les droits nécessaires pour accéder à cette page.
            </p>

            <p style="color:#6b7280; margin-bottom:20px;">
                Si vous pensez qu'il s'agit d'une erreur, contactez un administrateur ou réessayez avec un autre compte.
                Vous serez automatiquement redirigé vers l'accueil dans quelques secondes.
            </p>

            <a href="{{ route('accueil') }}"
               class="btn-yellow"
               style="display:inline-block; padding:10px 20px; border-radius:999px; text-decoration:none;">
                Retour à l'accueil
            </a>
        </div>
    </main>
@endsection

