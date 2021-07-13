<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $titlePage }} | {{ env('APP_NAME') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('storage') }}/favicon.png">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link href="{{ asset('material') }}/css/material-dashboard.min.css" rel="stylesheet" />
        @livewireStyles
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <div class="wrapper ">
                @include('layouts.navbars.sidebar')
                <div class="main-panel">
                    @include('layouts.navbars.nav')
                    @yield('content')
                </div>
            </div>
        @endauth
        <script src="{{ asset('material') }}/js/core/jquery.min.js"></script>
        <script src="{{ asset('material') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js"></script>
        <script src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('material') }}/js/material-dashboard.js" type="text/javascript"></script>
        <script src="{{ asset('material') }}/js/settings.js"></script>
        <script src="https://kit.fontawesome.com/b3fb79f871.js" crossorigin="anonymous"></script>
        @livewireScripts
        @stack('js')
    </body>
</html>
