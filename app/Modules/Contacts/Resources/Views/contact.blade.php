@extends('layouts.app')
@section('content')

    <h1 class="text-center mb-3 mt-3 page-title">CONTACT</h1>
    @foreach($contacts as $contact)

        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 form-wrapper">
                    <form class="form custom-form" method="POST" action="{{ route('store') }}">
                        {{ csrf_field() }}
                        {{--<h3 class="text-center form-title">{{trans('front.register')}}</h3>--}}
                        @if ($errors->has('names'))
                            <div class="mt-0 mb-4 alert alert-danger alert-dismissible fade show error" role="alert">
                                {{ $errors->first('name') }}
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
                        @if ($errors->has('phone'))
                            <div class="mt-0 mb-4 alert alert-danger alert-dismissible fade show error" role="alert">
                                {{ $errors->first('phone') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->has('comment'))
                            <div class="mt-0 mb-4 alert alert-danger alert-dismissible fade show error" role="alert">
                                {{ $errors->first('comment') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="positioning input-effect{{ $errors->has('names') ? ' has-error' : '' }}">
                            <input class="effect" id="names" type="text" name="names" placeholder="" required>
                            <label>{{trans('front.names')}}</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="positioning input-effect{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <input class="effect" id="phone" type="text" name="phone" placeholder="" required>
                            <label>{{trans('front.phone')}}</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="positioning input-effect{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input class="effect" id="email" type="email" name="email" placeholder="" required>
                            <label>{{trans('front.email')}}</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="positioning input-effect{{ $errors->has('comment') ? ' has-error' : '' }}">
                            <textarea class="effect" id="comment" type="text" name="comment" placeholder="" required></textarea>
                            <label>{{trans('front.comment')}}</label>
                            <span class="focus-border" id="textarea"></span>
                        </div>
                        <input type="hidden" name="{{'contact_id'}}" value="{{$contact->id}}">

                        <button type="submit" class="submit-btn">{{trans('contacts::front.send')}}</button>

                    </form>
                </div>
            </div>

        </div>

    @endforeach
@endsection