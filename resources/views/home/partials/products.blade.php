@php
    $showCategories = $showCategories ?? true;
@endphp

@if ($showCategories)
    <div class="categorie">
        <div class="category-produit mt-3">
            <div class="category-title">
                <h6>Categories</h6>

                <div class="category-list">
                    {{-- Bouton "Tous" pour afficher toutes les catégories --}}
                    @php
                        $currentCategory = $selectedCategoryId ?? 'all';
                    @endphp

                    <a href="#"
                       class="filter-category-btn {{ $currentCategory === 'all' ? 'active' : '' }}"
                       data-category-id="all">
                        Tous
                    </a>

                    {{-- Boutons pour chaque catégorie --}}
                    @foreach ($categories as $category)
                        <a href="#"
                           class="filter-category-btn {{ (string)$currentCategory === (string)$category->id ? 'active' : '' }}"
                           data-category-id="{{ $category->id }}">
                            {{ $category->Nom_Categorie }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif

<div class="cadres" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">

    @forelse ($products as $product)

        <div class="cadre">
            <div class="cadImage">
                <img src="{{ asset('storage/' . $product->image_principale) }}"
                     alt="{{ $product->name }}">
            </div>

            <div class="search-cart">
                <button class="add-to-cart-btn"
                        data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}"
                        data-price="{{ $product->prix }}"
                        data-image="{{ asset('storage/' . $product->image_principale) }}"
                        title="Ajouter au panier">
                    <div class="cart"><i class="fas fa-shopping-cart"></i></div>
                </button>
            </div>

            <a href="{{ route('produit.description', ['slug' => $product->slug, 'id' => $product->id]) }}">
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
