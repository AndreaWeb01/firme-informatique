@extends("layouts.front.app")

@section('title', 'Cablage')

@section('headerClass', 'headernav1')

@section('banner')
<div class="about-contents">
    <h1 style="text-align: center; line-height: 1.5; font-weight: bold;">TRAVAUX DE CÂBLAGES RESEAUX INFORMATIQUES ET TELEPHONIQUES</h1>
</div>
@endsection

@section("content")
<main>
    <section class="mb-5">
        <div class="wrap">
            <p class="return"><a href="{{ route('accueil') }}">Accueil</a> / Travaux de câblage et réseau informatique</p>
            <div class="content">
                <div class="right">
                    <div class="cadImages1 mb-3">
                        <img src="{{ url('assets/frontend/image/cable2.jpg') }}" alt="" >
                    </div>
                    <div class="cadImages1">
                        <img src="{{ url('assets/frontend/image/electric-cable.jpg') }}" alt="" >
                    </div>    
                </div>
                <div class="right">
                    <div class="cadImages2 mb-3">
                        <img src="{{ url('assets/frontend/image/switch-cable.jpg') }}" alt="" >
                    </div>
                    <div class="cadImages2">
                        <img src="{{ url('assets/frontend/image/women-cable.jpg') }}" alt="" >
                    </div>    
                </div>
                <div class="lefts">
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
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
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
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
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

    <section class="mb-2 py-5">
        <div class="wrap">
            <div class="title">
                <h1>Découvrez nos projets de câblages</h2>
            </div>
        </div>
    </section>

    <section class="py-4 mb-2">
        <div class="wrap">
            <div class="cadreprojet">
                @foreach ($conseilsRecents as $conseilsRecent)
                    <div class="cadre2">
                        <div class="cadImage">
                            <img src="{{ url('uploads/conseils', $conseilsRecent->image)}}" alt="">
                        </div>
                        <div class="conseil-titre">
                            <p>{{ $conseilsRecent->titre }}</p>
                        </div>
                    </div>
                @endforeach
            

                {{-- <div class="cadre2">
                    <div class="cadImage">
                        <img src="{{ url('assets/frontend/image/accessoire.png') }}" alt="">
                    </div>
                    <div class="conseil-titre">
                        <p>Lorem ipsum dolor sit amet, </p>
                    </div>
                    
                </div> --}}
                
                
            </div>
            
        </div>
    </section>

       

    </main>
@endsection