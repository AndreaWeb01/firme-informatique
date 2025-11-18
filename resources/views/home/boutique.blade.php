@extends("layouts.front.app")

@section('title', 'Notre Boutique')

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

@section('content')

<main>
    <section class="mb-4">
        <div class="wrap">
            <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / Notre boutique</p>
            <div class="title">
                <h1>choisissez votre catégorie</h2>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="wrap">
            <div class="service-solution">
                <div class="serviceF">
                    <a href="{{ route('materielinfo') }}">
                        <div class="overlays"></div>
                        <img src="{{ url('assets/frontend/image/backgroundF.png') }}" alt="">
                    </a>
                    <p>Fourniture de materiel informatique</p>
                
                </div>
                <div class="serviceF moreText">
                    <a href="{{ route('accessoiresmaterielinfo') }}">
                        <div class="overlays"></div>
                        <img src="{{ url('assets/frontend/image/backgroundF1.png') }}" alt="">
                    </a>
                    
                    <p>Fourniture de consommables et accessoires pour MATERIELS INFORMATIQUES</p>
                
                </div>
                <div class="serviceF">
                    <a href="{{ route('solution') }}">
                    <div class="overlays"></div>
                    <img  src="{{ url('assets/frontend/image/backgroundF2.png') }}" alt="">
                    </a>
                    <p>FOURNITURE DE SOLUTIONS INFORMATIQUES</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="wrap">
            <div class="cadreProduit">
                <div class="cadres" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">

                    @foreach ($allproducts as $product)
                        <div class="cadre">
                            <div class="cadImage">
                                <img src="{{ url('/uploads/produits/', $product->image_principale )}}" alt="">
                            </div>
                            <a href="{{ route('produit.description', $product->slug)  }}">
                                <div class="search-cart">
                                    <div class="cart"><i class="fas fa-shopping-cart"></i></div>
                                </div>
                            </a>
                            <div class="product-detail">
                                <p>{{ $product->name }}</p>
                            </div>
                            <div class="prix">
                                <p>
                                    {{ number_format($product->prix, 0, ',', ' ') }} Fcfa
                                </p>
                            </div>
                            <div class="price">
                                <p>
                                    {{ number_format($product->prix, 0, ',', ' ') }} Fcfa
                                </p>
                            </div>
                        </div>
                    @endforeach
                    
                    
                </div>
            </div>   
        </div>
    </section>

</main>

@endsection