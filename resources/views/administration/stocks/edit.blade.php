@extends('layouts.back.master')

@section('contenu')
<div class="container">
    <h2>Modifier un Stock</h2>

    <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="produit_id">Produit</label>
            <select name="produit_id" id="produit_id" class="form-control" required>
                <option value="">-- Sélectionnez un produit --</option>
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}"
                        {{ old('produit_id', $stock->produit_id) == $produit->id ? 'selected' : '' }}>
                        {{ $produit->name }}
                    </option>
                @endforeach
            </select>
            @error('produit_id')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="quantité">Quantité</label>
            <input type="number"
                   name="quantité"
                   id="quantité"
                   class="form-control"
                   min="0"
                   value="{{ old('quantité', $stock->quantité) }}"
                   required>
            @error('quantité')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="mouvement">Mouvement</label>
            <input type="text"
                   name="mouvement"
                   id="mouvement"
                   class="form-control"
                   value="{{ old('mouvement', $stock->mouvement) }}"
                   required>
            @error('mouvement')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection

