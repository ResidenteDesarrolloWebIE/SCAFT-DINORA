<div id="preloder">
    <div class="loader"></div>
</div>
<header class="encabezado">
    <nav class="navbar navbar-expand-sm  fixed-top" style="background-color:#19202C" >
        <button class="navbar-toggler navbar-toggler-right"  style="background-color:#00456b" type="button" data-toggle="collapse" data-target="#navbarToggler">
            <span class="navbar-toggler-icon" ></span>
        </button>
        <a href="{{url('/home')}}" class="site-logo text-center">
            <img class="logo" src="{{ asset('images/scaft6.png') }}" alt="">
        </a>
        <div class="collapse navbar-collapse collapse offset-md-3" id="navbarToggler">
            <ul class="nav navbar-nav" id="menuprincipal">
                @if(Auth::user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/home')}}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('projects')}}">Lista de proyectos</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link " href="{{url('/home')}}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/supplies')}}">Suministros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/services')}}"> Servicios</a>
                    </li>
                @endif
                <li class="nav-item dropdown ">
                    <!-- open -->
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu">
                        <a class=" dropdown-item text-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            {{ __('Cerrar sesión') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>