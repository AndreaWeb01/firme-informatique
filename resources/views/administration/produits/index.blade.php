@extends('layouts.back.master')

@section('contenu')

<!-- Start Content-->
<div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Liste Produits</h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Produits</li>
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
                    
                    <a href="{{ route('produits.create') }}" class="btn btn-soft-danger"> Ajouter un produit</a>
                    
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
                                    <th>Image</th>
                                    <th>Titre</th>
                                    <th>Prix</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>         
                                
                                @if ($produits->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">Aucun produit pour l'instant</td>
                                    </tr>
                                @else
                                    @foreach ($produits as $key => $produit)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td><img src="{{ url('/uploads/produits', $produit->image_principale )}}" alt="" width="50" height="50"></td>
                                        <td>{{ $produit->name }}</td>
                                        <td>
                                            <strong>{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</strong><br>
                                        </td>
                                        <td>
                                            {{-- {{ $produit->stockDisponible() }} --}}
                                        </td>
                                        <td>
                                            <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-primary"><i class="mdi mdi-eye"></i></a>
                                            <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-success"><i class="mdi mdi-file-edit"></i></a>

                                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet produit ?')">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
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