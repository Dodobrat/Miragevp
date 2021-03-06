@extends('administration::layouts.login')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="/" target="_blank"><b>{{config('APP.NAME','MirageVP')}}</b></a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">LOGIN</p>

            <form action="{{route('provision.administration.login_post')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember"> {{trans('administration::index.remember-me')}}
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" name="sign_in" class="btn btn-primary btn-block">{{trans('administration::index.sign-in')}}</button>
                    </div><!-- /.col -->
                </div>
            </form>


            {{--
           <div class="social-auth-links text-center">
               <p>- {{trans('administration::index.or')}} -</p>
               <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
           </div><!-- /.social-auth-links -->
           --}}

            <a class="btn btn-xs" href="{{route('provision.administration.password_reset')}}"><i class="fa fa-caret-right"></i> {{trans('administration::index.i-forgot-my-password')}}</a><br>
            {{--<a href="register.html" class="text-center">Register a new membership</a>--}}

        </div><!-- /.login-box-body -->

    </div>

@stop

@section('bottom_js')
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@stop