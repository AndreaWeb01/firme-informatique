@extends('layouts.front.app')

@php
use Illuminate\Support\Str;
@endphp

@section('title','Mes devis')

@section('content')
<main >
    <section class="mb-4">
        <div class="wrap">
            <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / Mes devis</p>
        </div>
    </section>

    <section class="container py-5">
        <div class="wrap">
            <h2>Vos demandes de devis</h2>
            @if($devis->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Service</th>
                            <th>Besoin</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($devis as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->nom }}</td>
                                <td>{{ $d->prenom }}</td>
                                <td>{{ $d->email }}</td>
                                <td>{{ $d->telephone }}</td>
                                <td>{{ $d->service }}</td>
                                <td>{{ Str::limit($d->besoin, 50) }}</td>
                                <td>{{ $d->created_at?->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Vous n'avez encore demandé aucun devis.</p>
            @endif
        </div>
    </section>
</main>
@endsection
