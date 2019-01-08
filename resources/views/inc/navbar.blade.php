<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        @guest
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'HeavyMetal-Subscribers') }}
            </a> 
        @else
            <a class="navbar-brand" href="{{ url('/dashboard') }}">
                {{ config('app.name', 'HeavyMetal-Subscribers') }}
            </a> 
        @endguest
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="navbar" class="nav-link" href="/activity" aria-expanded="false">
                        Activity Feed
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#ß" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Items 
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/magazines">
                            Magazines
                        </a>
                        <a class="dropdown-item" href="/books">
                            Books
                        </a>
                        <a class="dropdown-item" href="/comics">
                            Comics
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a id="navbar" class="nav-link" href="/artists" aria-expanded="false">
                        Artists/Authors
                    </a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}<span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @php
                            if(Auth::user()->admin == 1){
                                echo '<a class="dropdown-item" href="/manager/">Data Manager</a>';
                            }
                            @endphp
                            <a class="dropdown-item" href="/profile/{{ Auth::user()->id }}">
                                My Profile
                            </a>
                            <a class="dropdown-item" href="/mycollection">
                                My Collection
                            </a>
                            <a class="dropdown-item" href="/mycollection?filter=notowned">
                                NOT In My Collection
                            </a>
                            <a class="dropdown-item" href="/favorites">
                                My Favorites
                            </a>
                            <a class="dropdown-item" href="/wishlist">
                                My Wishlist
                            </a>
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
                @endguest
            </ul>
        </div>
    </div>
</nav>