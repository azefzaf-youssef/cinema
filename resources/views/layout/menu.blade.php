
<nav class="navbar shadow navbar-expand-md  black-bg white-color " >
    <div class="container">
        <a class="navbar-brand" href="{{ route('HOME') }}">
            Terminologio
        </a>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav justify-content-center">


                <li class="nav-item ">
                    <a class="nav-link"href="{{ route('HOME') }}">Illustrations</a>
                </li>

                @if(Auth::user())
                @if(!Auth::user()->is_admin)

                <li class="nav-item">
                    <a class="nav-link"href="{{ route('USER-LOGGED-INDEX') }}">Mes illustrations</a>
                </li>
                @endif
                @endif

                @if(Auth::user())
                @if(Auth::user()->is_admin)

                    <li class="nav-item">
                        <a class="nav-link"href="{{ route('GESTION-UTILISATEUR') }}">Gestion des utilisateurs</a>
                    </li>
                @endif
                @endif




            </ul>
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Se connecter</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Se déconnecter') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar-brand,
    .navbar-collapse,
    .navbar-item,
    .nav-link {
        color: #ffffff !important;

    }

    .dropdown-item {
        color: #4b4660 !important;

    }

    .navbar-brand {
        font-size: 16px;
        font-weight: bold;

    }
</style>
