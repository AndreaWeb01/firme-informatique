@extends("layouts.front.app")

@section('title', 'Accueil')

@section('banner')

<div class="banner">
    <div class="imager">
        <div class="images">
            <img src="{{ url('assets/frontend/image/left-background.png') }}" alt="">
        </div>
    </div>
    <div class="contents">
        <h1>Bienvenue ! Vous êtes au bon endroit, Ici on parle d’informatique ! <br>
            Matériel informatique, système de sécurité, réseaux et 
            maintenance<br>
            On s’occupe de tout ! </h1>
        <a href="{{ route('boutique') }}" class="btn-yellow">Commencer vos achats</a>
    </div>
</div>

@endsection

@section("content")
<main>
    <section class="mb-4">
        <div class="wrap">
            <div class="title">
                <h1>DECOUVREZ NOS SERVICES</h2>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="wrap">
            <div class="services">
                <div class="materiel">
                    <div class="overlay"></div>
                    <img src="{{ url('assets/frontend/image/materiel-info.jpg')}}" alt="">
                    <p>Fourniture de matériels, accessoires informatiques et consommables</p>
                    <a href="{{ route('accessoiresmaterielinfo') }}">En savoir plus</a>
                </div>
                <div class="service">
                    <div class="service1">
                        <div class="service1a">
                            <div class="overlay"></div>
                                <img src="{{ url('assets/frontend/image/installe-camera.jpg') }}" alt="">
                                <p>Installation de caméra de surveillance et système de sécurité </p>
                                <a href="{{ route('installationcamera') }}">En savoir plus</a>
                            </div>
                            <div class="service2a">
                                <div class="overlay"></div>
                                <img src="{{ url('assets/frontend/image/entretien.png')}}" alt="">
                                <p>ENTRETIEN ET MAINTENANCE DE MATERIELS INFORMATIQUES</p>
                                <a href="{{ route('maintenance') }}">En savoir plus</a>
                            </div>
                        </div>
                        <div class="service2">
                            <div class="service2a">
                                <div class="overlay"></div>
                                <img src="{{ url('assets/frontend/image/solution-informatique.png')}}" alt="">
                                <p>FOURNITURE DE SOLUTIONS INFORMATIQUES</p>
                                <a href="{{ route('solution') }}">En savoir plus</a>
                            </div>
                            <div class="service2a">
                                <div class="overlay"></div>
                                <img src="{{ url('assets/frontend/image/cablage.png') }}" alt="">
                                <p>TRAVAUX DE CÂBLAGES RéSEAUX INFORMATIQUES ET TéléPHONIQUES</p>
                                <a href="{{ route('cablage') }}">En savoir plus</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="wrap">
            <div class="title">
                <h1>DECOUVREZ NOS PRODUITS EN VEDETTE</h1>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="wrap">
            <div class="cadres" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                <div class="cadre">
                    <div class="cadImage">
                        <img src="{{ url('assets/frontend/image/microphone.jpg') }}" alt="">
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
                        <img src="{{ url('assets/frontend/image/cable1.jpg') }}" alt="">
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
                        <img src="{{ url('assets/frontend/image/baffe.jpg')}}" alt="">
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
                        <img src="{{ url('assets/frontend/image/headphone.png')}}" alt="">
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
    <section class="py-5 describe">
        <div class="wrap">
            <div class="content">
                <div class="left">
                    <h1>pourquoi nous faire confiance</h1>
                    <h2>Parce que nous vous offrons des produits de qualité</h2>
                    <p>Nos appareils sont des marques reconnues et fiables afin de garantir du matériel durable et performant. De plus, nos équipes vérifient les composants et systèmes avant toute installation.
                    </p>
                    <h2>Parce que votre satisfaction est notre priorité</h2>
                    <p>Nos appareils sont entièrement garantis. Nous disposons d’un service après-vente capable de répondre à tous vos besoins de dépannage pour une assistance téléphonique ou sur site.
                    </p>
                    <h2>ce qui nous caractérise</h2>
                    <div class="carac">
                        <div class="carac1">
                            <img src="{{ url('assets/frontend/image/professionnalisme.png')}}" alt="">
                            <p>Professionnalisme</p>
                        </div>
                        <div class="carac1">
                            <img src="{{ url('assets/frontend/image/quality.png')}}" alt="">
                            <p>Qualité</p>
                        </div>
                        <div class="carac1">
                            <img src="{{ url('assets/frontend/image/efficacite.png')}}" alt="">
                            <p>Efficacité</p>
                        </div>
                        <div class="carac1">
                            <img src="{{ url('assets/frontend/image/fidelite.png')}}" alt="">
                            <p>Fiabilité</p>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="cadImage">
                        <img src="{{ url('assets/frontend/image/ordi4.png')}}" alt="" >
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mb-4 py-5">
        <div class="wrap">
            <div class="title">
                <h1>Nos partenaires</h2>
            </div>
        </div>
    </section>
    <section class="mb-5 py-1">
        <div class="wrap py-2">
            <div class="patern mb-4" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                <div class="patern-image">
                    <img src="{{ url('assets/frontend/image/logo_DAVCOM.png')}}" alt="">
                </div>
                <div class="patern-image">
                    <img src="{{ url('assets/frontend/image/sir.png')}}" alt="">
                </div>
                <div class="patern-image">
                    <img src="{{ url('assets/frontend/image/lonaci.jpg')}}" alt="">
                </div>
                <div class="patern-image">
                    <img src="{{ url('assets/frontend/image/IOM_Logo.png')}}" alt="">
                </div>
                <div class="patern-image">
                    <img src="{{ url('assets/frontend/image/logo_AFB.png')}}" alt="">
                </div>
                
            </div>
        </div>
    </section>
    <section class="mb-4">
        <div class="wrap">
            <div class="title">
                <h1>DECOUVREZ NOS PRODUITS RECEMMENT AJOUTES</h2>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="wrap">
            <div class="cadres" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
                
                @foreach ($productsRecents as $productsRecent)
                    <div class="cadre">
                        <div class="cadImage">
                            <img src="{{ url('/uploads/produits', $productsRecent->image_principale)}}" alt="">
                        </div>
                        <a href="#">
                            <div class="search-cart">
                                <div class="cart"><i class="fas fa-shopping-cart"></i></div>
                            </div>
                        </a>
                        <div class="product-detail">
                            <p>{{ $productsRecent->name }}</p>
                        </div>
                        <div class="prix">
                            <p>{{ $productsRecent->prix }} Fcfa</p>
                        </div>
                        <div class="price">
                            <p>{{ $productsRecent->prix }} Fcfa</p>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <section class="py-5 mb-4 describes">
        <div class="wrap">
            <div class="testimonials">
                <div class="testimonial">
                    <h1>Ce que disent nos clients</h1>
                    <p>Votre avis est essentiel pour nous. Vos retours précieux nous permettent de constamment améliorer et adapter nos services pour mieux répondre à vos besoins.</p>
                </div>
                <div class="parte" >
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="testimonial-header">
                                    <!-- <img src="image/portrait.jpg" alt="Kouakou Lorrain" class="testimonial-img"> -->
                                    <p class="testimonial-name mt-3"><strong>Mohamed Touré</strong></p>
                                </div>
                                <div class="testimonial-content">
                                    <img src="{{ url('assets/frontend/image/quote_7350737 1.png')}}" alt="" class="image1">
                                    <p class="testimonial-text">
                                        J'espère que la semaine commence bien de votre côté. 
                                        Je vous remercie pour toutes les démarches, 
                                        c'est apprécié ! Je reste à l'écoute . Excellente journée
                                    </p>
                                    <img src="{{ url('assets/frontend/image/quote_7350737 2.png')}}" alt="" class="image2">
                                </div>
                            </div>
                            
                            <div class="swiper-slide">
                                <div class="testimonial-header">
                                    <!-- <img src="image/portrait.jpg" alt="Kouakou Lorrain" class="testimonial-img"> -->
                                    <p class="testimonial-name mt-3"><strong>Philipe Dembele</strong></p>
                                </div>
                                <div class="testimonial-content">
                                    <img src="{{ url('assets/frontend/image/quote_7350737 1.png')}}" alt="" class="image1">
                                    <p class="testimonial-text">
                                        Vous faites un excellent travail en concentrant vos services sur la satisfaction client, 
                                        ce qui manque à beaucoup d'entreprises dans nos pays. 
                                    </p>
                                    <img src="{{ url('assets/frontend/image/quote_7350737 2.png') }}" alt="" class="image2">
                                </div>
                            </div>
    
                            <div class="swiper-slide">
                                <div class="testimonial-header">
                                    <p class="testimonial-name mt-3"><strong>Kouakou Lorrain</strong></p>
                                </div>
                                <div class="testimonial-content">
                                    <img src="{{ url('assets/frontend/image/quote_7350737 1.png')}}" alt="" class="image1">
                                    <p class="testimonial-text">
                                        Ipsum dolor sit amet consectetur elit, sapiente quasi!
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                        Ad, inventore consequuntur perferendis quod 
                                    </p>
                                    <img src="{{ url('assets/frontend/image/quote_7350737 2.png')}}" alt="" class="image2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </section>
    <section class="mb-4 py-5">
        <div class="wrap">
            <div class="title">
                <h1>Envie d'un conseil</h2>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="wrap">
            <div class="cadreActu">
                @foreach ($conseilsRecents as $conseilsRecent)
                    <a href="{{ route('conseils.show', $conseilsRecent->slug ) }}">
                    <div class="cadre1">
                        <div class="cadImage">
                            <img src="{{ url('uploads/conseils', $conseilsRecent->image)}}" alt="">
                        </div>
                        <div class="conseil-titre">
                            <p>{{ $conseilsRecent->titre }}</p>
                        </div>
                        <div class="text-actu">
                            <p>{{ $conseilsRecent->description }}</p>
                        </div>
                        <div class="conseil-date mt-4">
                            <p>Publié le {{ $conseilsRecent->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
</main>

@endsection