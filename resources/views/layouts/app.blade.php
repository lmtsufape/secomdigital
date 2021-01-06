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
    <script defer="defer" src="//barra.brasil.gov.br/barra.js" type="text/javascript"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style media="screen">
        #image-form-wrapper {
            padding-top: 20px;
            background: #f7f7f7;

        }
    </style>
    @yield('style')
</head>
<body>
<div id="page-container">
    @include('layouts.barraBrasil')
    <div id="content-wrap">
        @include('layouts.navbar')
        <main class="py-4">
            @yield('content')
        </main>
        <br>
        <div id="footer-brasil"></div>
    </div>
</div>
</body>
</html>
