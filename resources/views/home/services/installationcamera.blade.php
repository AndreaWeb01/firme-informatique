@extends("layouts.front.app")

@section('title', 'Installation de camera')

@section('headerClass', 'headernav3')

@section('banner')
<div class="about-contents">
    <h1 style="text-align: center; line-height: 1.5; font-weight: bold;">INSTALLATION DE CAMÉRA DE SURVEILLANCE ET SYSTÈME DE SÉCURITÉ</h1>
</div>
@endsection


@section("content")

<main>

    <section>
        <div class="wrap">
            <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / Installation de caméra de surveillance et système de sécurité</p>
        </div>
    </section>

    <section class="mb-5 py-5">
        <div class="wrap">
            <div class="title">
                <h1>Installation de caméra de surveillance et système de sécurité</h2>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="wrap">
            <div class="content1">
                <div class="right1">
                    <div class="cadImages1 mb-3">
                        <img src="{{ url('assets/frontend/image/borne.jpg') }}" alt="" >
                    </div>
                </div>
                <div class="lefts1">
                    <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                        nisi ut aliquip ex ea commodo consequat
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                        nisi ut aliquip ex ea commodo consequat
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                        nisi ut aliquip ex ea commodo consequat
                        
                        
                    </p>
                    <div class="btn-contact mt-5">
                        <a href="{{ route('contact') }}">Contactez-nous</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 describe1">
        <div class="wrap">
            <div class="content">
                <div class="left">
                    <h1>pourquoi nous faire confiance</h1>
                    <h2>Parce que nous vous offrons des produits de qualité</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                        nisi ut aliquip ex ea commodo consequat
                    </p>
                    <h2>Parce que nous voTRE SATISFACTION NOTRE PRIORIT</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
                        nisi ut aliquip ex ea commodo consequat
                    </p>
                    
                </div>
                <div class="rights">
                    <div class="cadImages4">
                        <img src="{{ url('assets/frontend/image/camera-security.png') }}" alt="" >
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="mb-2 py-5">
        <div class="wrap">
            <div class="title">
                <h1>Ce qui nous caractérise</h2>
            </div>
        </div>
    </section>

    <section class="py-4 mb-2">
        <div class="wrap">
            <div class="content">
                <div class="left1">
                    <p>Nos clients nous disent que nous sommes uniques pour diverses raison importantes, notamment:</p>
                    <div class="conrow">
                        <i class="fas fa-arrow-right"></i>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores ad est maxime iure assumenda 
                            totam incidunt harum hic soluta quo. Reprehenderit nostrum delectus perspiciatis nulla, corporis 
                            a placeat ipsum quasi.
                        </p>
                    </div>
                    <div class="conrow">
                        <i class="fas fa-arrow-right"></i>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores ad est maxime iure assumenda 
                            totam incidunt harum hic soluta quo. Reprehenderit nostrum delectus perspiciatis nulla, corporis 
                            a placeat ipsum quasi.
                        </p>
                    </div>
                    <div class="conrow">
                        <i class="fas fa-arrow-right"></i>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores ad est maxime iure assumenda 
                            totam incidunt harum hic soluta quo. Reprehenderit nostrum delectus perspiciatis nulla, corporis 
                            a placeat ipsum quasi.
                        </p>
                    </div>
                    <div class="conrow">
                        <i class="fas fa-arrow-right"></i>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores ad est maxime iure assumenda 
                            totam incidunt harum hic soluta quo. Reprehenderit nostrum delectus perspiciatis nulla, corporis 
                            a placeat ipsum quasi.
                        </p>
                    </div>
                </div>

                <div class="rights">
                    <div class="cadImages">
                        <img src="{{ url('assets/frontend/image/arrange.jpg') }}" alt="" >
                    </div> 
                </div>
                
                
            </div>
        </div>
    </section>

    <section class="mb-2 py-5">
        <div class="wrap">
            <div class="title">
                <h1>obtenez un devis facilement</h2>
            </div>
        </div>
    </section>

    <section class="mb-2 py-2">
        <div class="wrap">
            <!-- <p class="mt-4 mb-5 text-center" style="padding: 0 70px;"> Ne vous inquitez pas vous êtes à la bonne porte donnez nous vos maux et nous vous donnerons un remède</p> -->

            <div class="devis-info-contact mt-5" id="devis">
                <div class="contacts-info">
                    <div class="cadImages3">
                        <img src="{{ url('assets/frontend/image/security.jpg') }}" alt="">
                    </div>
                </div>
                <div class="devis">
                    <div class="formulaire" data-aos="fade-left" data-aos-duration="1000" data-aos-once="true">
                        
                        <form action="{{ route('contact.store') }}" method="POST">
                                @csrf

                                <div class="present">
                                    <div class="div">
                                        <input type="text" name="nom" placeholder="Entrez votre nom">
                                    </div>
                                    <div class="div">
                                        <input type="text" name="prenom" placeholder="Entrez votre prenom">
                                    </div>
                                </div>
                                <div class="present">
                                    <div class="div">
                                        <input type="email" name="email" placeholder="Entrez votre email">
                                    </div>
                                    <div class="div">
                                        <input type="text" name="telephone" placeholder="Entrez votre numero">
                                    </div>
                                </div>
                                <select name="digit" id="digital">
                                    <option disabled selected class="default">Selectionner le service qui vous intéresse</option>
                                    <option value="Fourniture de consommables et accessoires informatique">Fourniture de consommables et accessoires informatique</option>
                                    <option value="Founiture de materiels informatiques">Founiture de matériels informatiques</option>
                                    <option value="Founiture de solutions informatiques">Founiture de solutions informatiques</option>
                                    <option value="Entretien et maintenance de materiels informatique">Entretien et maintenance de matériels informatique</option>
                                    <option value="Travaux de câblages réseaux informatiques et informatiques">Travaux de câblages réseaux informatiques et informatiques</option>
                                </select>
                                <textarea name="besoin" id="besoin" placeholder="Décrivez votre besoin"></textarea>
                                <button type="submit">Envoyer</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection