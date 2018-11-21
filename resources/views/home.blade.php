@extends('layouts.app')

@section('content')

    <div class="container-fluid my-5">
        <h1 class="text-center">
           {{ trans('index::front.hello') }}, {{ $current_user->first_name }} !
        </h1>
    </div>

    <div class="container-fluid">

        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Link with href
        </a>

        <div class="collapse" id="collapseExample">
            <div class="card card-body">

                @foreach($all_notifications->take(10) as $all_notification)
                    <div>
                        <ul>
                            @if($all_notification->read == false)
                                <li style="background-color: #eeeeee;">
                                    <h5>{!! $all_notification->message !!}</h5>
                                    <a href="{{ route('readAll') }}">show</a>
                                </li>
                            @else
                                <li style="background-color: #ffffff;">
                                    <h5>{!! $all_notification->message !!}</h5>
                                    {{--<a href="{{ route('read') }}">show</a>--}}
                                </li>
                            @endif
                        </ul>
                    </div>

                @endforeach
                    <hr>
                @foreach($user_notifications->take(10) as $notification)

                    <div>
                        <ul>
                            @if($notification->read == false)
                                <li style="background-color: #eeeeee;">
                                    <h5>{!! $notification->message !!}</h5>
                                    <a href="{{ route('readUser') }}">show</a>
                                </li>
                            @elseif($notification->read == true)
                                <li style="background-color: #ffffff;">
                                    <h5>{!! $notification->message !!}</h5>
                                    {{--<a href="{{ route('read') }}">show</a>--}}
                                </li>
                            @endif
                        </ul>
                    </div>

                @endforeach
            </div>
        </div>
        
        {{--<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">--}}
            {{--Notification--}}
            {{--@if(auth()->user()->unreadNotifications->count())--}}
            {{--<span class="badge badge-light">--}}

                    {{--{{ auth()->user()->unreadNotifications->count() }}--}}

            {{--</span>--}}
            {{--@endif--}}
        {{--</button>--}}

        {{--<div class="collapse notification-container" id="collapseExample">--}}
            {{--<div class="card card-body">--}}
                {{--@if(auth()->user()->unreadNotifications->count())--}}
                    {{--<a href="{{ route('read') }}">Read all</a>--}}
                {{--@endif--}}

                {{--<ul>--}}
                    {{--@foreach(auth()->user()->unreadNotifications as $notification)--}}
                        {{--<li style="background-color: #eeeeee">--}}
                            {{--{{ $notification->data['data'] }}--}}
                        {{--</li>--}}
                    {{--@endforeach--}}
                    {{--@foreach(auth()->user()->readNotifications->take(10) as $notification)--}}
                        {{--<li>--}}
                            {{--{{ $notification->data['data'] }}--}}
                        {{--</li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
            {{--</div>--}}
        </div>

        {{--@foreach($user_apartments as $user_apartment)--}}
            {{--@if($user_apartment->type == 'apartment')--}}
                {{--<h1>your status on apartment--}}
                    {{--{{ $user_apartment->title }}--}}
                {{--</h1>--}}
            {{--@elseif($user_apartment->type == 'office')--}}
                {{--<h1>your status on office--}}
                    {{--{{ $user_apartment->title }}--}}
                {{--</h1>--}}
            {{--@endif--}}
        {{--@endforeach--}}



@endsection



