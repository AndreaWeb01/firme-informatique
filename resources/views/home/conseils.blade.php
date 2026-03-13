@extends("layouts.front.app")

@section('title', 'Conseils')

@section('banner')

<div class="center">
<div class="about-content">
    <h1>CONSEIL ...</h1>
    <p>Consultez nos conseils pour booster votre productivité, sécuriser vos données et pour
être au parfum des dernières actualités du milieu de la Tech – l'informatique n'aura
plus de secrets pour vous ! </p>
</div>
</div>

@endsection

@section('content')

<main class="main-conseils">
    <section class="py-3 mb-5">
        <div class="wrap">
            <div class="cadreActu">
                @foreach($conseils as $key => $conseil)

                    <a href="{{ route('conseils.show', $conseil->slug) }}">
                        <div class="cadre1">
                            <div class="cadImage">
                                <img src="{{ asset('storage/' . $conseil->image) }}" alt="">
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

            </div>

        </div>
    </section>
</main>

@endsection
