@extends('layouts.back.master')

@section('contenu')

<!-- Start Content-->
<div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Liste Conseils</h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Conseils</li>
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
                    
                    <a href="{{ route('actuconseils.create') }}" class="btn btn-soft-danger"> Ajouter un conseil</a>
                    
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
                                    <th>Image</th>
                                    <th>Titre</th>
                                    <th>Publié le</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($actuconseils->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">Aucun conseils pour l'instant</td>
                                    </tr>
                                @else
                                    @foreach ($actuconseils as $key => $conseils)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td><img src="{{ url('uploads/conseils', $conseils->image) }}" alt="" width="50" height="50"></td>
                                        <td>{{ $conseils->titre }}</td>
                                        <td>{{ $conseils->created_at->diffForHumans() }}</td>
                                        <td>

                                            <a href="{{ route('actuconseils.show', $conseils->id) }}" class="btn btn-primary"><i class="mdi mdi-eye"></i></a>
                                            <a href="{{ route('actuconseils.edit', $conseils->id) }}" class="btn btn-success"><i class="mdi mdi-file-edit"></i></a>

                                            <form action="{{ route('actuconseils.destroy', $conseils->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet conseil?')">
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