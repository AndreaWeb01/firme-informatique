@extends("layouts.front.app")

@section('title', 'Fourniture de materiels ')

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
            <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / Fourniture de matériel informatique</p>
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
                        <img class="actives" src="{{ url('assets/frontend/image/backgroundF.png') }}" alt="">
                    </a>
                    <p>Fourniture de materiel informatique</p>
                        <!-- <a href="installation.html">En savoir plus</a> -->
                </div>
                <div class="serviceF">
                    <a href="{{ route('accessoiresmaterielinfo') }}">
                        <div class="overlays"></div>
                        <img src="{{ url('assets/frontend/image/backgroundF1.png') }}" alt="">
                    </a>
                    <p>Fourniture de consommables et accessoires pour MATERIELS INFORMATIQUES</p>
                    <!-- <a href="maintenance.html">En savoir plus</a> -->
                </div>
                <div class="serviceF">
                    <a href="{{ route('solution') }}">
                        <div class="overlays"></div>
                        <img  src="{{ url('assets/frontend/image/backgroundF2.png') }}" alt="">
                    </a>
                    <p>FOURNITURE DE SOLUTIONS INFORMATIQUES</p>
                    <!-- <a href="#">En savoir plus</a> -->
                </div>
                </div>
           </div>
        </section>


        <section class="py-5">
            <div class="wrap">
                <div class="cadreProduit">
                    <div class="categorie">
                        <div class="search-carts">
                            <div class="search-boxs">
                                <input type="text" placeholder="Rechercher...">
                                <span class="separator">|</span>
                                <i class="fas fa-search search-icon"></i>
                            </div>
                        </div>
                        <div class="category-produit mt-3">
                            <div class="category-title">
                                <h6>Categories</h6><br>
                                <p>voir plus</p>
                            </div>
                            <div class="category-name">
                                <p class="categorie-item">Ordinateurs</p>
                                <p class="categorie-item">Téléphones</p>
                                <p class="categorie-item">Accessoires</p>
                                <p class="categorie-item">TV</p>
                                <p class="categorie-item">Autres</p>
                            </div>

                        </div>
                    </div>
                    <div class="cadres" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                        <div class="cadre">
                            <div class="cadImage">
                                <img src="{{ url('assets/frontend/image/microphone.jpg')}}" alt="">
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
                                <img src="{{ url('assets/frontend/image/cable1.jpg')}}" alt="">
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
                                <img src="{{ url('assets/frontend/image/camera1.png') }}" alt="">
                            </div>
                            <a href="#">
                                <div class="search-cart">
                                    <div class="cart"><i class="fas fa-shopping-cart"></i></div>
                                </div>
                            </a>
                            
                            <div class="product-detail">
                                <p>microphone PPPPPPPPP
                                    PPPPPPPP PPPPPP PPPPPP</p>
                                
                            </div>
                            <p class="prix">200 0000 Fcfa</p>
                            <div class="price">
                                <p>200 0000 Fcfa</p>
                            </div>
                        </div>
                        <div class="cadre">
                            <div class="cadImage">
                                <img src="{{ url('assets/frontend/image/microphone.jpg')}}" alt="">
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
                                <img src="{{ url('assets/frontend/image/microphone.jpg')}}" alt="">
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
                                <img src="{{ url('assets/frontend/image/microphone.jpg')}}" alt="">
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
                                <img src="{{ url('assets/frontend/image/microphone.jpg')}}" alt="">
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
                                <img src="{{ url('assets/frontend/image/microphone.jpg')}}" alt="">
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
                                <img src="{{ url('assets/frontend/image/microphone.jpg')}}" alt="">
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
            </div>
        </section>
        
     

       

    </main>

@endsection