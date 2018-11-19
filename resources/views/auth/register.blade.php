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
                    @if ($errors->has('mobile'))
                        <div class="mt-0 mb-4 alert alert-danger alert-dismissible fade show error" role="alert">
                            {{ $errors->first('mobile') }}
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

                    <div class="positioning input-effect{{ $errors->has('mobile') ? ' has-error' : '' }}">
                        <input class="effect" id="mobile" type="text" name="mobile" placeholder="">
                        <label>{{trans('front.mobile')}} <small><em>({{trans('front.optional')}})</em></small></label>
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


@endsection
