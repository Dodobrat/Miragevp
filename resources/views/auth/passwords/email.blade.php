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

                    <form class="form form-inner-pad" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="form-label" for="email">Email</label>
                            <input autocomplete="reset-email" id="email" type="email" class="form-control" name="email" required>
                            @if ($errors->has('email'))
                                <p class="error pl-2 pb-0">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <button type="submit" class="btn submit-btn"><p>Send Password Reset Link</p></button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection

