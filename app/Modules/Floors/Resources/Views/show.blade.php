@extends('layouts.app')
@section('content')


    {{--{{dd($current_floor->apartments)}}--}}
<section class="floor-view">
    <div class="container">
        <div class="row">
            <div class="col d-none d-lg-block d-xl-block">
                {!! Breadcrumbs::render('index') !!}
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="text-center floor-selection-section">
                    <span class="floor-indicator">
                        {{ trans('floors::front.floor-indicator') }}
                    </span>
                    <div class="floor-numbers-bars"></div>

                    <ul class="floor-numbers d-none d-xl-block">
                        @foreach($floors as $floor)
                            <a href="{{ route('floor', ['slug' => $floor->slug]) }}" @if ($floor->slug == $current_floor->slug) class="floor-activated" @endif>
                                <li class="floor-number">
                                    {{ $floor->floor_num }}
                                </li>
                            </a>
                        @endforeach
                    </ul>

                    <!-- Large modal -->
                    <button type="button" class="floor-select-trigger d-xl-none" data-toggle="modal" data-target=".bd-example-modal-lg">{{ $current_floor->floor_num }} <i></i></button>

                    <div class="modal fade bd-example-modal-lg floor-select-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg floor-modal">
                            <div class="modal-content">
                                <div class="floor-head">
                                    <h1>{{ trans('floors::front.choose-floor') }}</h1>
                                    <div class="floor-numbers-bars"></div>
                                </div>
                                <ul class="floor-small-numbers">
                                    @foreach($floors as $floor)
                                        <a href="{{ route('floor', ['slug' => $floor->slug]) }}" @if ($floor->slug == $current_floor->slug) class="floor-small-activated" @endif>
                                            <li class="floor-small-number">
                                                {{ $floor->floor_num }}
                                            </li>
                                        </a>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="floor-numbers-bars"></div>
                </div>
            </div>
            <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-xs-12 current-floor-info">
                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @if(!empty($current_floor->plan_media->first()))
                            <img class="current-floor-plan" src="{{$current_floor->plan_media->first()->getPublicPath()}}" alt="{{$current_floor->slug}}">
                        @else
                            <img class="current-floor-plan" src="{{asset('images/fallback/placeholder.png')}}" alt="{{$current_floor->slug}}">
                        @endif

                        {{--LINKS TO APARTMENTS--}}

                            @foreach($current_floor->apartments as $apartment)
                                <a class="ap-link" href="{{ route('apartment', ['slug' => $apartment->slug]) }}">{{ $apartment->title }}</a>
                            @endforeach

                        {{-----------------------}}

                    </div>
                    <div class="d-xl-none col-lg-12 col-md-12 col-sm-12 col-12 small-floor">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                @if(!empty($current_floor->compass_media->first()))
                                    <img class="small-floor-compass" src="{{$current_floor->compass_media->first()->getPublicPath()}}" alt="{{$current_floor->slug}}">
                                @else
                                    <img class="small-floor-compass" src="{{asset('images/fallback/placeholder.png')}}" alt="{{$current_floor->slug}}">
                                @endif
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                <img src="{{asset('images/visual-selection/legend/legend_2.png')}}" alt="" class="small-compass">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-xs-12 px-4 current-floor-ap-info">
                        @if(!empty($current_floor->compass_media->first()))
                            <img class="current-floor-compass d-none d-xl-block" src="{{$current_floor->compass_media->first()->getPublicPath()}}" alt="{{$current_floor->slug}}">
                        @else
                            <img class="current-floor-compass d-none d-xl-block" src="{{asset('images/fallback/placeholder.png')}}" alt="{{$current_floor->slug}}">
                        @endif
                        <div class="ap-info">
                            <h1 class="floor-ap-title">
                                14A
                            </h1>
                            <div class="floor-ap-info">
                                Details :
                                <br>
                                high ceilings
                                <br>
                                cool
                                <br>
                                extra very mega ultra cool
                            </div>
                            <div class="floor-ap-price">
                                $ 123 899
                            </div>
                            <div class="go-to-ap">
                                <a href="#">view apartment</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 d-none d-xl-block">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 text-center">
                        <div class="selected">
                            <img src="{{ asset('images/visual-selection/legend/selected.png') }}" alt="">
                            <p>{{ trans('floors::front.legend-selected') }}</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 text-center">
                        <div class="booked">
                            <img src="{{ asset('images/visual-selection/legend/booked.png') }}" alt="">
                            <p>{{ trans('floors::front.legend-booked') }}</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 text-center">
                        <div class="available">
                            <img src="{{ asset('images/visual-selection/legend/available.png') }}" alt="">
                            <p>{{ trans('floors::front.legend-available') }}</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 text-center">
                        <div class="multi-level">
                            <img src="{{ asset('images/visual-selection/legend/multi-level.png') }}" alt="">
                            <p>{{ trans('floors::front.legend-multi-level') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>






@endsection
