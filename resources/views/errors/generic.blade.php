@extends('layouts.front.app')

@section('title', 'Une erreur est survenue')

@section('content')
<main style="min-height:60vh; display:flex; align-items:center; justify-content:center;">
    <div style="max-width:520px; text-align:center; padding:24px;">
        <h1 style="font-size:28px; font-weight:700; margin-bottom:12px; color:#111827;">
            Oups, quelque chose s’est mal passé
        </h1>
        <p style="color:#6b7280; margin-bottom:20px;">
            Une erreur inattendue s’est produite.  
            Si le problème persiste, veuillez réessayer plus tard ou contacter notre support.
        </p>

        @if(session('error'))
            <div style="background:#fef2f2; color:#b91c1c; border-radius:8px; padding:10px 14px; font-size:14px; margin-bottom:16px;">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('accueil') }}"
           class="btn-yellow"
           style="display:inline-block; padding:10px 20px; border-radius:999px; text-decoration:none;">
            Retour à l’accueil
        </a>
    </div>
</main>
@endsection

