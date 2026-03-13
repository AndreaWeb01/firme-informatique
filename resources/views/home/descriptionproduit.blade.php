@extends("layouts.front.app")

@section('title', 'Boutique')

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
                <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / Fourniture de solution informatique</p>
            </div>
        </section>
        <section class="py-5">
           <div class="wrap">
                <div class="product-details" data-id="{{ $produit->id }}" data-nom="{{ $produit->name }}" data-prix="{{ $produit->prix }}">
                    <div class="product-img">
                        <div class="large-img">
                            <div class="caImg">
                                <img src="{{ url('storage/'. $produit->image_principale )}}" alt="">
                            </div>
                        </div>

                        <div class="sim-img">
                             @foreach($produit->images as $image)
                                <div class="caImgs">
                                    <img src="{{ asset('storage/'.$image->chemin_image )}}" alt="">
                                </div>
                             @endforeach

                        </div>
                    </div>
                    <div class="explit-product">
                        <h6>{{ $produit->name }}</h6>
                        <h5>{{ $produit->prix }} FCFA</h5>

                        @php
                            $stockActuel = $produit->stockDisponible();
                        @endphp
                        <p style="margin-top: 10px; font-weight: 600;">
                            Stock actuel :
                            @if ($stockActuel > 0)
                                <span style="color: green;">{{ $stockActuel }} en stock</span>
                            @else
                                <span style="color: red;">Rupture de stock</span>
                            @endif
                        </p>

                        <div class="title" style="margin-top: 15px;">
                            <h1>DESCRIPTION</h1>
                        </div>
                        <p>
                            {{ $produit->description }}
                        </p>

                        <button
                            id="addToCart"
                            data-id="{{ $produit->id }}"
                            data-name="{{ $produit->name }}"
                            data-price="{{ $produit->prix }}"
                            data-image="{{ url('/storage/'. $produit->image_principale )}}"
                            @if ($stockActuel <= 0) disabled class="btn-disabled" style="background:#ccc; cursor:not-allowed;" @endif
                        >
                            @if ($stockActuel <= 0)
                                Indisponible
                            @else
                                Ajouter au panier
                            @endif
                        </button>
                    </div>
                </div>
           </div>
        </section>

        <section class=" py-5">
            <div class="wrap">
                <div class="title">
                    <h1>DECOUVREZ des produits qui vous intéresserons</h2>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="wrap">
                <div class="cadres" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                    @foreach($produits as $vue)
                    <div class="cadre">
                        <div class="cadImage">
                            <img src="{{ url('storage/'. $vue->produit->image_principale )}}" alt="">
                        </div>
                        <div class="search-cart">
                            <button class="add-to-cart-btn"
                                    data-id="{{ $vue->produit->id }}"
                                    data-name="{{ $vue->produit->name }}"
                                    data-price="{{ $vue->produit->prix }}"
                                    data-image="{{ asset('storage/' . $vue->produit->image_principale) }}"
                                    title="Ajouter au panier">
                                <div class="cart"><i class="fas fa-shopping-cart"></i></div>
                            </button>
                        </div>
                        <a href="{{ route('produit.description', ['slug' => $vue->produit->slug, 'id' => $vue->produit->id]) }}">
                            <div class="product-detail">
                                <p>{{ $vue->produit->name }}</p>
                            </div>
                            <div class="prix">
                                <p>{{ $vue->produit->prix }} FCFA</p>
                            </div>
                            <div class="price">
                                <p>{{ $vue->produit->prix }} FCFA</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

    </main>


@endsection
