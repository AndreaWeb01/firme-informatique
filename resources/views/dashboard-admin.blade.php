@extends("layouts.back.master")

@section("contenu")

        <h3>je suis la page Dashboard Admin</h3>

        {{-- Barre de navigation --}}

        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">Roles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Permissions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
        </ul>

        {{-- End Barre de navigation --}}

        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Deconnexion</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

@endsection