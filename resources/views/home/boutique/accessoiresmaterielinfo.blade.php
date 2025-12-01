@extends("layouts.front.app")

@section('title', 'Accessoires et consommables')

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
            <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / Fourniture de consommables et accessoires pour materiels informatiques</p>
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
                    <a href="#" class="filter-btn {{ $index === 0 ? 'active' : '' }}" data-id="{{ $type->id }}">
                        <div class="overlays"></div>
                        <img class="{{ $index === 0 ? 'actives' : '' }}" src="{{ asset('assets/frontend/image/backgroundF2.png') }}" alt="Matériel informatique">
                    
                     <p>{{ $type->Nom_TypeProduit }}</p> </a>
                </div> 
                 @endforeach 

           </div>
        </div>
    </section> 


        <section class="py-5">
            <div class="wrap">
                   <div class="cadreProduit" id="products-container">
               @include('home.partials.accessoire')
                </div>  
            </div> 
            </div>
        </section>
        
    </main>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.filter-btn');
    const container = document.getElementById('products-container');

    // Filtre par type de produit
    buttons.forEach(btn => {
        btn.addEventListener('click', function (event) {
            event.preventDefault();

            // Retirer la classe active de tous les boutons
            buttons.forEach(button => {
                button.classList.remove('active');
                const img = button.querySelector('img');
                if (img) {
                    img.classList.remove('actives');
                }
            });

            // Ajouter la classe active au bouton cliqué
            this.classList.add('active');
            const img = this.querySelector('img');
            if (img) {
                img.classList.add('actives');
            }

            const typeId = this.dataset.id;

            fetch(`/boutique/filter/${typeId}`)
                .then(res => res.text())
                .then(html => {
                    container.innerHTML = html;
                });
        });
    });

    // Délégation d'événements pour les filtres par catégorie (chargés dynamiquement)
    document.addEventListener('click', function(e) {
        const categoryBtn = e.target.closest('.filter-category-btn');
        if (categoryBtn) {
            e.preventDefault();
            
            const categoryId = categoryBtn.dataset.categoryId;
            
            // Retirer active de tous les boutons de catégories
            document.querySelectorAll('.filter-category-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            categoryBtn.classList.add('active');
            
            // Filtrer par catégorie (à implémenter selon vos besoins)
            fetch(`/boutique/filter-category/${categoryId}`)
                .then(res => res.text())
                .then(html => {
                    container.innerHTML = html;
                })
                .catch(error => console.error('Erreur:', error));
        }
    });
});

// Recherche de produits (par nom ou catégorie) - insensible à la casse
$(document).ready(function() {
    console.log('Script de recherche chargé');
    console.log('Input trouvé:', $('#search-input').length);
    
    // Recherche avec délégation d'événements
    $(document).on('keyup', '#search-input', function() {
        let search = $(this).val();
        console.log('Recherche pour:', search); // Debug

        if (search.length < 2) {
            $('#search-results').hide().html('');
            return;
        }

        $('#loader').show();

        $.ajax({
            url: "{{ route('produits.search') }}",
            type: "GET",
            data: { search: search },
            success: function(data) {
                console.log('Résultats reçus:', data); // Debug
                $('#loader').hide();
                let html = '';

                if (data.length === 0) {
                    html = '<p style="padding: 10px; color: #999;">Aucun résultat trouvé pour "' + search + '"</p>';
                } else {
                    data.forEach(p => {
                        html += `
                            <div class="result-item" onclick="window.location.href='/boutique/${p.slug}'">
                                <img src="/storage/${p.image}" alt="${p.nom}" onerror="this.src='/assets/frontend/image/default-product.png'">
                                <div>
                                    <p><strong>${p.nom}</strong></p>
                                    <p style="font-size: 12px; color: #666;">${p.categorie}</p>
                                    <p style="color: #0261CD; font-weight: bold;">${Number(p.prix).toLocaleString()} FCFA</p>
                                </div>
                            </div>
                        `;
                    });
                }

                $('#search-results').html(html).show();
            },
            error: function(xhr, status, error) {
                $('#loader').hide();
                console.error('Erreur de recherche:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);
                $('#search-results').html('<p style="padding: 10px; color: red;">Erreur lors de la recherche</p>').show();
            }
        });
    });

    // Cacher la liste quand on clique à l'extérieur
    $(document).click(function(event) {
        if (!$(event.target).closest('#search-input, #search-results').length) {
            $('#search-results').hide();
        }
    });
});
</script> 

@endsection