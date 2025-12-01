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
                                    </div>
                                    <div class="cadres" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                                        @forelse ($accessoires as $product)
                                        <div class="cadre">
                                            <div class="cadImage">
                                                <img src="{{ asset('storage/' . $product->image_principale) }}"
                                                    alt="{{ $product->name }}">
                                                {{-- Méthode 2 alternative : Utiliser Storage::url() --}}
                                                {{-- <img src="{{ Storage::url($product->image_principale) }}" alt="{{ $product->name }}"> --}}
                                                {{-- Méthode 3 : Si vous utilisez uploads/produits directement --}}
                                                {{-- <img src="{{ asset('uploads/produits/' . basename($product->image_principale)) }}" alt="{{ $product->name }}"> --}}
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
