<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" href="{{asset('/bootstrap-4.3.1-dist/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{asset('/bootstrap-4.3.1-dist/js/bootstrap.js')}}"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        @include('layouts.nav')
        

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
    @yield('script')
</body>
</html>
    