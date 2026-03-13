@extends('layouts.front.app')

@section('title', 'Statut du Paiement')

@section('content')

<h2 class="text-xl font-bold text-center mb-4">
    Statut du Paiement
</h2>

@if(isset($payment))
    <p class="text-center">
        Statut actuel : <strong>{{ ucfirst($payment->status) }}</strong>
    </p>
    <p class="text-center text-sm text-gray-500 mt-2">
        Token : {{ $payment->token }}
    </p>
@else
    <p class="text-center">
        Votre paiement est en cours de traitement.
    </p>

    <p class="text-center text-sm text-gray-500 mt-2">
        Vous recevrez une confirmation une fois la transaction validée.
    </p>
@endif

<div class="text-center mt-4">
    <a href="{{ url('/') }}"
       class="bg-gray-800 text-white px-4 py-2 rounded">
        Retour à l'accueil
    </a>
</div>

@endsection
