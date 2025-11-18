@extends('layouts.back.master')

@section('contenu')

<!-- Start Content-->
<div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Liste Roles</h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tableau de bord</a></li>
                    <li class="breadcrumb-item active">Roles</li>
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
                    
                    <a href="{{ route('roles.create') }}" class="btn btn-soft-danger"> Ajouter Role</a>
                    
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
                                    <th>Nom</th>
                                    <th>Permissions</th>
                                    <th>Crée à</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($roles->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">Aucun rôle disponible actuellement</td>
                                    </tr>
                                @else
                                    @foreach ($roles as $key =>$role)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                                        <td>{{ $role->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="btn btn-warning">
                                                Autorisations
                                            </a>
                                            <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-success">Modifier</a>

                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?')">
                                                    Supprimer
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

{{-- <h3>Liste des rôles</h3> --}}

{{-- Barre de navigation --}}

{{-- @include('layouts.back.navigation') --}}

{{-- End Barre de navigation --}}


{{-- <div class="my-5">
    <a class="btn btn-outline-primary" href="{{ route('roles.create') }}" role="button">Ajouter</a>

    <div class="my-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Permissions</th>
            <th>Crée à</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            @if ($roles->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">Aucun rôle disponible actuellement</td>
                </tr>
            @else
                @foreach ($roles as $key =>$role)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->permissions->pluck('name')->implode(', ') }}</td>
                    <td>{{ $role->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" class="btn btn-warning">
                            Autorisations
                        </a>
                        <a href="{{ url('roles/'.$role->id.'/edit') }}" class="btn btn-success">Modifier</a>
                        <a href="{{ url('roles/'.$role->id.'/delete') }}" class="btn btn-danger">Supprimer</a>
                       
                    </td>
                </tr>
                @endforeach
            @endif
      
    </tbody>
</table> --}}

@endsection