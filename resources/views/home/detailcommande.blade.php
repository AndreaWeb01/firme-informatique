@extends("layouts.front.app")

@section('title', 'Détail de la commande')

@section('banner')
<div class="banner">
    <div class="imager">
        <div class="images">
            <img src="{{ url('assets/frontend/image/left-background.png') }}" alt="">
        </div>
    </div>
    <div class="contents">
        <h1>Détails de votre commande</h1>
        <a href="{{ route('mescommandes') }}" class="btn-yellow">Retour à mes commandes</a>
    </div>
</div>
@endsection

@section('content')
<main>
    <section class="detail-commande">
        <div class="wrap">
            <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / <a href="{{ route('mescommandes') }}">Mes commandes</a> / Détail</p>
        </div>
    </section>

    <section class="detail-cmd">
        <div class="wrap">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h6 class="text-muted">Numéro</h6>
                            <div class="fs-5">{{ $commande->numero_commande ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h6 class="text-muted">Date</h6>
                            <div class="fs-5">{{ optional($commande->created_at)->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h6 class="text-muted">Montant total</h6>
                            <div class="fs-5">{{ number_format((float)($commande->montant_total ?? 0), 0, ',', ' ') }} FCFA</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h6 class="text-muted">Montant payé</h6>
                            <div class="fs-5">{{ number_format((float)($commande->montant_paye ?? 0), 0, ',', ' ') }} FCFA</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Statut</h6>
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
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Mode de paiement</h6>
                            <div>{{ $commande->mode_paiement ?? 'Non spécifié' }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="text-muted mb-2">Montant calculé (items)</h6>
                            <div>{{ number_format((float)($commande->items->sum('total') ?? 0), 0, ',', ' ') }} FCFA</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-3">
        <div class="wrap">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Adresse de livraison</h5>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <strong>Adresse:</strong> {{ $commande->adresse_livraison ?? '—' }}
                        </div>
                        <div class="col-md-3 mb-2">
                            <strong>Ville:</strong> {{ $commande->ville ?? '—' }}
                        </div>
                        <div class="col-md-3 mb-2">
                            <strong>Téléphone:</strong> {{ $commande->telephone ?? '—' }}
                        </div>
                        <div class="col-12 mt-2">
                            <strong>Notes:</strong> {{ $commande->notes ?? 'Aucune' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-4">
        <div class="wrap">
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Image</th>
                            <th>Produit</th>
                            <th>Prix unitaire</th>
                            <th>Quantité</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($commande->items as $item)
                            <tr>
                                <td style="width: 80px;">
                                    @php $img = optional($item->produit)->image_principale; @endphp
                                    @if($img)
                                        <img src="{{ url('storage/' . $img) }}" alt="{{ optional($item->produit)->name }}" style="width:60px;height:60px;object-fit:cover;">
                                    @else
                                        <img src="{{ url('assets/frontend/image/default-product.png') }}" alt="image" style="width:60px;height:60px;object-fit:cover;">
                                    @endif
                                </td>
                                <td class="text-start">
                                    {{ optional($item->produit)->name ?? 'Produit supprimé' }}
                                </td>
                                <td>{{ number_format((float)($item->prix_unitaire ?? 0), 0, ',', ' ') }} FCFA</td>
                                <td>{{ $item->quantite ?? 0 }}</td>
                                <td>{{ number_format((float)($item->total ?? 0), 0, ',', ' ') }} FCFA</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun article dans cette commande.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Total commande</th>
                            <th>{{ number_format((float)($commande->montant_total ?? 0), 0, ',', ' ') }} FCFA</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="mt-3">
                <a href="{{ route('mescommandes') }}" class="btn btn-outline-secondary">← Retour à mes commandes</a>
            </div>
        </div>
    </section>
</main>
@endsection

