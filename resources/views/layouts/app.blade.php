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

    @if (Route::currentRouteName() == 'welcome')
        <div id="home-overlay">
            <img class="home-preload-left-img" src="
            @if(!empty(Settings::getFile('index_logo_left')))
                {{ Settings::getFile('index_logo_left') }}
            @else
               {{ asset('images/fallback-logo/mirage.png') }}
            @endif" alt="">
            <img class="home-preload-right-img" src="
            @if(!empty(Settings::getFile('index_logo_right')))
                {{ Settings::getFile('index_logo_right') }}
            @else
                {{ asset('images/fallback-logo/tower.png') }}
            @endif" alt="">
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



<div id="app"></div>

<div class="top-nav">
    <a id="toggler" class="top-nav-toggler">
        @if($agent->isDesktop())
        <div class="hamburger is-active" id="hamburger">
            <span class="line"></span>
            <span class="line" style="opacity: 0;"></span>
            <span class="line"></span>
        </div>
        <span id="menu">Menu</span>
        @elseif($agent->isMobile())
        <div class="hamburger" id="hamburger">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
        @endif
    </a>
    <a href="{{ route('welcome') }}" class="top-nav-link-head">
        <img class="top-nav-link-head-img" src="
        @if(!empty(Settings::getFile('index_logo')))
            {{ Settings::getFile('index_logo') }}
        @else
           {{ asset('images/fallback-logo/full.png') }}
        @endif" alt="">
    </a>
    <a class="top-nav-link-trans-right top-nav-link-trans" href="{{ LaravelLocalization::getLocalizedURL('en') }}">EN</a>
    <a class="top-nav-link-trans-left top-nav-link-trans" href="{{ LaravelLocalization::getLocalizedURL('fr') }}">FR</a>
</div>

@if($agent->isDesktop())
    <div class="side-nav-desktop">
@elseif($agent->isMobile())
    <div class="side-nav-mobile deactivated">
@endif
    <div class="side-nav-inside visible">

    <a class="btn-close" id="mobileCloser">&times;</a>
    <a href="{{ route('welcome') }}" class="side-nav-link">{{ trans('front.home') }}</a>
    <a class="side-nav-link" id="exp-drop">{{trans('front.residences')}}<i id="exp-drop-icon"></i></a>
    <div class="exp-link-drop">
        @if(Auth::check())
        <a class="exp-link" href="{{ route('project') }}">{{trans('front.visual-selection')}}</a>
        @else
            <a class="exp-link not-logged">{{trans('front.visual-selection')}}</a>


            <div id="modalForm" class="custom-modal">
                <div class="custom-modal-content">
                    <span class="closeBtn">&times;</span>
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-10 col-md-12 col-sm-12 col-xs-12">

                            <form class="form custom-form modal-form-wrapper" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <h5 class="text-center form-title">This page is locked! If you want to see it you have to be a member!</h5>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <a class="custom-btn btn-12" href="{{ route('login') }}">{{trans('front.sign-in')}}</a>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <a class="custom-btn btn-12" href="{{ route('register') }}">{{trans('front.sign-up')}}</a>
                                    </div>
                                </div>
                                <h5 class="or-divider">{{trans('front.or')}}</h5>
                                {{--<h2><span>or</span></h2>--}}
                                <a class="login-social-button" href="{{url('auth/facebook')}}">
                                    <div class="social-media-login-button" style="background: #3B5998;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 266.893 266.895">
                                            <path id="background" fill="#FFFFFF" d="M248.082,262.307c7.854,0,14.223-6.369,14.223-14.225V18.812  c0-7.857-6.368-14.224-14.223-14.224H18.812c-7.857,0-14.224,6.367-14.224,14.224v229.27c0,7.855,6.366,14.225,14.224,14.225  H248.082z"/>
                                            <path id="f" fill="#3B5998" d="M182.409,262.307v-99.803h33.499l5.016-38.895h-38.515V98.777c0-11.261,3.127-18.935,19.275-18.935  l20.596-0.009V45.045c-3.562-0.474-15.788-1.533-30.012-1.533c-29.695,0-50.025,18.126-50.025,51.413v28.684h-33.585v38.895h33.585  v99.803H182.409z"/>
                                        </svg>
                                        <div class="contents">
                                            <span class="title">{{trans('front.facebook-auth')}}</span>
                                        </div>
                                    </div></a>
                                <a class="login-social-button" href="{{url('auth/google')}}">
                                    <div class="social-media-login-button" style="background: #FFFFFF; border: 1px solid #999; color: #424242;">
                                        <img src="{{ asset('images/google-logo.png') }}" alt="" style="height: 22px; width: 22px; margin-right: 17px;">
                                        <div class="contents">
                                            <span class="title">{{trans('front.google-auth')}}</span>
                                        </div>
                                    </div></a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @endif
        @if(Auth::check())
                <a class="exp-link" href="{{ route('floors') }}">{{trans('front.floor-plan')}}</a>
            @else
                <a class="exp-link not-logged">{{trans('front.floor-plan')}}</a>

                <div id="modalForm" class="custom-modal">
                    <div class="custom-modal-content">
                        <div class="row justify-content-center">
                            <div class="col-xl-8 col-lg-10 col-md-12 col-sm-12 col-xs-12">
                                <span class="closeBtn">&times;</span>
                                <form class="form custom-form modal-form-wrapper" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}
                                    <h5 class="text-center form-title">{{ trans('front.locked-page') }}</h5>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                            <a class="custom-btn btn-12" href="{{ route('login') }}">{{trans('front.sign-in')}}</a>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                            <a class="custom-btn btn-12" href="{{ route('register') }}">{{trans('front.sign-up')}}</a>
                                        </div>
                                    </div>
                                    <h5 class="or-divider">{{trans('front.or')}}</h5>
                                    {{--<h2><span>or</span></h2>--}}
                                    <a class="login-social-button" href="{{url('auth/facebook')}}">
                                        <div class="social-media-login-button" style="background: #3B5998;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 266.893 266.895">
                                                <path id="background" fill="#FFFFFF" d="M248.082,262.307c7.854,0,14.223-6.369,14.223-14.225V18.812  c0-7.857-6.368-14.224-14.223-14.224H18.812c-7.857,0-14.224,6.367-14.224,14.224v229.27c0,7.855,6.366,14.225,14.224,14.225  H248.082z"/>
                                                <path id="f" fill="#3B5998" d="M182.409,262.307v-99.803h33.499l5.016-38.895h-38.515V98.777c0-11.261,3.127-18.935,19.275-18.935  l20.596-0.009V45.045c-3.562-0.474-15.788-1.533-30.012-1.533c-29.695,0-50.025,18.126-50.025,51.413v28.684h-33.585v38.895h33.585  v99.803H182.409z"/>
                                            </svg>
                                            <div class="contents">
                                                <span class="title">{{trans('front.facebook-auth')}}</span>
                                            </div>
                                        </div></a>
                                    <a class="login-social-button" href="{{url('auth/google')}}">
                                        <div class="social-media-login-button" style="background: #FFFFFF; border: 1px solid #999; color: #424242;">
                                            <img src="{{ asset('images/google-logo.png') }}" alt="" style="height: 22px; width: 22px; margin-right: 17px;">
                                            <div class="contents">
                                                <span class="title">{{trans('front.google-auth')}}</span>
                                            </div>
                                        </div></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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
    </div>
@if(isset($contacts_cache) == true)
    @if( !empty($contacts_cache->first()->phone) || !empty($contacts_cache->first()->address) || !empty($contacts_cache->first()->email) )
        <div class="contact-section visible">
            @if(!empty($contacts_cache->first()->address))
                <p class="contact-section-address">{{ trans('front.contacts_address') }} <span>{{ $contacts_cache->first()->address }}</span></p>
            @endif
            @if(!empty($contacts_cache->first()->phone))
                <p class="contact-section-phone">{{ trans('front.contacts_phone') }} <span>{{ $contacts_cache->first()->phone }}</span></p>
            @endif
            @if(!empty($contacts_cache->first()->email))
                <p class="contact-section-email">{{ trans('front.contacts_email') }} <span>{{ $contacts_cache->first()->email }}</span></p>
            @endif
        </div>
    @endif
@endif
    <div class="news-section visible">
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

    <p class="copy visible">{{ config('app.name', 'MIRAGETOWER') }} &copy;</p>

</div><!--end Mobile side nav-->
    </div><!--end Desktop side nav-->

<div id="main">

    @yield('content')

</div>


    <!-- Scripts -->
    <script src="{{ mix('assets/js/app.js') }}"></script>
</body>
</html>
