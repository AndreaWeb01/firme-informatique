@extends("layouts.front.app")

@section('title', 'A Propos')

@section('banner')

<div class="about-contents">
    <h1>QUI SOMMES NOUS</h1>
</div>

@endsection

@section('content')
<main>
       
        <section class="mb-5">
            <div class="wrap">
                <div class="content mt-4">
                    <div class="rights">
                        <div class="cadImages">
                            <img src="{{ url('assets/frontend/image/Photo-boss.jpg') }}" alt="" >
                        </div>
                        <div class="statist">
                            <div class="stat-block">
                              <div class="counter" data-target="+5">+0</div>
                              <p>Ans d'expérience</p>
                            </div>
                            <div class="line">|</div>
                            <div class="stat-block">
                              <div class="counter" data-target="+15">+0</div>
                              <p>Clients satisfaits</p>
                            </div>
                            <div class="line">|</div>
                            <div class="stat-block">
                              <div class="counter" data-target="+85">+0</div>
                              <p>Appareils vendus</p>
                            </div>
                          </div>
                          
                    </div>
                    <div class="lefts">
                        <p>
                            Fondée en 2018, par Monsieur Alphonse Tano, un entrepreneur visionnaire passionné par l’innovation technologique, la Firme de l’informatique fait partie des 4 entreprises du Groupe Attou.
                            Elle a débuté avec une ambition claire : offrir des solutions informatiques complètes et haut de gamme pour répondre aux besoins croissants des entreprises et des particuliers.</p>
                            <p>Grâce à notre engagement envers la qualité et la satisfaction client, nous avons diversifié nos services pour couvrir aujourd’hui un large éventail de besoins : La fourniture de matériels informatiques et consommables, l’installation de caméras de surveillance et systèmes de sécurité, Solutions informatiques, la Maintenance et entretien de matériel informatique, les Travaux de câblage et installations téléphoniques (réseaux structurés, fibre optique, téléphonie IP).</p>
                            <p>
                                La Firme de l’informatique progresse, elle est portée par une équipe extraordinaire, ainsi que par le leadership de Monsieur Alphonse Tano. Elle ne cesse d’innover en s’imposant comme le meilleur partenaire pour les entreprises et les institutions en quête de matériel informatique fiable et performant.
                            </p>
                            <p>
                                Aujourd’hui, fort de notre expertise, nous continuons à repousser les limites pour accompagner la transformation digitale de la Côte d’Ivoire, avec toujours la même passion : satisfaire ceux qui nous ont fait confiance par la qualité de nos services.
                            </p>
                            <p>
                                La Firme de l’informatique – On s’occupe de tout !
                            </p>

                        </p>
                    </div>
                  
                </div>
            </div>
        </section>

        <section class="mb-2 py-5">
            <div class="wrap">
                <div class="title">
                    <h1>Ce qui nous differencie des autres</h2>
                </div>
            </div>
        </section>

        <section class="py-4 mb-2">
            <div class="wrap">
                <div class="content">
                    <div class="left1">
                        <p>Ce qui nous distingue vraiment des autres, ce sont les quatres (4) piliers que nos clients reconnaissent constamment dans leur expérience avec nous:</p>
                        <div class="conrow">
                            <i class="fas fa-arrow-right"></i>
                            <p>Notre expertise
                                <br>
                                Depuis la création de la Firme de l’informatique, nous avons acquis une solide expérience dans la maintenance et la réparation. Notre maîtrise technique et notre connaissance du métier nous permettent de proposer des solutions toujours innovantes
                            </p>
                        </div>
                        <div class="conrow">
                            <i class="fas fa-arrow-right"></i>
                            <p>La qualité de nos services
                                <br>
                                nous attelons à fournir des services qui puissent satisfaire nos clients au-delà de leurs attentes. Nous restons exigeants envers nous à chaque étape, des produits/services jusqu’au suivi post-vente.
                            </p>
                        </div>
                        <div class="conrow">
                            <i class="fas fa-arrow-right"></i>
                            <p>Notre professionnalisme 
                            <br>
                            Nous avons un professionnalisme exemplaire et cela se traduit par l’écoute, la disponibilité, le respect de nos engagements et de notre promesse de vente
                            </p>
                        </div>
                        <div class="conrow mb-4">
                            <i class="fas fa-arrow-right"></i>
                            <p>Nos valeurs <br> Chez la firme de l’informatique, nous sommes animés par des valeurs fondamentales qui guident chacune de nos actions et décisions : la transparence, l’intégrité et la fiabilité.
                            </p>
                        </div>
                        <a href="{{ route('boutique') }}" class="btn-yellow ">Commencer vos achats</a>
                    </div>

                    <div class="rights mt-4">
                        <div class="cadImages">
                            <img src="{{ url('assets/frontend/image/ordi6.jpg')}}" alt="" >
                        </div> 
                    </div>
                    
                  
                </div>
            </div>
        </section>

        <section class="mb-4 py-5">
            <div class="wrap">
                <div class="title">
                    <h1>Notre equipe</h2>
                </div>
            </div>
        </section>

        <section class="py-5 mb-5">
            <div class="wrap">
                <div class="cadreEquipe">
                    <div class="cadreE">
                        <div class="cadImage">
                            <img src="{{ url('assets/frontend/image/Photo-boss.jpg ')}}" alt="">
                        </div>
                        <div class="fonction">
                            <h3>RALPH EDWARDS</h3>
                            <p>Maintenancier</p>
                        </div>
                    </div>
                    <div class="cadreE">
                        <div class="cadImage">
                            <img src="{{ url('assets/frontend/image/Photo-boss.jpg')}}" alt="">
                        </div>
                        <div class="fonction">
                            <h3>RALPH EDWARDS</h3>
                            <p>Maintenancier</p>
                        </div>
                    </div>
                    <div class="cadreE">
                        <div class="cadImage">
                            <img src="{{ url('assets/frontend/image/Photo-boss.jpg')}}" alt="">
                        </div>
                        <div class="fonction">
                            <h3>RALPH EDWARDS</h3>
                            <p>Maintenancier</p>
                        </div>
                    </div>
                    <div class="cadreE">
                        <div class="cadImage">
                            <img src="{{ url('assets/frontend/image/Photo-boss.jpg')}}" alt="">
                        </div>
                        <div class="fonction">
                            <h3>RALPH EDWARDS</h3>
                            <p>Maintenancier</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection