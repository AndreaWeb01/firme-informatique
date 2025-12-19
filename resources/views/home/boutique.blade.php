@extends("layouts.front.app")

@section('title', 'Notre Boutique')

@section('banner')

<div class="banner">
    <div class="imager">
        <div class="images">
            <img src="{{ asset('assets/frontend/image/left-background.png') }}" alt="">
        </div>
    </div>
    <div class="contents">
        <h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</h1>
        <a href="{{ route('boutique') }}" class="btn-yellow">Commencer vos achats</a>
    </div>
</div>

@endsection

@section('content')

<main>
    <section class="mb-4">
        <div class="wrap">
            <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / Notre boutique</p>
            <div class="title">
                <h1>choisissez votre catégorie</h1>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="wrap">
            <div class="service-solution">
                <div class="serviceF">
                    <a href="materiel.html">
                        <div class="overlays"></div>
                        <img class="" src="{{ asset('assets/frontend/image/backgroundF.png') }}" alt="Matériel informatique">
                    </a>
                    <p>Fourniture de materiel informatique</p>
                    <!-- <a href="installation.html">En savoir plus</a> -->
                </div>
                <div class="serviceF moreText">
                    <a href="fourniture.html">
                        <div class="overlays"></div>
                        <img src="{{ asset('assets/frontend/image/backgroundF1.png') }}" alt="Consommables et accessoires">
                    </a>

                    <p>Fourniture de consommables et accessoires pour MATERIELS INFORMATIQUES</p>
                    <!-- <a href="maintenance.html">En savoir plus</a> -->
                </div>
                <div class="serviceF">
                    <div class="overlays"></div>
                    <img src="{{ asset('assets/frontend/image/backgroundF2.png') }}" alt="Solutions informatiques">
                    <p>FOURNITURE DE SOLUTIONS INFORMATIQUES</p>
                    <!-- <a href="#">En savoir plus</a> -->
                </div>
            </div>

            {{-- <div class="service-solution">
                @foreach ($types as $index => $type)
                <div class="serviceF">
                    <a href="#" class="filter-btn {{ $index === 0 ? 'active' : '' }}" data-id="{{ $type->id }}">
            <div class="overlays"></div>
            <img class="{{ $index === 0 ? 'actives' : '' }}" src="{{ asset('assets/frontend/image/backgroundF2.png') }}" alt="Matériel informatique">

            <p>{{ $type->Nom_TypeProduit }}</p>
            </a>
        </div>
        @endforeach
        </div> --}}
        </div>
    </section>

    <section class="py-5">
        <div class="wrap">
            <div class="cadreProduit" id="products-container">

                <div class="categorie">
                    <div class="search-carts">
                        <div class="search-boxs">
                            <input type="text" id="search-input" placeholder="Rechercher..." autocomplete="off">
                            <span class="separator">|</span>
                            <i class="fas fa-search search-icon"></i>
                        </div>
                        <div id="search-results"></div>
                        <div id="loader" style="display:none;">
                            <div class="spinner"></div>
                        </div>
                    </div>
                    {{-- <div class="category-produit mt-3">
                        <div class="category-title">
                            <h6>Categories</h6>
                            <div class="category-list">
                                @foreach ($categories as $index => $category)
                                <a href="#" class="filter-category-btn {{ $index===0 ? 'active' : '' }}" data-category-id="{{ $category->id }}">
                                    {{ $category->Nom_Categorie }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="cadres" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                    @forelse ($allproducts as $product)
                    <div class="cadre">
                        <div class="cadImage">


                            <img src="{{ asset('storage/' . $product->image_principale) }}" alt="{{ $product->name }}">

                            {{-- Méthode 2 alternative : Utiliser Storage::url() --}}
                            {{-- <img src="{{ Storage::url($product->image_principale) }}" alt="{{ $product->name }}"> --}}

                            {{-- Méthode 3 : Si vous utilisez uploads/produits directement --}}
                            {{-- <img src="{{ asset('uploads/produits/' . basename($product->image_principale)) }}" alt="{{ $product->name }}"> --}}
                        </div>
                        <div class="search-cart">
                            <button class="add-to-cart-btn" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->prix }}" data-image="{{ asset('storage/' . $product->image_principale) }}" title="Ajouter au panier">
                                <div class="cart"><i class="fas fa-shopping-cart"></i></div>
                            </button>
                        </div>
                        <a href="{{ route('produit.description', $product->slug) }}">
                            <div class="product-detail">
                                <p>{{ $product->name }}</p>
                            </div>
                            <div class="prix">
                                <p>{{ number_format($product->prix, 0, ',', ' ') }} Fcfa</p>
                            </div>
                            <div class="price">
                                <p>{{ number_format($product->prix, 0, ',', ' ') }} Fcfa</p>
                            </div>
                        </a>
                    </div>

                    @empty
                    <div class="no-products">
                        <p>Aucun produit disponible pour le moment.</p>
                    </div>
                    @endforelse
                </div>


                {{-- @include('home.partials.products', ['products' => $allproducts, 'categories' => $categories]) --}}
            </div>
        </div>
    </section>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.filter-btn');
        const container = document.getElementById('products-container');

        // Filtre par type de produit
        buttons.forEach(btn => {
            btn.addEventListener('click', function(event) {
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
                url: "{{ route('produits.search') }}"
                , type: "GET"
                , data: {
                    search: search
                }
                , success: function(data) {
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
                }
                , error: function(xhr, status, error) {
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
