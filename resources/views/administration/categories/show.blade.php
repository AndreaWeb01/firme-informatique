@extends('layouts.back.master')

@section('contenu')

     <!-- Start Content-->
 <div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Voir la categorie <i>{{ $category->name }}</i></h4>
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
                    <a href="{{ route('categories.index') }}" class="btn btn-soft-danger"> Retour</a>
                    <p class="sub-header"></p>

                    <p>{{ $category->name }}</p>
                    <p>{{ $category->description }}</p>


                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubCategoryModal">Ajouter une sous-catégorie</a>


                    <!-- Modal -->
                    <div class="modal fade" id="addSubCategoryModal" tabindex="-1" aria-labelledby="addSubCategoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" action="{{ route('subcategories.store') }}">
                                    @csrf

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addSubCategoryModalLabel">Ajouter une sous-catégorie</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nom de la sous-catégorie</label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="description"></textarea>
                                        </div>
                                        <input type="hidden"  class="form-control" name="id_category" id="id_category" value="{{ $category->id }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <p class="sub-header"></p>

                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>N°</th>
                                <th>Nom Sous-Categorie</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category->subcategories as $subcategory)
                                <tr>
                               
                                    <td>{{ $subcategory->id }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>
                                        <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $subcategory->id }}"><i class="mdi mdi-file-edit"></i></a>

                                        <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"  onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette sous-categorie?')">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form> 





                                        <!-- Modal Édition -->
                                        <div class="modal fade" id="editModal{{ $subcategory->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $subcategory->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="POST" action="{{ route('subcategories.update', $subcategory->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $subcategory->id }}">Modifier la sous-catégorie</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name{{ $subcategory->id }}" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" name="name" id="name{{ $subcategory->id }}" value="{{ $subcategory->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description{{ $subcategory->id }}" class="form-label">Description</label>
                                                    <textarea class="form-control" name="description" id="description{{ $subcategory->id }}">{{ $subcategory->description }}</textarea>
                                                </div>
                                                <input type="hidden" name="category_id" value="{{ $subcategory->category_id }}">
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                        </div>




                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div> 
        </div> 


        
    </div>
    <!-- end row -->

</div> <!-- container -->

@endsection