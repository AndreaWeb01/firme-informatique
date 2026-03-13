@extends('layouts.back.master')

@section('contenu')

<!-- Start Content-->
<div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Liste Stocks</h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Stocks</li>  
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
                    
                    <a href="{{ route('stocks.create') }}" class="btn btn-soft-danger"> Ajouter un stock</a>    
                    
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
                                    <th>N°</th>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Mouvement</th>
                                    <th>Stock Actuel</th>
                                    <th>Date de création</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($stocks->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">Aucun stock pour l'instant</td>
                                    </tr>
                                @else
                                    @foreach ($stocks as $key => $stock)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $stock->produit->name }}</td>
                                        <td>{{ $stock->quantité }}</td>
                                        <td>{{ $stock->mouvement }}</td>
                                        <td>{{ $stockActuelParProduit[$stock->produit_id] ?? 0 }}</td>
                                        <td>{{ optional($stock->created_at)->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('produits.show', $stock->produit_id) }}" class="btn btn-primary"><i class="mdi mdi-eye"></i></a>    
                                             <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-success"><i class="mdi mdi-file-edit"></i></a>
                                            <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stock?')">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>    
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
  
                            </tbody>
                        </table>
                    </div> 
                    <!-- end table-responsive-->
                </div>
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
</div> <!-- container -->

@endsection