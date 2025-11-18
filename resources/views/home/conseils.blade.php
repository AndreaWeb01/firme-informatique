@extends("layouts.front.app")

@section('title', 'Conseils')

@section('banner')

<div class="about-contents">
    <h1>CONSEIL ...</h1>
    <p style="text-align: center;">Consultez nos conseils pour booster votre productivité, sécuriser vos données et pour 
être au parfum des dernières actualités du milieu de la Tech – l'informatique n'aura 
plus de secrets pour vous ! </p>
</div>

@endsection

@section('content')

<main>
    <section class="py-3 mb-5">
        <div class="wrap">
            <div class="cadreActu">
                @foreach($conseils as $key => $conseil)

                    <a href="{{ route('conseils.show', $conseil->slug) }}">
                        <div class="cadre1">
                            <div class="cadImage">
                                <img src="{{ url('uploads/conseils', $conseil->image) }}" alt="">
                            </div>
                            <div class="conseil-titre">
                                <p>{{ $conseil->titre }}</p>
                            </div>
                            <div class="text-actu">
                                <p>{!! Str::limit(strip_tags($conseil->description ), 100) !!}</p>
                            </div>
                            <div class="conseil-date mt-4">
                                <p>Publié le {{ $conseil->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
                    
                {{-- <a href="detailActu.html">
                    <div class="cadre1">
                        <div class="cadImage">
                            <img src="{{ url('assets/frontend/image/accessoire.png') }}" alt="">
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
                            <img src="{{ url('assets/frontend/image/accessoire.png')}}" alt="">
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
                            <img src="{{ url('assets/frontend/image/accessoire.png') }}" alt="">
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
                            <img src="{{ url('assets/frontend/image/accessoire.png')}}" alt="">
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
                            <img src="{{ url('assets/frontend/image/accessoire.png')}}" alt="">
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