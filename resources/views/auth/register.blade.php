@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <h1 class="mt-5 text-center">Register</h1>
                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name">First Name</label>
                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>
                        @if ($errors->has('first_name'))
                            <br><div class="alert alert-danger">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name">Last Name</label>
                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                        @if ($errors->has('last_name'))
                            <br><div class="alert alert-danger">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Email address</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <br><div class="alert alert-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                            <br><div class="alert alert-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password_confirm">Confirm Password</label>
                        <input id="password_confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>


                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>


@endsection
