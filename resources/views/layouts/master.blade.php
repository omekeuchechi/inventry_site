<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inventry</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/index.css') }}">
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    @livewireStyles  
</head>
<body>
    @include('includes.nav')
    
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @livewireScripts
    <script src="{{ asset('fontawesome-free-6.5.2-web/js/all.js') }}"></script>
</body>
</html>
