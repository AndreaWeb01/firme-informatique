@extends('layouts.back.master')

@section('contenu')

<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Liste Categories</h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                    <ol class="breadcrumb m-0 float-end">
                        <li class="breadcrumb-item"><a href="">Tableau de bord</a></li>
                        <li class="breadcrumb-item active">Categories</li>
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

                    <a href="{{ route('categories.create') }}" class="btn btn-soft-danger"> Ajouter un categorie</a>

                    <p class="sub-header"></p>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Numéro de commande</th>
                                    <th>Statut</th>
                                    <th>Crée à</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($commandes->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">Aucune commande pour l'instant</td>
                                </tr>
                                @else
                                @foreach ($commandes as $key => $commander)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $commander->numero_commande }}</td>
                                    <td class="text-{{ $badgeColors[$commander->statut] ?? 'secondary' }}">
                                            {{ $statutsLisibles[$commander->statut] ?? $commander->statut }}                                   
                                    </td>
                                    <td>{{ $commander->created_at->diffForHumans() }}</td>
                                    <td>
                                        <form action="{{ route('commandes.changerStatut', $commander->id) }}" method="POST" class="mt-3">
                                            @csrf
                                            <div class="d-flex align-items-center gap-2">
                                                <select name="statut" class="form-control w-auto">
                                                    @foreach($statutsLisibles as $key => $label)
                                                    <option value="{{ $key }}" @if($commander->statut === $key) selected @endif>
                                                        {{ $label }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-primary">Changer le statut</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection