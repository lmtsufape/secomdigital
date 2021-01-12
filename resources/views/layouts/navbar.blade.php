<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-lg-auto">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <img src="{{asset('imagens/logo_secomdigital_menu.png')}}" width="250px" height="70px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </ul>

            <ul class="navbar-nav mr-auto" style="margin-left: 5%">
                <li class="dropdown mx-2">
                    <a onclick="contraste()" id="altocontraste" data-toggle="tooltip" title="Contraste"
                       style="height: 50px;">
                        <img class="on-contrast-force-white" src="{{asset('imagens/contraste.png')}}"
                             style="height:30px; margin-top: -5px">
                    </a>
                </li>
                <li class="dropdown mx-2">
                    <a onclick="fonte('a')" id="aumentarfonte" data-toggle="tooltip" title="Aumentar fonte"
                       style="height: 50px;">
                        <img class="on-contrast-force-white" src="{{asset('imagens/increase-font-size.png')}}"
                             style="height: 30px; margin-top: -5px">
                    </a>
                </li>
                <li class="dropdown mx-2">
                    <a onclick="fonte('d')" id="diminuirfonte" data-toggle="tooltip" title="Reduzir fonte"
                       style="height: 50px;">
                        <img class="on-contrast-force-white" src="{{asset('imagens/reduce-font-size.png')}}"
                             style="height: 30px; margin-top: -5px;">
                    </a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                    </li>
                    {{-- @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif --}}
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('servidor.index') }}"
                            >
                                Servidores
                            </a>
                            <a class="dropdown-item" href="{{ route('home') }}"
                            >
                                Cartões
                            </a>
                            <a class="dropdown-item" href="{{ route('clipping.create') }}"
                            >
                                Clipping
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Sair') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>