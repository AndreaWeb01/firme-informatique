@extends("layouts.front.app")

@section('title', 'Confirmer Paiement')

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
       
        <section class="">
           <div class="wrap">
            <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / <a href="{{ route('boutique') }}">Boutique</a> / Paiement</p>
            <div class="paie">
                <div class="pay-form">
                    <form action="" >
                        <div class="contacts-form">
                            <div class="inform-contact">
                                <div class="bloc1">
                                    <h5>Contact</h5>
                                </div>
                                <div class="bloc2">
                                    <a href="connectPage.html">Suivre ma commande</a>
                                </div>
                            </div>

                            <div class="erreur">
                                <input type="tel" placeholder="Entrer votre contact" class="box">
                            </div>
                        </div>

                        <div class="paiement-info mt-4">
                            <h5  style="margin-bottom: 15px;">Paiement</h5>
                            <p  style="margin-bottom: 5px; font-size: 14px;">Toutes les transactions sont chiffrées et sécurisées</p>
                            <div class="erreur">
                                <input type="text" placeholder="paiement à la Livraison" class="box">
                            </div>
                        </div>

                        <div class="livraison-adresse mt-4">
                            <h5  style="margin-bottom: 15px;">Adresse de livraison</h5>
                            <div class="presentation">
                                <div class="erreurs">
                                    <input type="text" placeholder="Entrer votre nom" class="box">
                                </div>
                                <div class="erreurs">
                                    <input type="text" placeholder="Entrer votre prenom" class="box">
                                </div>
                            </div>
                            <div class="erreur">
                                <input type="email" placeholder="Entrer votre email " class="box">
                            </div>
                            <div class="erreur">
                                <input type="tel" placeholder="Entrer numero de téléphone" class="box">
                            </div>
                            <div class="erreur">
                                <input type="password" placeholder="Entrer votre mot de passe " class="box">
                            </div>
                        </div>
                       
                        <button class="btn-paye">Confirmer votre paiement</button>
                    </form>
                </div>
                <div class="cart-form">
                    <h5>Resumé de votre facture</h5>
                    <div class="carts-form mb-3">
                        <div class="products-img">
                            <div class="caImgs">
                                <img src="image/ordi2.png" alt="">
                            </div>
                        </div>
                        <div class="product-name">
                            <h6>HP EliteBook X360 1040 G8 Core i7 -1185G7 _ 3.00 GHz, Tactile Pliable, 1 Tera SSD, 16 Go Ram</h6>
                        </div>
                        <div class="productPrice">
                            <h6>289 000 Fcfa</h6>
                        </div>
                    </div>
                   
                    
                    <div class="totalproduct">
                        <div class="total">
                            <h6 style="text-transform: uppercase;">Total</h6>
                        </div>
                        <div class="productPrice">
                            <h6>289 000 Fcfa</h6>
                        </div>
                    </div>

                    

                    <div class="confidentialite mt-5">
                        <div class="retour">
                            <a href="politique.html">Politique de retour</a>
                        </div>
                        <div class="confi">
                            <a href="confidentialite.html">Politique de confidentialite</a>
                        </div>
                        <div class="use">
                            <a href="terme.html">Condition d'utilisation</a>
                        </div>
                    </div>
                </div>
            </div>
           </div>
        </section>

        
        <section class="mb-4 mt-5">
            <div class="wrap">
                <div class="title">
                    <h1>vue récemment</h1>
                </div>
            </div>
        </section>

        <section class="py-2">
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