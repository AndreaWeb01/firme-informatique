@extends("layouts.front.app")

@section('title', 'Mon Panier')

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
        <p class="return"><a href="{{ route('accueil') }}">Accueil</a>/ <a href="{{ route('boutique') }}">Boutique</a>/ Panier</p>
        <div class="tableau">
            <div class="table-responsive">
                <table class="table  text-center">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="panierTableBody">
                        <!-- lignes des produits ici -->
                    </tbody>
                </table>
            </div>

            <div class="totalproducts">
                <div class="total">
                    <h6>Total</h6>
                </div>
                <div class="productPrice">
                    <h6 id="cartTotal">289 000 FCFA</h6>
                </div>
            </div>

            <div class="gotobuy mb-5">
                <a href="{{ route('confirm.payment') }}">payer maintenant</a>
            </div>
        </div>
        
        </div>
    </section>

    
    <section class="">
        <div class="wrap">
            <div class="title">
                <h1>vue récemment</h1>
            </div>
        </div>
    </section>

    <section class="">
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