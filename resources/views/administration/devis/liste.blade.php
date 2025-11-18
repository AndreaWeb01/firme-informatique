@extends('layouts.back.master')

@section('contenu')

<!-- Start Content-->
<div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Liste Devis</h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Devis</li>
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
                    
                    {{-- <a href="{{ route('categories.create') }}" class="btn btn-soft-danger"> Ajouter un categorie</a> --}}
                    
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
                                    <th>Nom & Prenoms</th>
                                    <th>Services</th>
                                    <th>Envoyé à</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($devis->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Aucun devis pour l'instant</td>
                                    </tr>
                                @else
                                    @foreach ($devis as $key => $devis)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $devis->nom }} {{ $devis->prenom }}</td>
                                        <td>{{ $devis->service }}</td>
                                        <td>{{ $devis->created_at->diffForHumans() }}</</td>
                                        <td>

                                            <a href="{{ route('devis.show', $devis->id) }}" class="btn btn-primary"><i class="mdi mdi-eye"></i></a>
                                            {{-- <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-success"><i class="mdi mdi-file-edit"></i></a>

                                            <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette categorie?')">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>  --}} 
                                            
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
    <!-- end row -->
    
</div> <!-- container -->

@endsection