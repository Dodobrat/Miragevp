@extends('layouts.app')

@section('content')



    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12 form-wrapper">
                <form class="form custom-form" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <h3 class="text-center form-title">{{trans('front.reset-password')}}</h3>
                    @if ($errors->has('email'))
                        <div class="mt-0 mb-4 alert alert-danger alert-dismissible fade show error" role="alert">
                            {{ $errors->first('email') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="positioning input-effect{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input autocomplete="new-email" class="effect" id="email" type="email" name="email" placeholder="" required>
                        <label>{{trans('front.email')}}</label>
                        <span class="focus-border"></span>
                    </div>

                    <button type="submit" class="submit-btn">{{trans('front.pass-reset-link')}}</button>

                </form>
            </div>
        </div>

    </div>


@endsection

