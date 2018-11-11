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

                        <div class="nav" role="tablist">
                            <svg viewBox="0 0 1785 2136" height="100%" width="100%" id="smth">
                                @if(!empty($current_floor->plan_media->first()))
                                    <image
                                            width="100%"
                                            height="100%"
                                            preserveAspectRatio="none"
                                            xlink:href="{{$current_floor->plan_media->first()->getPublicPath()}}"
                                            id=""
                                    />
                                @else
                                    <image
                                            width="100%"
                                            height="100%"
                                            preserveAspectRatio="none"
                                            xlink:href="{{asset('images/fallback/placeholder.png')}}"
                                            id=""
                                    />
                                @endif

                                    @foreach($current_floor->apartments as $apartment)
                                        <a class="ap-link" id="nav-{{ $apartment->slug }}-tab" data-toggle="tab" href="#nav-{{ $apartment->slug }}" role="tab" aria-controls="nav-{{ $apartment->slug }}" aria-selected="false">
                                            <path class="a" d="M994.362,95.935v542h123.245v537.1h396.344V1108.5h32.212V949.546h-32.212V829.1h32.212V670.844h-32.212V549h32.212V390.742h-32.212V285h32.212V126.046h-32.212V95.935h-16.806V66.524H1338.887V95.935H1219.144V66.524H1060.186V95.935Z"/></a>



                                           <path class="a" d="M962,636V96H941V66H779V96H659V66H500.251V96H406.863V66H313.633V96h-19.6v31.653H273.473V285.489h20.558V391.6H217.079V830.224h76.952v122.44H272.645v155.667h21.386v66.454H843.424V636Z"/>


                                            <path class="a" d="M293.333,1206.667h1220v25.784H1545.7v156.391h-32.365v123.712H1545.7v154.99h-32.365v208.209h-16.186v20.074H1337.955v-20.074H1217.978v20.074H1058.787v-20.074H937.876v20.074H780.552v-20.074H658.707v20.074H500.916v-20.074H410.35v20.074H315.115v-20.074H293.641v-22.875H272.633v-93.834h21.008v-91.033H272.633V1509.751h21.008l-.307-121.844h-20.7V1230.583h20.7Z"/>

                                    @endforeach

                            </svg>
                        </div>
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

                            <div class="ap-info tab-content" id="nav-tabContent">

                                @foreach($current_floor->apartments as $apartment)
                                    <div class="tab-pane fade" id="nav-{{ $apartment->slug }}" role="tabpanel" aria-labelledby="nav-{{ $apartment->slug }}-tab">
                                        <h1 class="floor-ap-title">
                                            {{ $apartment->title }}
                                        </h1>
                                        <div class="floor-ap-info">
                                            {!! $apartment->description !!}
                                        </div>
                                        <div class="floor-ap-price">
                                            {{  $apartment->price }}
                                        </div>
                                        <div class="go-to-ap">
                                            <a href="{{ route('apartment', ['slug' => $apartment->slug]) }}">view apartment</a>
                                        </div>
                                    </div>

                                @endforeach

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
