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


    @if (Request::route()->getName() == 'welcome')
        <div id="home-overlay">
            <img class="home-preload-left-img" src="{{ \ProVision\Administration\Facades\Settings::getFile('index_logo_left') }}" alt="">
            <img class="home-preload-right-img" src="{{ \ProVision\Administration\Facades\Settings::getFile('index_logo_right') }}" alt="">
            <span class="line-draw"></span>
        </div>
        @else
        <div id="overlay">
            <div class="bounce">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    @endif
    <!-- <div class="spinner"></div> -->






<div id="app"></div>

<div class="top-nav">
    <a id="toggler" class="top-nav-toggler">
        <div class="hamburger is-active" id="hamburger">
            <span class="line"></span>
            <span class="line" style="opacity: 0"></span>
            <span class="line"></span>
        </div>
        <span id="menu">Menu</span>
    </a>
    <a href="{{ route('welcome') }}" class="top-nav-link-head">
        <img class="top-nav-link-head-img" src="{{ \ProVision\Administration\Facades\Settings::getFile('index_logo')}}" alt="">
    </a>
    <a class="top-nav-link-trans-right top-nav-link-trans" href="{{ LaravelLocalization::getLocalizedURL('en') }}">EN</a>
    <a class="top-nav-link-trans-left top-nav-link-trans" href="{{ LaravelLocalization::getLocalizedURL('fr') }}">FR</a>
</div>


<div class="side-nav">
    <a class="btn-close" id="mobileCloser">&times;</a>
    <a href="{{ route('welcome') }}" class="side-nav-link">{{ trans('front.home') }}</a>
    <a class="side-nav-link" id="exp-drop">{{trans('front.residences')}}<i id="exp-drop-icon"></i></a>
    <div class="exp-link-drop">
        <a class="exp-link" href="{{ route('project') }}">{{trans('front.visual-selection')}}</a>
        <a class="exp-link" href="{{ route('floors') }}">{{trans('front.floor-plan')}}</a>
        <a class="exp-link" href="{{ route('showroom') }}">{{trans('front.showroom')}}</a>
    </div>
    <a class="side-nav-link" href="{{ route('blog') }}">{{trans('front.lifestyle')}}</a>
    <a class="side-nav-link" href="{{ route('contact') }}">{{trans('front.contact')}}</a>

@auth
        <a class="side-nav-link" id="name-drop">
            @if(isset( Auth::user()->first_name))
                {{Auth::user()->first_name}}
            @else
                {{Auth::user()->name}}
            @endif
            <i id="name-drop-icon"></i>
        </a>
        <div class="side-nav-link-drop">
            <a class="link-drop" href="{{ route('home') }}">{{trans('front.dashboard')}}</a>
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

    <div class="news-section">
        <form method="POST" action="{{ route('newsletter_subscriber.store') }}">
            {{ csrf_field() }}
            <div class="positioning input-effect{{ $errors->has('news_email') ? ' has-error' : '' }}" id="news-field">
                <input class="effect" id="news" type="email" name="news_email" placeholder="" required>
                <label>{{trans('front.email')}}</label>
                <span class="focus-border"></span>
                @if ($errors->has('news_email'))
                    <div class="mt-4 alert alert-danger alert-dismissible fade show error-news" role="alert">
                        {{ $errors->first('news_email') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif(session()->has('message'))
                    <div class="mt-4 alert alert-success alert-dismissible fade show error-news" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
            <button type="submit" class="news-btn">{{trans('newsletter::front.subscribe')}}</button>
        </form>
    </div>

    <p class="copy">MIRAGETOWER &copy;</p>

</div>

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
