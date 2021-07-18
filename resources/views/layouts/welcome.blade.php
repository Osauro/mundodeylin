<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bienvenido</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('fontend') }}/assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <link href="{{ asset('frontend') }}/css/styles.css" rel="stylesheet" />
        @livewireStyles
    </head>
    <body>
        @yield('content')
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; <a href="www.dieguitosoft.com" class="text-white">DieguitoSoft</a> 2021</p></div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('frontend') }}/js/scripts.js"></script>
        @livewireScripts
    </body>
</html>
