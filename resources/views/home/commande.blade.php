@extends("layouts.front.app")

@section('title', 'Mes Commandes')

@section('banner')

<div class="banner">
    <div class="imager">
        <div class="images">
            <img src="{{ url('assets/frontend/image/left-background.png') }}" alt="">
        </div>
    </div>
    <div class="contents">
        <h1>Vos commandes et leur statut en temps réel</h1>
        <a href="{{ route('boutique') }}" class="btn-yellow">Continuer vos achats</a>
    </div>
</div>

@endsection

@section('content')

<main>
    <section class="mb-4">
        <div class="wrap">
            <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / Mes commandes</p>
        </div>
    </section>

    <section class="py-4">
        <div class="wrap">
            <div class="table-responsive">
                @if($commandes->isEmpty())
                    <div class="alert alert-info">Aucune commande pour l'instant.</div>
                @else
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Numéro</th>
                                <th>Date</th>
                                <th>Montant total</th>
                                <th>Montant payé</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commandes as $commande)
                                <tr>
                                    <td>{{ $commande->numero_commande }}</td>
                                    <td>{{ optional($commande->created_at)->format('d/m/Y') }}</td>
                                    <td>{{ number_format((float)($commande->montant_total ?? 0), 0, ',', ' ') }} FCFA</td>
                                    <td>{{ number_format((float)($commande->montant_paye ?? 0), 0, ',', ' ') }} FCFA</td>
                                    <td>
                                        @php
                                            $statut = strtolower((string)($commande->statut ?? ''));
                                            $badgeClass = match($statut) {
                                                'en_attente' => 'bg-secondary',
                                                'validee', 'validée' => 'bg-success',
                                                'annulee', 'annulée' => 'bg-danger',
                                                'en_livraison' => 'bg-primary',
                                                'livree', 'livrée' => 'bg-info',
                                                default => 'bg-dark',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $commande->statut ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('detailcommande', $commande->numero_commande) }}" class="btn btn-sm btn-outline-primary">Voir détails</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </section>

  
</main>

@endsection
