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
                                <img src="{{ url('/uploads/produits/', $produit->image_principale )}}" alt="">
                            </div>
                        </div>

                        <div class="sim-img">
                             @foreach($produit->images as $image)
                                <div class="caImgs">
                                    <img src="{{ asset($image->chemin_image )}}" alt="">
                                </div>
                             @endforeach
                            
                            {{-- <div class="caImgs">
                                <img src="image/ordi2.png" alt="">
                            </div>
                            <div class="caImgs">
                                <img src="image/ordi2.png" alt="">
                            </div> --}}
                        </div>
                    </div>
                    <div class="explit-product">
                        <h6>{{ $produit->name }}</h6>
                        <h5>{{ $produit->prix }} FCFA</h5>
                        <div class="title">
                            <h1>DESCRIPTION</h2>
                        </div>
                        <p>
                            {{ $produit->description }}</p><p>
                            HP EliteBook X360 1040 G8 Core i7 -1185G7 (11ème Génération) @ 3.00 GHz, 
                            avec la Reconnaissance Faciale, Ecran Tactile Pliable à 360°,
                             avec 1  Tera SSD et 16 Go Ram, Un Sac et une Souris externe Offerts, 
                             En Stock,  En Excellent Etat [image réelle].
                            <p>● intel Core i7 -1185G7 (11ème Génération) @ 3.00 GHz/ Ram: 16 Go
                            </p>
                            <p>
                                ●SSD: 1000 Go / Écran TactileQHD 14" Pliable 360°
                            </p>
                            <p>
                                ●intel UHD Graphics 630 (8 Go totale) / Bluetooth / Port HDMI
                            </p>
                            
                            <p>●Clavier Retroeclairé (Lumineux) / Autonomie: 4H/ Bang & Olufsen 
                            Avec GARANTIE / Livraison Gratuite   </p>
                            ■■ Conçu pour Exécuter des Applications 
                              Professionnelles, Réaliser  des modélisations en 3D et d'autres tâches gourmandes
                               en ressources  graphique
                        </p>

                        <button id="addToCart" data-id="{{ $produit->id }}" data-name="{{ $produit->name }}" data-price="{{ $produit->prix }}" data-image="{{ url('/uploads/produits', $produit->image_pp )}}">Ajouter au panier</button>

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
                    <div class="cadre">
                        <div class="cadImage">
                            <img src="image/microphone.jpg" alt="">
                        </div>
                        <a href="#">
                            <div class="search-cart">
                                <div class="cart"><i class="fas fa-shopping-cart"></i></div>
                            </div>
                        </a>
                        <div class="product-detail">
                            <p>Casques</p>
                        </div>
                        <div class="prix">
                            <p>200 0000 Fcfa</p>
                        </div>
                        <div class="price">
                            <p>200 0000 Fcfa</p>
                        </div>
                    </div>
                    <div class="cadre">
                        <div class="cadImage">
                            <img src="image/cable1.jpg" alt="">
                        </div>
                        <a href="#">
                            <div class="search-cart">
                                <div class="cart"><i class="fas fa-shopping-cart"></i></div>
                            </div>
                        </a>
                        <div class="product-detail">
                            <p>Casques</p>
                        </div>
                        <div class="prix">
                            <p>200 0000 Fcfa</p>
                        </div>
                        <div class="price">
                            <p>200 0000 Fcfa</p>
                        </div>
                    </div>
                    <div class="cadre">
                        <div class="cadImage">
                            <img src="image/camera1.png" alt="">
                        </div>
                        <a href="#">
                            <div class="search-cart">
                                <div class="cart"><i class="fas fa-shopping-cart"></i></div>
                            </div>
                        </a>
                        
                        <div class="product-detail">
                            <p>microphone PPP</p>
                            
                        </div>
                        <p class="prix">200 0000 Fcfa</p>
                        <div class="price">
                            <p>200 0000 Fcfa</p>
                        </div>
                    </div>
                    <div class="cadre">
                        <div class="cadImage">
                            <img src="image/baffe.jpg" alt="">
                        </div>
                        <a href="#">
                            <div class="search-cart">
                                <div class="cart"><i class="fas fa-shopping-cart"></i></div>
                            </div>
                        </a>
                        <div class="product-detail">
                            <p>Casques</p>
                        </div>
                        <div class="prix">
                            <p>200 0000 Fcfa</p>
                        </div>
                        
                        <div class="price">
                            <p>200 0000 Fcfa</p>
                        </div>
                    </div>
                    <div class="cadre">
                        <div class="cadImage">
                            <img src="image/headphone.png" alt="">
                        </div>
                        <a href="#">
                            <div class="search-cart">
                                <div class="cart"><i class="fas fa-shopping-cart"></i></div>
                            </div>
                        </a>
                        <div class="product-detail">
                            <p>Casques</p>
                        </div>
                        <div class="prix">
                            <p>200 0000 Fcfa</p>
                        </div>
                        <div class="price">
                            <p>200 0000 Fcfa</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    

@endsection