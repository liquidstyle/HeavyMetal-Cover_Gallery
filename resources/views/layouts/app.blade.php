<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HeavyMetal-CoverGallery') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chosen.min.css') }}" rel="stylesheet">

    <!-- Additional Page Styles -->
    @yield('styles')

</head>
<body>
    @if (env('APP_ENV') == 'local')
        <div class="alert alert-info text-center" style="margin-bottom:0px;"><i class="fab fa-docker"></i> Docker Environment</div>
    @elseif(env('APP_ENV') == 'development')
        <div class="alert alert-warning text-center" style="margin-bottom:0px;"><i class="fa fa-cog"></i> Development Environment</div>
    @endif

    @include('inc.navbar')

    <div class="container">

        <main class="py-4">

            @include('inc.messages')

            @yield('content')

        </main>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Additional Page Scripts -->
    @yield('scripts')
    
</body>
</html>
