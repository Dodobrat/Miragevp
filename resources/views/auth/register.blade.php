@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 form-wrapper">
                <form class="form custom-form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <h3 class="text-center form-title">{{trans('front.register')}}</h3>
                    @if ($errors->has('first_name'))
                        <div class="mt-0 mb-4 alert alert-danger alert-dismissible fade show error" role="alert">
                            {{ $errors->first('first_name') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->has('last_name'))
                        <div class="mt-0 mb-4 alert alert-danger alert-dismissible fade show error" role="alert">
                            {{ $errors->first('last_name') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->has('email'))
                        <div class="mt-0 mb-4 alert alert-danger alert-dismissible fade show error" role="alert">
                            {{ $errors->first('email') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->has('password'))
                        <div class="mt-0 mb-4 alert alert-danger alert-dismissible fade show error" role="alert">
                            {{ $errors->first('password') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="positioning input-effect{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <input class="effect" id="first_name" type="text" name="first_name" placeholder="" required>
                                <label>{{trans('front.first-name')}}</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="positioning input-effect{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <input class="effect" id="last_name" type="text" name="last_name" placeholder="" required>
                                <label>{{trans('front.last-name')}}</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                    </div>

                    <div class="positioning input-effect{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input class="effect" id="email" type="email" name="email" placeholder="" required>
                        <label>{{trans('front.email')}}</label>
                        <span class="focus-border"></span>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="positioning input-effect{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input class="effect" id="password" type="password" name="password" placeholder="" required>
                                <label>{{trans('front.password')}}</label>
                                <span class="focus-border"></span>
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="positioning input-effect{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input class="effect" id="password_confirm" type="password" name="password_confirmation" placeholder="" required>
                                <label>{{trans('front.password-confirm')}}</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">{{trans('front.register')}}</button>
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





    {{--<div class="container">--}}
        {{--<div class="row justify-content-md-center">--}}
            {{--<div class="col-lg-6 col-md-8 form-wrapper">--}}
                {{--<h1 class="text-center form-title">{{trans('front.register')}}</h1>--}}
                {{--<form class="form form-inner-pad" method="POST" action="{{ route('register') }}">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">--}}
                            {{--<div class="form-group form-gr-cust{{ $errors->has('first_name') ? ' has-error' : '' }}">--}}
                                {{--<label class="form-label" for="first_name">{{trans('front.first-name')}}</label>--}}
                                {{--<input id="first_name" type="text" class="form-control form-cont-cust" name="first_name" required>--}}
                                {{--@if ($errors->has('first_name'))--}}
                                    {{--<p class="error pl-2 pb-0">{{ $errors->first('first_name') }}</p>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-3">--}}
                            {{--<div class="form-group form-gr-cust{{ $errors->has('last_name') ? ' has-error' : '' }}">--}}
                                {{--<label class="form-label" for="last_name">{{trans('front.last-name')}}</label>--}}
                                {{--<input id="last_name" type="text" class="form-control form-cont-cust" name="last_name" required>--}}
                                {{--@if ($errors->has('last_name'))--}}
                                    {{--<p class="error pl-2 pb-0">{{ $errors->first('last_name') }}</p>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}


                    {{--<div class="form-group form-gr-cust{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                        {{--<label class="form-label" for="email">{{trans('front.email')}}</label>--}}
                        {{--<input id="email" type="email" class="form-control form-cont-cust" name="email" required>--}}
                        {{--@if ($errors->has('email'))--}}
                            {{--<p class="error pl-2 pb-0">{{ $errors->first('email') }}</p>--}}
                        {{--@endif--}}
                    {{--</div>--}}

                    {{--<div class="row">--}}
                        {{--<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-3">--}}
                            {{--<div class="form-group form-gr-cust{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                                {{--<label class="form-label" for="password">{{trans('front.password')}}</label>--}}
                                {{--<input id="password" type="password" class="form-control form-cont-cust" name="password" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-3">--}}
                            {{--<div class="form-group form-gr-cust">--}}
                                {{--<label class="form-label" for="password_confirm">{{trans('front.password-confirm')}}</label>--}}
                                {{--<input id="password_confirm" type="password" class="form-control form-cont-cust" name="password_confirmation" required>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--@if ($errors->has('password'))--}}
                            {{--<p class="error pl-4 pb-0">{{ $errors->first('password') }}</p>--}}
                        {{--@endif--}}
                    {{--</div>--}}




                    {{--<button type="submit" class="btn submit-btn"><p>{{trans('front.register')}}</p></button>--}}


                {{--</form>--}}
                {{--<p class="or-divider">{{trans('front.or')}}</p>--}}

                {{--<a class="login-social-button" href="{{url('auth/google')}}">--}}
                    {{--<div class="social-media-login-button" style="background: #FFFFFF; border: 1px solid #999; color: #424242;">--}}
                        {{--<svg width="40px" height="40px" viewBox="0 0 48 48"><defs><path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/></svg>--}}
                        {{--<div class="contents">--}}
                            {{--<span class="title">{{trans('front.google-auth')}}</span>--}}

                        {{--</div>--}}
                    {{--</div></a>--}}

                {{--<a class="login-social-button" href="{{url('auth/facebook')}}">--}}
                    {{--<div class="social-media-login-button" style="background: #3B5998;">--}}
                        {{--<svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 266.893 266.895">--}}
                            {{--<path id="background" fill="#FFFFFF" d="M248.082,262.307c7.854,0,14.223-6.369,14.223-14.225V18.812  c0-7.857-6.368-14.224-14.223-14.224H18.812c-7.857,0-14.224,6.367-14.224,14.224v229.27c0,7.855,6.366,14.225,14.224,14.225  H248.082z"/>--}}
                            {{--<path id="f" fill="#3B5998" d="M182.409,262.307v-99.803h33.499l5.016-38.895h-38.515V98.777c0-11.261,3.127-18.935,19.275-18.935  l20.596-0.009V45.045c-3.562-0.474-15.788-1.533-30.012-1.533c-29.695,0-50.025,18.126-50.025,51.413v28.684h-33.585v38.895h33.585  v99.803H182.409z"/>--}}
                        {{--</svg>--}}
                        {{--<div class="contents">--}}
                            {{--<span class="title">{{trans('front.facebook-auth')}}</span>--}}
                        {{--</div>--}}
                    {{--</div></a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


@endsection
