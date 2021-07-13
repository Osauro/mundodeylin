<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}" defer></script>
<div class="antialiased">
    {{ $slot }}
    @stack('modals')
</div>
