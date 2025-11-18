@extends("layouts.front.app")

@section('title', 'Conseils')

@section('banner')

<div class="about-contents">
    <h1>CONSEIL ...</h1>
    <p style="text-align: center;">Vous pouvez des solutions à vos problèmes ici</p>
</div>

@endsection

@section('content')

<main>
    <section class="py-3">
        <div class="wrap">
            <div class="contenu-conseil">
                <div class="titre">
                    <h2>{{ $conseil->titre }}</h2><br><br>
                </div>
                <div class="mb-5">
                    <p class="publication"> publié le {{ $conseil->created_at->format('d/m/Y') }}</p>
                </div>
                
                <div class="letexte">
                    <p>
                        {{ $conseil->description }}
                    </p>
                </div>
            </div>
            
        </div>
        
    </section>

    <section class="mb-2 py-5">
        <div class="wrap">
            <div class="title">
                <h1>Des conseils qui vous intéresserons</h1>
            </div>
        </div>
    </section>

    <section class="py-3 mb-5">
        <div class="wrap">
            <div class="cadreActu">
                @foreach($conseilsRecents as $key => $conseilsRecent)
                    <a href="detailActu.html">
                        <div class="cadre1">
                            <div class="cadImage">
                                <img src="{{ url('uploads/conseils', $conseilsRecent->image) }}" alt="">
                            </div>
                            <div class="conseil-titre">
                                <p>{{ $conseilsRecent->titre }} </p>
                            </div>
                            <div class="text-actu">
                                <p>{!! Str::limit(strip_tags($conseil->description ), 100) !!}</</p>
                            </div>
                            <div class="conseil-date mt-4">
                                <p>Publié le {{ $conseilsRecent->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
                   
                {{-- <a href="detailActu.html">
                    <div class="cadre1">
                        <div class="cadImage">
                            <img src="image/accessoire.png" alt="">
                        </div>
                        <div class="conseil-titre">
                            <p>Lorem ipsum dolor sit amet, </p>
                        </div>
                        <div class="text-actu">
                            <p>Retour sur notre participation au Salon de l’Immobilier 2025 en Côte d’Ivoire (1er - 2 février 2025)</p>
                        </div>
                        <div class="conseil-date mt-4">
                            <p>Publié le 30/01/2025</p>
                        </div>
                    </div>
                </a>   
                <a href="detailActu.html">
                    <div class="cadre1">
                        <div class="cadImage">
                            <img src="image/accessoire.png" alt="">
                        </div>
                        <div class="conseil-titre">
                            <p>Lorem ipsum dolor sit amet, </p>
                        </div>
                        <div class="text-actu">
                            <p>Retour sur notre participation au Salon de l’Immobilier 2025 en Côte d’Ivoire (1er - 2 février 2025)</p>
                        </div>
                        <div class="conseil-date mt-4">
                            <p>Publié le 30/01/2025</p>
                        </div>
                    </div>
                </a>    --}}
            </div>
        </div>
    </section>
</main>

@endsection