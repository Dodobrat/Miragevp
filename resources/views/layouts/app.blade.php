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

<div class="top-nav">
    <a id="toggler" class="top-nav-toggler">
        <div class="hamburger is-active" id="hamburger">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
    </a>
    <a class="top-nav-link-trans-right top-nav-link-trans" href="{{ LaravelLocalization::getLocalizedURL('en') }}">EN</a>
    <a class="top-nav-link-trans-left top-nav-link-trans" href="{{ LaravelLocalization::getLocalizedURL('fr') }}">FR</a>
</div>


<div class="side-nav">
    <a class="btn-close" id="mobileCloser">&times;</a>
    <a href="{{ url('/') }}" class="side-nav-link-head">{{ config('app.name', 'MirageTower') }}</a>
    @auth
        <a class="side-nav-link" href="{{ route('home') }}">{{trans('front.dashboard')}}</a>
        <a class="side-nav-link" href="#">{{trans('front.explore-nav')}}</a>
        <a class="side-nav-link" href="#">{{trans('front.blog')}}</a>
        <a class="side-nav-link" id="name-drop">
            @if(isset( Auth::user()->first_name))
                {{Auth::user()->first_name}}
            @else
                {{Auth::user()->name}}
            @endif
            <i></i>
        </a>
        <div class="side-nav-link-drop">
            <a class="link-drop" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{trans('front.logout')}}
            </a>

        </div>




        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        </form>


    @endauth

@guest

<a class="side-nav-link" href="{{ route('login') }}">{{trans('front.login')}}</a>


@endguest
{{--<form action="{{ route('newsletter_subscriber.store') }}" method="post">--}}
        {{--{{ csrf_field() }}--}}
        {{--<input type="email" name="email">--}}
        {{--<input type="submit">--}}
    {{--</form>--}}
</div>


        {{--@auth--}}


                    {{--<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">--}}
                        {{--@if(isset( Auth::user()->first_name))--}}
                            {{--{{Auth::user()->first_name}}--}}
                        {{--@else--}}
                            {{--{{Auth::user()->name}}--}}
                        {{--@endif</a>--}}
                    {{--<ul class="collapse list-unstyled" id="pageSubmenu">--}}
                        {{--<li>--}}
                            {{--<a href="{{ route('home') }}">{{trans('front.dashboard')}}</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
                                {{--{{trans('front.logout')}}--}}
                            {{--</a>--}}

                            {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--</form>--}}
                        {{--</li>--}}




            {{--@endauth--}}




<div id="main">
    <div style="margin-top: 100px;"></div>
    @yield('content')
    <div style="margin-top: 1000px;"></div>
</div>



    {{--<div style="height: 500px;"></div>--}}

{{--</div>--}}

    <!-- Scripts -->
    <script src="{{ mix('assets/js/app.js') }}"></script>
</body>
</html>
