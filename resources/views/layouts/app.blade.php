<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="stylesheet" href="{{asset('/bootstrap-4.3.1-dist/css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('/fontawesome/css/all.css')}}" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

    @yield('style')

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

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{asset('/bootstrap-4.3.1-dist/js/bootstrap.js')}}"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    @yield('script')
</body>
</html>

    