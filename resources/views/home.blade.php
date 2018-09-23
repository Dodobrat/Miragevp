@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mt-5 pt-5">{{trans('front.dashboard')}}</h1>

    {{--<form action="{{ route('newsletter_subscriber.store') }}" method="post" class="form-inline">--}}
        {{--{{ csrf_field() }}--}}
        {{--<div class="form-group mb-2">--}}
            {{--<input type="email" class="form-control" id="news-mail" placeholder="E-mail">--}}
        {{--</div>--}}
        {{--<button type="submit" class="btn btn-primary mb-2">{{ trans('newsletter::front.subscribe') }}</button>--}}
    {{--</form>--}}

</div>
@endsection



