<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top bg-purple">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="{{ url($activePage) }}">{{ $titlePage }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            <li class="nav-item dropdown text-center">
            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ Auth::user()->profile_photo_url }}" alt="Img Profile" class="img rounded-circle" width="48" height="48">
            </a>
            <div class="dropdown-menu dropdown-menu-right fade-in" aria-labelledby="navbarDropdownProfile">
                <a class="dropdown-item" href="{{ route('profile.show') }}">Perfil</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Salir</a>
            </div>
            </li>
        </ul>
        </div>
    </div>
</nav>
