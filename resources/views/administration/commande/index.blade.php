@extends('layouts.back.master')

@section('contenu')

<div class="container-fluid">

    <!-- Titre -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Liste des commandes</h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                    <ol class="breadcrumb m-0 float-end">
                        <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                        <li class="breadcrumb-item active">Commandes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Numéro de commande</th>
                                    <th>Statut</th>
                                    <th>Créée le</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($commandes->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">Aucune commande pour l'instant</td>
                                </tr>
                                @else
                                    @foreach ($commandes as $key => $commande)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>

                                        <!-- Numéro commande -->
                                        <td>              
                                            <a href="{{ route('commandes.show', $commande->numero_commande) }}">
                                                {{ $commande->numero_commande }}                                           
                                            </a>
                                        </td>

                                        <!-- Statut -->
                                        <td>
                                            <span class="badge bg-{{ $badgeColors[$commande->statut] ?? 'secondary' }}">
                                                {{ $statutsLisibles[$commande->statut] ?? $commande->statut }}
                                            </span>
                                        </td>

                                        <!-- Date -->
                                        <td>{{ $commande->created_at->diffForHumans() }}</td>

                                        <!-- Changer statut -->
                                        <td>
    @if(in_array($commande->statut, ['livree', 'annulee']))
        <span class="text-muted">Statut final — non modifiable</span>
    @else
        <form action="{{ route('commandes.changerStatut', $commande->id) }}" method="POST">
            @csrf
            <div class="d-flex gap-2">

                <select name="statut" class="form-select form-select-sm w-auto">
                    @foreach($statutsLisibles as $key => $label)
                        <option value="{{ $key }}" @selected($commande->statut === $key)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary btn-sm">
                    Mettre à jour
                </button>

            </div>
        </form>
    @endif
</td>

                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div> <!-- end .table-responsive -->

                </div>
            </div>
        </div>
    </div>

</div>

@endsection
