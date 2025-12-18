@extends("layouts.front.app")

@section('title', 'Fourniture de solutions informatiques')

@section('banner')

<div class="banner">
    <div class="imager">
        <div class="images">
            <img src="{{ url('assets/frontend/image/left-background.png') }}" alt="">
        </div>
    </div>
    <div class="contents">
        <h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</h1>
        <a href="{{ route('boutique') }}" class="btn-yellow">Commencer vos achats</a>
    </div>
</div>

@endsection

@section("content")

<main>
    <section class="mb-4">
        <div class="wrap">
            <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / Fourniture de solutions informatiques</p>
            <div class="title">
                <h1>choisissez votre catégorie</h2>
            </div>
        </div>
    </section>
       <section class="py-5">
        <div class="wrap">
            <div class="service-solution">
                @foreach ($types as $index => $type)
                <div class="serviceF">
                    <a href="#" class="filter-btn {{ (isset($selectedTypeId) && $selectedTypeId == $type->id) ? 'active' : '' }}" data-id="{{ $type->id }}">
                        <div class="overlays"></div>
                        <img class="{{ (isset($selectedTypeId) && $selectedTypeId == $type->id) ? 'actives' : '' }}" src="{{ asset('assets/frontend/image/backgroundF2.png') }}" alt="Matériel informatique">
                
                     <p>{{ $type->Nom_TypeProduit }}</p> </a>
                </div> 
                 @endforeach 
           </div>
        </div>
    </section> 
        <section class="py-5">
            <div class="wrap">
                   <div class="cadreProduit" id="products-container">
               @include('home.partials.solution')
                </div>  
            </div> 
            </div>
        </section>
        
    </main>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
// ===============================
//  FILTRE PAR TYPE DE PRODUIT
// ===============================
document.addEventListener('DOMContentLoaded', function () {

    const buttons = document.querySelectorAll('.filter-btn');
    const container = document.getElementById('products-container');
    let selectedTypeId = document.querySelector('.filter-btn.active') ? document.querySelector('.filter-btn.active').dataset.id : null;
    let selectedCategoryId = document.querySelector('.filter-category-btn.active') ? document.querySelector('.filter-category-btn.active').dataset.categoryId : null;

    if (buttons.length > 0) {
        buttons.forEach(btn => {
            btn.addEventListener('click', function (event) {
                event.preventDefault();
    
                // Retirer active de tous les boutons
                buttons.forEach(button => {
                    button.classList.remove('active');
                    const img = button.querySelector('img');
                    if (img) img.classList.remove('actives');
                });
    
                // Ajouter la classe active
                this.classList.add('active');
                const img = this.querySelector('img');
                if (img) img.classList.add('actives');
    
                const typeId = this.dataset.id;
                selectedTypeId = typeId;
    
                fetch(`/boutique/filter-combined?type_id=${encodeURIComponent(selectedTypeId || '')}&category_id=${encodeURIComponent(selectedCategoryId || '')}`)
                    .then(res => res.text())
                    .then(html => {
                        container.innerHTML = html;
                    })
                    .catch(err => console.error("Erreur filtre type:", err));
            });
        });
    }

    // ===============================
    //  FILTRE PAR CATÉGORIE (dynamique)
    // ===============================
    document.addEventListener('click', function(e) {
        const categoryBtn = e.target.closest('.filter-category-btn');
        if (!categoryBtn) return;

        e.preventDefault();

        const categoryId = categoryBtn.dataset.categoryId;
        selectedCategoryId = categoryId;

        document.querySelectorAll('.filter-category-btn')
            .forEach(btn => btn.classList.remove('active'));

        categoryBtn.classList.add('active');

        fetch(`/boutique/filter-combined?type_id=${encodeURIComponent(selectedTypeId || '')}&category_id=${encodeURIComponent(selectedCategoryId || '')}`)
            .then(res => res.text())
            .then(html => container.innerHTML = html)
            .catch(err => console.error("Erreur filtre catégorie:", err));
    });

});


// ===============================
//  RECHERCHE AJAX (JQUERY)
// ===============================
$(document).ready(function() {

    // Recherche en temps réel
    $(document).on('keyup', '#search-input', function() {

        let search = $(this).val().trim();

        if (search.length < 2) {
            $('#search-results').hide().html('');
            return;
        }

        $('#loader').show();

        $.ajax({
            url: "{{ route('produits.search') }}",
            type: "GET",
            data: { search },
            success: function(data) {
                $('#loader').hide();

                let html = '';

                if (data.length === 0) {
                    html = `<p class="no-result">Aucun résultat trouvé pour "${search}"</p>`;
                } else {
                    data.forEach(p => {
                        html += `
                            <div class="result-item" onclick="window.location.href=routes.produit.replace(':slug', '${p.slug}').replace(':id', '${p.id}')">
                                <img src="/storage/${p.image}" alt="${p.nom}"
                                     onerror="this.src='/assets/frontend/image/default-product.png'">
                                <div class="info">
                                    <p><strong>${p.nom}</strong></p>
                                    <p class="cat">${p.categorie}</p>
                                    <p class="prix">${Number(p.prix).toLocaleString()} FCFA</p>
                                </div>
                            </div>`;
                    });
                }

                $('#search-results').html(html).show();
            },
            error: function(xhr) {
                $('#loader').hide();
                console.error("Erreur recherche:", xhr.responseText);
                $('#search-results').html('<p class="error">Erreur lors de la recherche</p>').show();
            }
        });
    });

    // Cacher la recherche si clic extérieur
    $(document).click(function(event) {
        if (!$(event.target).closest('#search-input, #search-results').length) {
            $('#search-results').hide();
        }
    });

});
</script>


@endsection
