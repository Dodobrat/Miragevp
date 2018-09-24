@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 form-wrapper">
                <form class="form custom-form" method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <h3 class="text-center form-title">{{trans('front.reset-password')}}</h3>
                    <div class="positioning input-effect{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input autocomplete="new-email" class="effect" id="email" type="email" name="email" placeholder="" required>
                        <label>{{trans('front.email')}}</label>
                        <span class="focus-border"></span>
                        @if ($errors->has('email'))
                            <div class="mt-4 alert alert-danger alert-dismissible fade show error" role="alert">
                                {{ $errors->first('email') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="positioning input-effect{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input autocomplete="new-password" class="effect" id="password" type="password" name="password" placeholder="" required>
                        <label>{{trans('front.password')}}</label>
                        <span class="focus-border"></span>
                        @if ($errors->has('password'))
                            <div class="mt-4 alert alert-danger alert-dismissible fade show error" role="alert">
                                {{ $errors->first('password') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="positioning input-effect{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <input class="effect" id="password_confirm" type="password" name="password_confirmation" placeholder="" required>
                        <label>{{trans('front.password-confirm')}}</label>
                        <span class="focus-border"></span>
                        @if ($errors->has('password_confirmation'))
                            <div class="mt-4 alert alert-danger alert-dismissible fade show error" role="alert">
                                {{ $errors->first('password_confirmation') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="submit-btn">{{trans('front.reset-password')}}</button>


                </form>
            </div>
        </div>

    </div>

@endsection
