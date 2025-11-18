@extends("layouts.front.app")

@section('title', 'Maintenance')

@section('headerClass', 'headernav2')

@section('banner')
<div class="about-contents">
    <h1 style="text-align: center; line-height: 1.5; font-weight: bold;">ENTRETIEN ET MAINTENANCE DE MATERIELS INFORMATIQUES</h1>
</div>
@endsection

@section("content")
<main>

        <section>
            <div class="wrap">
                <p style="padding: 0 70px; margin-bottom: 15px;"><a href="{{ route('accueil') }}">Accueil</a> / Entretien et maintenance de matériels informatiques</p>

            </div>
        </section>

        <section class="mb-5 py-5">
            <div class="wrap">
                <div class="title">
                    <h1>maintenance chez FID</h2>
                </div>
            </div>
        </section>

        <section class="mb-5">
            <div class="wrap">
                <div class="content1">
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
                    <div class="right1">
                        <div class="cadImages1 mb-3">
                            <img src="{{ url('assets/frontend/image/cable2.jpg') }}" alt="" >
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 describe">
            <div class="wrap">
                <div class="whyFid">
                    <h1 style="text-transform: uppercase; color: white;">Ce que la fid nous promet en thème de maintenance</h1>
                        <div class="carac">
                            <div class="carac1">
                                <img src="{{ url('assets/frontend/image/professionnalisme.png')}}" alt="">
                                <h4>Professionnalisme</h4>
                                <p>Nous techniciens certifiés et expérimentés, constamment formés aux dernières technologies. Nous agissons avec rigueur et réactivité, en respectant les meilleures pratiques du secteur.
                                </p>
                            </div>
                            <div class="carac1">
                                <img src="{{ url('assets/frontend/image/quality.png')}}" alt="">
                                <h4>Qualité</h4>
                                <p>Chaque intervention fait l’objet d’un diagnostic et d’une vérification rigoureuse, afin d’éliminer les pannes récurrentes de votre matériel informatique.
                                </p>
                            </div>
                            <div class="carac1">
                                <img src="{{ url('assets/frontend/image/efficacite.png')}}" alt="">
                                <h4>Efficacité</h4>
                                <p>Nous intervenons rapidement et efficacement pour résoudre votre problème 
                                </p>
                            </div>
                            <div class="carac1">
                                <img src="{{ url('assets/frontend/image/fidelite.png')}}" alt="">
                                <h4>Fiabilité</h4>
                                <p>Nous nous engageons sur un service fiable, jour après jour. Avec des rapports d’intervention détaillés et un suivi régulier. 
                                </p>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>

        <section class="mb-2 py-5">
            <div class="wrap">
                <div class="title">
                    <h1>Avez-vous un besoin ?</h2>
                </div>
            </div>
        </section>

        <section class="mb-2 py-2">
            <div class="wrap">
                <p class="mt-4 mb-5 text-center devis-texte"> Ne vous inquitez pas vous êtes à la bonne porte donnez nous vos maux et nous vous donnerons un remède</p>

                <div class="devis-info-contact mt-5" id="devis">
                    <div class="contacts-info">
                        <div class="cadImages3">
                            <img src="{{ url('assets/frontend/image/maintenance-maker.jpg')}}" alt="">
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