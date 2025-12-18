@extends('layouts.back.master')

@section('contenu')

<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Détail Commande</h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                    <ol class="breadcrumb m-0 float-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('commandes.index') }}">Commandes</a></li>
                        <li class="breadcrumb-item active">Détail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <div class="border rounded p-3 h-100">
                                <div class="text-muted">Numéro</div>
                                <div class="fw-bold">{{ $commande->numero_commande }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border rounded p-3 h-100">
                                <div class="text-muted">Date</div>
                                <div class="fw-bold">{{ optional($commande->created_at)->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border rounded p-3 h-100">
                                <div class="text-muted">Montant total</div>
                                <div class="fw-bold">{{ number_format((float)($commande->montant_total ?? 0), 0, ',', ' ') }} FCFA</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border rounded p-3 h-100">
                                <div class="text-muted">Montant payé</div>
                                <div class="fw-bold">{{ number_format((float)($commande->montant_paye ?? 0), 0, ',', ' ') }} FCFA</div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <div class="text-muted mb-1">Statut</div>
                                @php
                                    $statut = strtolower((string)($commande->statut ?? 'en_attente'));
                                    $badge = $badgeColors[$statut] ?? 'secondary';
                                    $libelle = $statutsLisibles[$statut] ?? ucfirst($statut);
                                @endphp
                                <span class="badge bg-{{ $badge }}">{{ $libelle }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <div class="text-muted mb-1">Client</div>
                                <div>{{ $commande->nom }} {{ optional($commande->nom)->prenom}} </div>
                                <div class="small text-muted">{{ optional($commande->user)->email }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="border rounded p-3 h-100">
                                <div class="text-muted mb-1">Paiement</div>
                                <div>Mode: {{ $commande->mode_paiement ?? 'Non spécifié' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="border rounded p-3">
                                <h6 class="mb-3">Adresse de livraison</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-2"><strong>Adresse:</strong> {{ $commande->adresse_livraison ?? '—' }}</div>
                                    <div class="col-md-3 mb-2"><strong>Ville:</strong> {{ $commande->ville ?? $commande->user->ville }}</div>
                                    <div class="col-md-3 mb-2"><strong>Téléphone:</strong> {{ $commande->numero ?? $commande->user->telephone }}</div>
                                    <div class="col-12 mt-2"><strong>Notes:</strong> {{ $commande->notes ?? 'Aucune' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                        <td class="text-start">{{ optional($item->produit)->name ?? 'Produit supprimé' }}</td>
                                        <td>{{ number_format((float)($item->prix_unitaire ?? 0), 0, ',', ' ') }} FCFA</td>
                                        <td>{{ $item->quantite ?? 0 }}</td>
                                        <td>{{ number_format((float)($item->total ?? 0), 0, ',', ' ') }} FCFA</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Aucun article pour cette commande.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total</th>
                                    <th>{{ number_format((float)($commande->montant_total ?? 0), 0, ',', ' ') }} FCFA</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-3">
                        <form action="{{ route('commandes.changerStatut', $commande->id) }}" method="POST" class="row g-2 align-items-end">
                            @csrf
                            <div class="col-md-4">
                                <label class="form-label">Modifier le statut</label>
                                <select name="statut" class="form-select">
                                    @foreach($statutsLisibles as $cle => $lib)
                                        <option value="{{ $cle }}" {{ $cle === $statut ? 'selected' : '' }}>{{ $lib }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('commandes.index') }}" class="btn btn-outline-secondary">← Retour à la liste</a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- container -->

@endsection
