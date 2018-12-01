@extends('layouts.app')

@section('content')

    <div class="container-fluid my-5">
        <h1 class="text-center">
           {{ trans('index::front.hello') }}, {{ $current_user->first_name }} !
        </h1>
    </div>



        <a class="notifications-bell" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="notifications-bell-icon"></i>
            <span class="badge">
                @if($all_notifications->where('read',0)->count() > 0 || $user_notifications->where('read',0)->count() > 0)
                    <div class="notifications-dot"></div>
                @endif
            </span>
        </a>

        <div class="collapse notifications-tray" id="collapseExample">
            <div class="card card-body notifications-tray-body">


                    <div class="notifications-list-container">
                        <h4 class="notifications-title">
                            {{ trans('front.all-notifications') }}
                        </h4>
                        <ul class="notifications-list">
                            @foreach($all_notifications->take(10) as $all_notification)
                                @if($all_notification->read == false)
                                    <li class="notifications-unread-list-item">
                                        <div class="notifications-text">
                                            {!! $all_notification->message !!}
                                        </div>
                                        <a class="notifications-read" href="{{ route('readAll') }}">&#10003;</a>
                                    </li>
                                @else
                                    <li class="notifications-read-list-item">
                                        <div class="notifications-text">
                                            {!! $all_notification->message !!}
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>


                    <div class="notifications-list-container">
                        <h4 class="notifications-title">
                            {{ trans('front.user-notifications') }}
                        </h4>
                        <ul class="notifications-list">
                            @foreach($user_notifications->take(10) as $notification)
                                @if($notification->read == false)
                                    <li class="notifications-unread-list-item">
                                        <div class="notifications-text">
                                            {!! $notification->message !!}
                                        </div>
                                        <a class="notifications-read" href="{{ route('readUser') }}">&#10003;</a>
                                    </li>
                                @elseif($notification->read == true)
                                    <li class="notifications-read-list-item">
                                        <div class="notifications-text">
                                            {!! $notification->message !!}
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>


            </div>
        </div>
    <div class="container-fluid">



        @foreach($user_apartments as $user_apartment)
            @if($user_apartment->type == 'apartment')
                <h1>your status on apartment
                    {{ $user_apartment->title }}
                </h1>
            @elseif($user_apartment->type == 'office')
                <h1>your status on office
                    {{ $user_apartment->title }}
                </h1>
            @endif
        @endforeach

    </div>

@endsection



