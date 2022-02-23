<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <main>
            <div class="container-app">
                <div class="side-block" id="side-block">
                    @include('layouts.navbar')
                </div>
                <div class="main-block">
                    @include('layouts.header')
                    @yield('content')
                </div>
        </main>
    </div>
    <script type='text/javascript'>
        function myClose() {
            let navigation = document.getElementById("side-block");
            navigation.style.display = "none";
        }

        function myOpen() {
            let navigation = document.getElementById("side-block");
            navigation.style.display = "block";
        }
    </script>
</body>

</html>
