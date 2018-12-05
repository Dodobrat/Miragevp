@extends('layouts.app')
@section('content')

    <section class="apartment-view">
        <div class="row">
            <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-xs-12 @if($agent->isDesktop()) desk @endif apartment-information">
                <div class="apartment-bread d-none d-xl-block">
                    {!! Breadcrumbs::render('index') !!}
                </div>
                <h1 class="apartment-title">{{ $selected_apartment->type }} <span>{{$selected_apartment->title}}</span></h1>
                <div class="apartment-title-border"></div>
                <div class="apartment-description">
                    {!! $selected_apartment->description !!}
                </div>
                <h3 class="apartment-price">€ <span class="price">{{ $selected_apartment->price }}</span></h3>
                <div class="apartment-plan-container">

                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        @if($selected_apartment->apartment_plans_media->count() > 1)
                            <ol class="carousel-indicators">
                                @foreach( $selected_apartment->apartment_plans_media as $plan )
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                        @endif

                        <div class="carousel-inner" role="listbox">
                            @foreach( $selected_apartment->apartment_plans_media as $plan )
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img class="d-block img-fluid" src="{{ $plan->getPublicPath() }}" alt="{{ $plan->slug }}">
                                </div>
                            @endforeach
                        </div>
                        @if($selected_apartment->apartment_plans_media->count() > 1)
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        @endif
                    </div>

                </div>
                @if($similar->count() > 0)
                    <div class="apartment-similar">
                        <p class="browse-similar">{{ trans('apartments::front.browse') }} :</p>
                        <ul class="apartment-similar-list">
                            @foreach($similar as $other)

                                    <a class="apartment-similar-list-item" href="{{ route('apartment', ['slug' => $other->slug]) }}">
                                        <li>
                                            {{ $other->title }}
                                        </li>
                                    </a>

                            @endforeach
                        </ul>
                    </div>
                @endif
                <a class="back-to-floor-desk" href="{{ route('floor', ['slug' => $selected_apartment->floor()->first()->slug]) }}">{{ trans('apartments::front.back-to-floor') }}</a>
            </div>


            <div class="d-none d-xl-block">
                <div class="car-info">
                    <h1 class="car-title">{{$selected_apartment->title}}</h1>
                    <div class="car-title-border"></div>
                </div>


                <button class="open-carousel">
                    <svg viewBox="-10 0 65 48">
                        <defs>
                            <style>
                                .a{
                                    fill:none;
                                    stroke:#707070;
                                }
                            </style>
                        </defs>
                        <g transform="translate(-0.646 -0.646)">
                            <path class="a" d="M0,0,23.555,23.555,0,47.11" transform="translate(1 1)"/>
                            <path class="a" d="M0,0,23.555,23.555,0,47.11" transform="translate(25 1)"/>
                        </g>
                    </svg>
                </button>

                <div id="carouselExampleIndicator" class="carousel slide apartment-carousel" data-ride="carousel">
                    <ol class="carousel-indicators ap-car-ind">
                        @foreach( $selected_apartment->media as $media )
                            <li data-target="#carouselExampleIndicator" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach( $selected_apartment->media as $media )
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img class="d-block img-custom" src="{{ $media->getPublicPath() }}" alt="{{ $media->slug }}">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev ap-car-prev" href="#carouselExampleIndicator" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next ap-car-next" href="#carouselExampleIndicator" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 @if($agent->isDesktop()) desk-media @endif apartment-media">

                <div class="d-xl-none">
                    <div class="mobile-gall">
                        <div class="tab-content mobile-gallery" id="pills-tabContent">
                            @foreach( $selected_apartment->media as $media )
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pills-{{ $media->id }}" role="tabpanel" aria-labelledby="pills-{{ $media->id }}-tab">
                                    @if(!empty($media))
                                        <img src="{{ $media->getPublicPath() }}" alt="">
                                    @else
                                        <img src="{{asset('images/fallback/placeholder.png')}}" alt="">
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <ul class="nav nav-pills mobile-pills" id="pills-tab" role="tablist">
                            @foreach( $selected_apartment->media as $media )
                                <li class="nav-item">
                                    <a class="apartment-thumb nav-link {{ $loop->first ? 'active' : '' }}" id="pills-{{ $media->id }}-tab" data-toggle="pill" href="#pills-{{ $media->id }}" role="tab" aria-controls="pills{{ $media->id }}" aria-selected="true">

                                        @if(!empty($media))
                                            <img class="apartment-thumb-image" src="{{$media->getPublicPath()}}" alt="">
                                        @else
                                            <img class="apartment-thumb-image" src="{{asset('images/fallback/placeholder.png')}}" alt="{{$selected_apartment->slug}}">
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="back-to-line">
                        <svg viewBox="0 0 412 25">
                            <defs>
                                <style>
                                    .a{
                                        fill:none;
                                        stroke:#d7f3f4;
                                    }
                                </style>
                            </defs>
                            <g transform="translate(-347 -24.5)">
                                <path class="a" d="M347,25H531l22.2,22.2"/>
                                <path class="a" d="M552.8,25H369.16L347,47.2" transform="translate(206.204)"/>
                            </g>
                        </svg>
                    </div>
                    <div class="back-to-floor-container">
                        <a class="back-to-floor" href="{{ route('floor', ['slug' => $selected_apartment->floor()->first()->slug]) }}">
                            {{ trans('apartments::front.back-to-floor') }}
                        </a>
                    </div>
                </div>



            </div>

        </div>
    </section>




@endsection