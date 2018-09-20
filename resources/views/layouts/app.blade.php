<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MIRAGETOWER') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/assets/css/app.css') }}" rel="stylesheet">

</head>
<body>
<div id="overlay">
    <!-- <div class="spinner"></div> -->

    <div class="bounce">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>

    {{--<div class="preload-text">--}}
    {{--<p>Mirage Visualisation</p>--}}
    {{--</div>--}}

</div>
    <div id="app">


<nav>
    <input type="checkbox" id="nav" class="hidden">
    <label for="nav" class="nav-btn">
        <i></i>
        <i></i>
        <i></i>
    </label>
    <div class="logo">
        <a href="{{ url('/') }}">{{ config('app.name', 'MirageVP') }}</a>
    </div>




    <div class="nav-wrapper">
        @auth
            <ul class="left-nav">
                <li><a href="#">{{trans('front.explore-nav')}}</a></li>
                <li><a href="#">{{trans('front.blog')}}</a></li>
                <li><a href="{{ LaravelLocalization::getLocalizedURL('en') }}">ENGLISH</a></li>
                <li><a href="{{ LaravelLocalization::getLocalizedURL('fr') }}">FRENCH</a></li>
            </ul>
            <ul class="logged-in-user">
                <li>
                    <div class="dropdown">
                        <a href="#" role="button" id="dropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(isset( Auth::user()->first_name))
                                {{Auth::user()->first_name}}
                            @else
                                {{Auth::user()->name}}
                            @endif
                        </a><i id="dropdownUserIcon"></i>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        <a href="{{ route('home') }}">{{trans('front.dashboard')}}</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{trans('front.logout')}}</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            </form>
                    </div>
                    </div>
                </li>
            </ul>
        @endauth
        @guest
            <ul>
                <li><a href="{{ LaravelLocalization::getLocalizedURL('en') }}">ENGLISH</a></li>
                <li><a href="{{ LaravelLocalization::getLocalizedURL('fr') }}">FRENCH</a></li>
                <li>
                    <a href="{{ route('login') }}">{{trans('front.login')}}</a>
                </li>
            </ul>
        @endguest
    </div>
</nav>
        <div style="height: 50px;"></div>

        @yield('content')
    </div>


    <!-- Scripts -->
    <script src="{{ mix('assets/js/app.js') }}"></script>
</body>
</html>
