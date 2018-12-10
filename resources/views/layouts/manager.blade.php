<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Data Manager : {{ config('app.name', 'HeavyMetal-CoverGallery') }}</title>

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

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color:#d7f3e3;">
            <div class="container">
                
                    <a class="navbar-brand" href="{{ url('/manager') }}">
                        Data Manager : {{ config('app.name', 'HeavyMetal Cover Gallery') }}
                    </a> 
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                       
                        <li class="nav-item">
                            <a id="navbar" class="nav-link" href="/manager/titles" aria-expanded="false">
                                Titles 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="navbar" class="nav-link" href="/manager/authors" aria-expanded="false">
                                Authors
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="navbar" class="nav-link" href="/manager/users" aria-expanded="false">
                                Users
                            </a>
                        </li>
                    </ul>
        
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}<span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/dashboard">Public View</a>
                                
                                <a class="dropdown-item" href="{{ route('logout') }}" style="font-weight:bold;color:red;"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

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
