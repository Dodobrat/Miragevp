@extends('layouts.app')
@section('content')

    {{--{{dd($current_floor->apartments->type)}}--}}
<section class="floor-view">
    <div class="container">
        <div class="row">
            <div class="col">
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
                    <ul class="floor-numbers">
                        @foreach($floors as $floor)
                            <a href="{{ route('floor', ['slug' => $floor->slug]) }}" @if ($floor->slug == $current_floor->slug) class="floor-activated" @endif>
                                <li class="floor-number">
                                    {{ $floor->floor_num }}
                                </li>
                            </a>
                        @endforeach
                    </ul>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="selected">
                                    <img src="{{ asset('images/visual-selection/legend/selected.png') }}" alt="">
                                    <p>{{ trans('floors::front.legend-selected') }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="booked">
                                    <img src="{{ asset('images/visual-selection/legend/booked.png') }}" alt="">
                                    <p>{{ trans('floors::front.legend-booked') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="available">
                                    <img src="{{ asset('images/visual-selection/legend/available.png') }}" alt="">
                                    <p>{{ trans('floors::front.legend-available') }}</p>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="multi-level">
                                    <img src="{{ asset('images/visual-selection/legend/multi-level.png') }}" alt="">
                                    <p>{{ trans('floors::front.legend-multi-level') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-xs-12 current-floor-ap-info">
                        @if(!empty($current_floor->compass_media->first()))
                            <img class="current-floor-compass" src="{{$current_floor->compass_media->first()->getPublicPath()}}" alt="{{$current_floor->slug}}">
                        @else
                            <img class="current-floor-compass" src="{{asset('images/fallback/placeholder.png')}}" alt="{{$current_floor->slug}}">
                        @endif
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


</section>






@endsection
