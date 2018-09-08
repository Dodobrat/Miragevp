@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-6 col-md-8 form-wrapper">
                <div class="panel panel-default">
                    <h1 class="text-center text-white pb-5">RESET PASSWORD</h1>


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form form-inner-pad" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="form-label" for="email">Email</label>
                            <input autocomplete="reset-email" id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required>
                            @if ($errors->has('email'))
                                <p class="error pl-2 pb-0">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="form-label" for="password">Password</label>
                            <input autocomplete="reset-pass" id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <p class="error pl-2 pb-0">{{ $errors->first('password') }}</p>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="form-label" for="password-confirm">Password</label>
                            <input autocomplete="reset-pass-conf" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <p class="error pl-2 pb-0">{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>

                        <button type="submit" class="btn submit-btn"><p>Reset Password</p></button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
