<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <div class="logo">
        <a href="{{ route('dashboard') }}" class="simple-text logo-normal">
            <img src="{{ asset('storage') }}/logo.png" width="64"  alt="">
            {{ env('APP_NAME') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @if (Auth()->user()->tipo == 'Administrador')
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'usuarios' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('usuarios') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <p>{{ __('Usuarios') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'categorias' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('categorias') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                    <p>{{ __('Categorias') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'productos' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('productos') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                    <p>{{ __('Productos') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'tiendas' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('tiendas') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                    <p>{{ __('Tiendas') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'compras' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('compras') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    <p>{{ __('Compras') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'envios' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('envios') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    <p>{{ __('Envios') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'movimientos' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('ver-movimientos') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <p>{{ __('Movimientos') }}</p>
                </a>
            </li>
            @endif
            @if (Auth()->user()->tienda)
            <li class="nav-item{{ $activePage == 'pos' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('pos') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                    <p>{{ __('POS') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'articulos' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('articulos') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                    <p>{{ __('Articulos') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'ventas' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('ventas') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                    <p>{{ __('Ventas') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'pedidos' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('pedidos') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    <p>{{ __('Pedidos') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'devoluciones' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('devoluciones') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    <p>{{ __('Devoluciones') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'movimientos' ? ' active' : '' }} text-center">
                <a class="nav-link" href="{{ route('movimientos') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <p>{{ __('Movimientos') }}</p>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>
