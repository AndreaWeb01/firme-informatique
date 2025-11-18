@extends('layouts.back.master')

@section('contenu')

 <!-- Start Content-->
 <div class="container-fluid">
        
    <!-- start page title -->
    <div class="py-3 py-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="page-title mb-0">Ajouter un Produit</h4>
            </div>
            <div class="col-lg-6">
                <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="">Tableau de bord</a></li>
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
                    <a href="{{ route('produits.index') }}" class="btn btn-soft-danger"> Liste Produits</a>
                    <p class="sub-header"></p>

                    <div class="row">
                        <div class="col-md-8">
                            <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nomproduit" class="form-label">Nom</label>
                                        <input type="text" name="nomproduit" class="form-control" id="nomproduit" placeholder="Entrez le nom du produit" >
                                        @error('nomproduit')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nomcategorie" class="form-label">Image Principal</label>
                                        <input type="file" name="imgproduit" class="form-control" id="imgproduit">
                                        @error('imgproduit')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="categories" class="form-label">Categories</label>
                                    <select name="categories" id="categories" class="form-control">
                                        <optgroup label="">
                                            <option selected disabled >Choisir une catégorie</option>
                                        </optgroup>
                                        @foreach($typeproduits as $typeproduit)
                                            <optgroup label="{{ $typeproduit->Nom_TypeProduit  }}">
                                                @foreach ($typeproduit->categories as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->Nom_Categorie }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div id="section-prix-stock" class="row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label for="prix" class="form-label">Prix</label>
                                        <input type="number" step="0.01" name="prix" class="form-control" placeholder="Prix">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" name="stock" class="form-control" placeholder="Stock" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="sku" class="form-label">Sku</label>
                                        <input type="text" name="sku" class="form-control" placeholder="sku">
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Autres images (optionnel)</label>
                                    <input class="form-control" type="file" name="images[]" multiple>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description </label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="5" placeholder="Ecrivez la description de la categorie"></textarea> 
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-primary" type="submit">Soumettre</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div> 
        </div> 


        
    </div>
    <!-- end row -->

</div> <!-- container -->


{{-- <script>
    // Quand on change Oui/Non dans le select
    document.querySelector('select[name="a_variantes"]').addEventListener('change', function () {
        const varianteSection = document.getElementById('section-variantes');
        if (this.value == "1") {
            varianteSection.style.display = 'block';
        } else {
            varianteSection.style.display = 'none';
            document.getElementById('liste-variantes').innerHTML = ''; // On vide les variantes
        }
    });

    // Ajout dynamique de variantes
    document.getElementById('ajouter-variante').addEventListener('click', function () {
        const container = document.getElementById('liste-variantes');
        const index = container.children.length;

        // Crée un nouveau bloc de variante
        const div = document.createElement('div');
        // div.classList.add('row', 'mb-3');
        // const container = document.getElementById('liste-variantes');


        div.innerHTML = `
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control" name="variantes[${index}][nom]" placeholder="Nom variante (ex: 8Go / 256Go SSD)">
            </div>

            <div class="col-md-2">
                <input type="text" class="form-control" name="variantes[${index}][sku]" placeholder="SKU">
            </div>

            <div class="col-md-2">
                <input type="number" class="form-control" name="variantes[${index}][prix]" placeholder="Prix" step="0.01">
            </div>

            <div class="col-md-2">
                <input type="number" class="form-control" name="variantes[${index}][stock]" placeholder="Stock">
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-danger supprimer-variante w-100">Supprimer</button>
            </div>
        </div>
        `;

        container.appendChild(div);
    });

    // Suppression d'une ligne de variante
    // document.getElementById('liste-variantes').addEventListener('click', function (e) {
    //     if (e.target.classList.contains('supprimer-variante')) {
    //         e.target.parentElement.remove();
    //     }
    // });

    document.getElementById('liste-variantes').addEventListener('click', function (e) {
    if (e.target.classList.contains('supprimer-variante')) {
        e.target.closest('.row').remove(); //  Corrigé
    }
});
</script> --}}



{{-- <script>
    let index = 1;

    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('ajouter-variante');
        const container = document.getElementById('variantes-container');

        btn.addEventListener('click', function () {
            const variante = document.createElement('div');
            variante.classList.add('row', 'mb-3', 'variante');
            variante.innerHTML = `
                <div class="col-md-3">
                    <input type="text" class="form-control" name="variantes[${index}][nom]" placeholder="Nom variante (ex: 8Go / 256Go SSD)">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="variantes[${index}][sku]" placeholder="SKU">
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="variantes[${index}][prix]" placeholder="Prix" step="0.01">
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="variantes[${index}][stock]" placeholder="Stock">
                </div>
            `;
            container.appendChild(variante);
            index++;
        });
    });
</script> --}}
    

@endsection


