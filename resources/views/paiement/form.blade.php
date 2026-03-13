@extends('layouts.front.app')

@section('title', 'Paiement')

@section('content')

<h2 class="text-xl font-bold mb-4 text-center">
    Paiement sécurisé
</h2>

@if(session('error'))
    <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('payment.create') }}">
    @csrf

    @if(isset($commande))
        <input type="hidden" name="commande_id" value="{{ $commande->id }}">
        <input type="hidden" name="amount" value="{{ $commande->montant_total }}">
        <input type="hidden" name="name" value="{{ $commande->nom }} {{ $commande->prenom }}">
        <input type="hidden" name="phone" value="{{ $commande->numero }}">
    @endif

    <div class="mb-4">
        <label class="block text-sm font-medium">Nom complet</label>
        <input type="text" name="name"
               class="w-full border rounded p-2 mt-1"
               required>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium">Téléphone</label>
        <input type="text" name="phone"
               class="w-full border rounded p-2 mt-1"
               placeholder="Ex: 2250700000000"
               required>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium">Montant</label>
        <input type="number" name="amount"
               class="w-full border rounded p-2 mt-1"
               min="1"
               required>
    </div>

    <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
        Payer maintenant
    </button>
</form>

@endsection
