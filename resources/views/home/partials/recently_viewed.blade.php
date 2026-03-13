@if(isset($recentlyViewed) && $recentlyViewed->count())
<section class="py-5">
    <div class="wrap">
        <div class="title">
            <h1>vue récemment</h1>
        </div>
        <div class="cadres" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
            @foreach($recentlyViewed as $vue)
                @php $prod = $vue->produit ?? $vue; @endphp
                <div class="cadre">
                    <div class="cadImage">
                        <img src="{{ url('storage/'. $prod->image_principale) }}" alt="{{ $prod->name }}">
                    </div>
                    <div class="search-cart">
                        <button class="add-to-cart-btn"
                                data-id="{{ $prod->id }}"
                                data-name="{{ $prod->name }}"
                                data-price="{{ $prod->prix }}"
                                data-image="{{ asset('storage/' . $prod->image_principale) }}"
                                title="Ajouter au panier">
                            <div class="cart"><i class="fas fa-shopping-cart"></i></div>
                        </button>
                    </div>
                    <a href="{{ route('produit.description', ['slug' => $prod->slug, 'id' => $prod->id]) }}">
                        <div class="product-detail">
                            <p>{{ $prod->name }}</p>
                        </div>
                        <div class="prix">
                            <p>{{ $prod->prix }} FCFA</p>
                        </div>
                        <div class="price">
                            <p>{{ $prod->prix }} FCFA</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
