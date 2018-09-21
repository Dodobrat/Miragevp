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
    <div id="app"></div>


<div class="wrapper">

    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3><a href="{{ url('/') }}">{{ config('app.name', 'MirageTower') }}</a></h3>
        </div>

        @auth

            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('home') }}">{{trans('front.dashboard')}}</a>
                </li>
                <li>
                    <a href="#">{{trans('front.explore-nav')}}</a>
                </li>
                <li>
                    <a href="#">{{trans('front.blog')}}</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        @if(isset( Auth::user()->first_name))
                            {{Auth::user()->first_name}}
                        @else
                            {{Auth::user()->name}}
                        @endif</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="{{ route('home') }}">{{trans('front.dashboard')}}</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{trans('front.logout')}}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ LaravelLocalization::getLocalizedURL('en') }}">EN</a></li>
                <li><a href="{{ LaravelLocalization::getLocalizedURL('fr') }}">FR</a></li>
            </ul>



            @endauth

        @guest
            <ul class="list-unstyled components">
                <li>
                    <a href="{{ route('login') }}">{{trans('front.login')}}</a>
                </li>
            <li><a href="{{ LaravelLocalization::getLocalizedURL('en') }}">EN</a></li>
            <li><a href="{{ LaravelLocalization::getLocalizedURL('fr') }}">FR</a></li>
            </ul>
        @endguest


        {{--<ul class="list-unstyled CTAs">--}}
            {{--<li>--}}
                {{--<a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    </nav>


    <!-- Page Content Holder -->
    <div id="content">

        <nav class="navbar navbar-light bg-light">

        <button type="button" id="sidebarCollapse" class="navbar-btn">
            <span></span>
            <span></span>
            <span></span>
        </button>

            <p>hi</p>
        </nav>





<div id="content-inner">


        <div style="height: 500px;"></div>


        @yield('content')
</div>
    </div>
</div>

    <!-- Scripts -->
    <script src="{{ mix('assets/js/app.js') }}"></script>
</body>
</html>
