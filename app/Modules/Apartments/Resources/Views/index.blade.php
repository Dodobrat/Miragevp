@extends('layouts.app')
@section('content')

    <section class="apartment-view">
        <div class="row">
            <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-xs-12 @if($agent->isDesktop()) desk @endif apartment-information">
                <div class="apartment-bread d-none d-xl-block">
                    {!! Breadcrumbs::render('index') !!}
                </div>
                <h1 class="apartment-title">{{ trans('apartments::front.apartment') }} <span>{{$selected_apartment->title}}</span></h1>
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
            </div>

            <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-xs-12 @if($agent->isDesktop()) desk-media @endif apartment-media">
                <div class="d-none d-xl-block">
                    <a role="button" class="apartment-image-modal-button">
                        @if(!empty($selected_apartment->media->first()))
                            <img class="apartment-image @if($agent->isDesktop()) xl-image-polygon @endif" src="{{$selected_apartment->media->first()->getPublicPath()}}" alt="{{$selected_apartment->slug}}">
                        @else
                            <img class="apartment-image" src="{{asset('images/fallback/placeholder.png')}}" alt="{{$selected_apartment->slug}}">
                        @endif
                    </a>

                    {{--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">--}}
                        {{--<div class="modal-dialog modal-full" role="document">--}}
                            {{--<div class="modal-content">--}}
                                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                                    {{--<span aria-hidden="true">×</span>--}}
                                {{--</button>--}}
                                <div class="ap-gallery">
                                    <div class="col-10 modal-gallery">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            @foreach( $selected_apartment->media as $media )
                                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="v-pills-{{ $media->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $media->id }}-tab">
                                                    @if(!empty($media))
                                                        <img src="{{ $media->getPublicPath() }}" alt="">
                                                    @else
                                                        <img src="{{asset('images/fallback/placeholder.png')}}" alt="">
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-2 modal-thumb-gallery">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            @foreach( $selected_apartment->media as $media )
                                                <a class="apartment-modal-thumb nav-link {{ $loop->first ? 'active' : '' }}" id="v-pills-{{ $media->id }}-tab" data-toggle="pill" href="#v-pills-{{ $media->id }}" role="tab" aria-controls="v-pills{{ $media->id }}" aria-selected="true">

                                                    @if(!empty($media))
                                                        <img class="apartment-thumb-image" src="{{$media->getPublicPath()}}" alt="">
                                                    @else
                                                        <img class="apartment-thumb-image" src="{{asset('images/fallback/placeholder.png')}}" alt="{{$selected_apartment->slug}}">
                                                    @endif
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                </div>
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