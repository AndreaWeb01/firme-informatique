@extends('layouts.back.master')

@section('contenu')
<div class="container">
    <h2>Ajouter un Stock</h2>
    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="produit_id">Produit</label>
            <select name="produit_id" id="produit_id" class="form-control" required>
                <option value="">-- Sélectionnez un produit --</option>
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}">{{ $produit->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantité">Quantité</label>
            <input type="number" name="quantité" id="quantité" class="form-control" min="0" required>
        </div>
        <div class="form-group">
            <label for="mouvement">Mouvement</label>
            <input type="text" name="mouvement" id="mouvement" class="form-control" required>   
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
