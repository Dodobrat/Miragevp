@extends('layouts.app')

@section('content')

    <div class="container-fluid py-5 mb-5 dash-head">
        <h3 class="dash-hello">
           {{ trans('index::front.hello') }}, {{ $current_user->first_name }} ! <a class="edit-user" data-toggle="modal" data-target=".bd-example-modal-lg">
                <i></i>
            </a>
        </h3>
        <a class="notifications-bell" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="notifications-bell-icon"></i>
            <span class="badge">
                @if($all_notifications->where('read',0)->count() > 0 || $user_notifications->where('read',0)->count() > 0)
                    <div class="notifications-dot"></div>
                @endif
            </span>
        </a>
    </div>



    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>
        </div>
    </div>


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

        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <h4 class="timeline-header text-center">{{ trans('front.latest') }}</h4>
                <ul class="timeline">
                    @foreach($user_apartments as $user_apartment)
                        <li class="news-item">
                            <div class="row">
                                <div class="col-8">
                                    @if($user_apartment->type == 'apartment')
                                        <a class="news-title">{{ trans('front.congrats-on-ap') }} {{ $user_apartment->title }} !</a>
                                    @elseif($user_apartment->type == 'office')
                                        <a class="news-title">{{ trans('front.congrats-on-of') }} {{ $user_apartment->title }} !</a>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <a class="float-right news-date">{{ $user_apartment->updated_at->format('d-m-Y') }}</a>
                                </div>
                            </div>


                        </li>
                    @endforeach
                    @foreach($timeline as $time)
                        <li class="news-item">
                            <a class="news-title">{{ $time->title }} !</a>
                            <a class="float-right news-date">{{ $time->created_at->format('d-m-Y') }}</a>
                                <hr>
                            {!! $time->message !!}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

@endsection



