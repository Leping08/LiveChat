<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stef Blog') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.2.43/css/materialdesignicons.min.css">

    <link href="https://bootswatch.com/4/flatly/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('nav')
        <main class="py-4">
            @yield('content')

            @if(Auth::check())
                <div class="fixed-bottom">
                    <chat-component :auth_user="{{Auth::user()}}"></chat-component>
                </div>
            @endif
        </main>
    </div>
</body>
</html>
