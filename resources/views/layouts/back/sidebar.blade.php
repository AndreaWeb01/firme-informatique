<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="{{ route('accueil') }}" class="logo-light">
            <img src="{{ url('assets/frontend/image/immo-blanc.png')}}" alt="logo" class="logo-lg" height="80">
            <img src="{{ url('assets/frontend/image/immo-blanc.png')}}" alt="small logo" class="logo-sm" height="28">
        </a>

        <!-- Brand Logo Dark -->
        <a href="{{ route('accueil') }}" class="logo-dark">
            <img src="{{ url('assets/frontend/image/immo-blanc.png')}}" alt="dark logo" class="logo-lg" height="28">
            <img src="{{ url('assets/frontend/image/immo-blanc.png')}}" alt="small logo" class="logo-sm" height="28">
        </a>
    </div>

    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">

            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a href="{{ route('dashboard') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Tableau de bord </span>
                </a>
            </li>

            <li class="menu-title"></li>

            <li class="menu-item">
                <a href="{{ route('typeproduits.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Types de produits </span>
                </a>
            </li>


            <li class="menu-title"></li>

            <li class="menu-item">
                <a href="{{ route('categories.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Categories </span>
                </a>
            </li>

            <li class="menu-title"></li>

            <li class="menu-item">
                <a href="{{ route('produits.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Produits </span>
                </a>
            </li>

            <li class="menu-title"></li>

            <li class="menu-item">
                <a href="" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Commandes </span>
                </a>
            </li>

             <li class="menu-title"></li>

            <li class="menu-item">
                <a href="" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Stocks </span>
                </a>
            </li>

            <li class="menu-title"></li>
            
            <li class="menu-item">
                <a href="{{ route('actuconseils.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Conseils </span>
                </a>
            </li>

            <li class="menu-title"></li>

            <li class="menu-item">
                <a href="{{ route('devis.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Devis </span>
                </a>
            </li>

            {{--
            <li class="menu-title"></li>

            <li class="menu-item">
                <a href="{{ route('articles.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Articles </span>
                </a>
            </li>

            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))

            <li class="menu-title"></li>

            <li class="menu-item">
                <a href="{{ route('devis.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Devis </span>
                </a>
            </li>

            <li class="menu-title"></li>

             <li class="menu-item">
                <a href="{{ route('ventes.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Vente</span>
                </a>
            </li>

            <li class="menu-title"></li>

            <li class="menu-item">
                <a href="{{ route('locations.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Location</span>
                </a>
            </li> --}}
            
            <li class="menu-title"></li>

            <li class="menu-item">
                <a href="{{ route('users.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Utilisateurs </span>
                </a>
            </li> 
           
            {{-- @if(auth()->user()->hasRole('superadmin')) --}}

            <li class="menu-title"></li>

            <li class="menu-item">
                <a href="{{ route('roles.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Roles </span>
                </a>
            </li>

            <li class="menu-title"></li>

            <li class="menu-item">
                <a href="{{ route('permissions.index') }}" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-folder"></i></span>
                    <span class="menu-text"> Permissions </span>
                </a>
            </li>

            {{-- @endif --}}

            {{-- @endif --}}
            
            

        </ul>
    </div>

</div>