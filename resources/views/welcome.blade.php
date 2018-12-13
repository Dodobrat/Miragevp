@extends('layouts.app')
@section('content')

<section class="landing-image-container" id="land-img">

@if($agent->isDesktop())
    <div class="landing-image parallax-img"
         @if(!empty(Settings::getFile('index_landing_image')))
            style="background-image: url('{{ Settings::getFile('index_landing_image') }}');"
         @else
            style="background-image: url('{{ asset('images/land.jpg') }}');"
         @endif>
        <div class="container motto-cont">
            <h3 class="motto">
                @if(!empty(Administration::getStaticBlock('motto')))
                    {!! Administration::getStaticBlock('motto') !!}
                @else
                    {{ trans('front.static-block-motto') }}
                @endif
            </h3>
        </div>
    </div>
@elseif($agent->isMobile())
    <div class="landing-image static-img"
        @if(!empty(Settings::getFile('index_landing_image')))
            style="background-image: url('{{ Settings::getFile('index_landing_image') }}');"
        @else
            style="background-image: url('{{ asset('images/land.jpg') }}');"
        @endif>
        <div class="container mob-motto-cont">
            @if(!empty(Administration::getStaticBlock('motto')))
                {!! Administration::getStaticBlock('motto') !!}
            @else
                {{ trans('front.static-block-motto') }}
            @endif
        </div>
    </div>
@endif

    <a class="animate" id="one" href="#loc-cont"><span></span><span></span></a>

</section>

<section class="location-container" id="loc-cont">
    <div class="container-fluid">
        <div class="row">
            @if(Settings::get('index_map_visible') == 1)
                <script>
                    function initMap(){

                        let map = new google.maps.Map(document.getElementById('map'),{
                            zoom: 13,
                            center: {lat: parseFloat("{!! Settings::get('index_map.lat') !!}") , lng: parseFloat("{!! Settings::get('index_map.lng') !!}")},
                            styles: [
                                {"elementType": "geometry","stylers": [{"color": "#212121"}]},
                                {"elementType": "labels.icon","stylers": [{"visibility": "off"}]},
                                {"elementType": "labels.text.fill","stylers": [{"color": "#757575"}]},
                                {"elementType": "labels.text.stroke","stylers": [{"color": "#212121"}]},
                                {"featureType": "administrative","elementType": "geometry","stylers": [{"color": "#757575"}]},
                                {"featureType": "administrative.country","elementType": "labels.text.fill","stylers": [{"color": "#9e9e9e"}]},
                                {"featureType": "administrative.land_parcel","stylers": [{"visibility": "off"}]},
                                {"featureType": "administrative.locality","elementType": "labels.text.fill","stylers": [{"color": "#bdbdbd"}]},
                                {"featureType": "poi","elementType": "labels.text.fill","stylers": [{"color": "#757575"}]},
                                {"featureType": "poi.park","elementType": "geometry","stylers": [{"color": "#181818"}]},
                                {"featureType": "poi.park","elementType": "labels.text.fill","stylers": [{"color": "#616161"}]},
                                {"featureType": "poi.park","elementType": "labels.text.stroke","stylers": [{"color": "#1b1b1b"}]},
                                {"featureType": "road","elementType": "geometry.fill","stylers": [{"color": "#2c2c2c"}]},
                                {"featureType": "road","elementType": "labels.text.fill","stylers": [{"color": "#8a8a8a"}]},
                                {"featureType": "road.arterial","elementType": "geometry","stylers": [{"color": "#373737"}]},
                                {"featureType": "road.highway","elementType": "geometry","stylers": [{"color": "#3c3c3c"}]},
                                {"featureType": "road.highway.controlled_access","elementType": "geometry","stylers": [{"color": "#4e4e4e"}]},
                                {"featureType": "road.local","elementType": "labels.text.fill","stylers": [{"color": "#616161"}]},
                                {"featureType": "transit","elementType": "labels.text.fill","stylers": [{"color": "#757575"}]},
                                {"featureType": "water","elementType": "geometry","stylers": [{"color": "#000000"}]},
                                {"featureType": "water","elementType": "labels.text.fill","stylers": [{"color": "#3d3d3d"}]}
                            ],
                            mapTypeControlOptions: {
                                mapTypeIds: ['roadmap', 'styled_map']
                            },
                        });

                        let custMark = {
                            {{--url: '{{Settings::getFile('contacts_pin_icon')}}',--}}
                                    {{--url: '{{asset('images/maps-marker/marker.png')}}',--}}
                            url: '{{asset('images/maps-marker/marker.png')}}',
                            size: new google.maps.Size(71, 71),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(17, 34),
                            scaledSize: new google.maps.Size(45, 45)
                        };
                        let marker = new google.maps.Marker({
                            position:{lat: parseFloat("{!! Settings::get('index_map.lat') !!}") , lng: parseFloat("{!! Settings::get('index_map.lng') !!}")},
                            map:map,
                            icon: custMark,
                        });

                        var styledMapType = new google.maps.StyledMapType(
                            [{"elementType": "geometry","stylers": [{"color": "#f5f5f5"}]},
                                {"elementType": "labels.icon","stylers": [{"visibility": "off"}]},
                                {"elementType": "labels.text.fill","stylers": [{"color": "#616161"}]},
                                {"elementType": "labels.text.stroke","stylers": [{"color": "#f5f5f5"}]},
                                {"featureType": "administrative.land_parcel","elementType": "labels.text.fill","stylers": [{"color": "#bdbdbd"}]},
                                {"featureType": "poi","elementType": "geometry","stylers": [{"color": "#eeeeee"}]},
                                {"featureType": "poi","elementType": "labels.text.fill","stylers": [{"color": "#757575"}]},
                                {"featureType": "poi.park","elementType": "geometry","stylers": [{"color": "#e5e5e5"}]},
                                {"featureType": "poi.park","elementType": "labels.text.fill","stylers": [{"color": "#9e9e9e"}]},
                                {"featureType": "road","elementType": "geometry","stylers": [{"color": "#ffffff"}]},
                                {"featureType": "road.arterial","elementType": "labels.text.fill","stylers": [{"color": "#757575"}]},
                                {"featureType": "road.highway","elementType": "geometry","stylers": [{"color": "#dadada"}]},
                                {"featureType": "road.highway","elementType": "labels.text.fill","stylers": [{"color": "#616161"}]},
                                {"featureType": "road.local","elementType": "labels.text.fill","stylers": [{"color": "#9e9e9e"}]},
                                {"featureType": "transit.line","elementType": "geometry","stylers": [{"color": "#e5e5e5"}]},
                                {"featureType": "transit.station","elementType": "geometry","stylers": [{"color": "#eeeeee"}]},
                                {"featureType": "water","elementType": "geometry","stylers": [{"color": "#c9c9c9"}]},
                                {"featureType": "water","elementType": "labels.text.fill","stylers": [{"color": "#9e9e9e"}]}], {name: 'Light'});

                        map.mapTypes.set('styled_map', styledMapType);
                        map.setMapTypeId('styled_map');
                    }
                </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ Settings::get('google_map_api_key') }}&callback=initMap" type="text/javascript"></script>

                <div class="col-xl-6 col-lg-12 pl-xl-4">
                    <div class=" row align-items-center justify-content-center location-container-title">
                        <div class="col-2 text-right">
                            <img class="map-marker" src="{{ asset('images/mark.png') }}" alt="">
                        </div>
                        <div class="col-10 text-left">
                            <h1 class="location-container-text">
                                <?php
                                $str= trans('front.best-loc');
                                $exploded=explode(" ",$str);
                                echo str_replace(" ","<br>",$str);
                                ?>
                            </h1>
                        </div>
                    </div>
                    <div class="pic-cont">
                        <img class="pic" src="{{ asset('images/iconss.png') }}">
                    </div>

                    <div class="row">
                        <div class="col location-container-block">
                            <p>
                                @if(!empty(Administration::getStaticBlock('loc')))
                                    {!! Administration::getStaticBlock('loc') !!}
                                @else
                                    {{ trans('front.static-block-loc-section') }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 pr-xl-4">
                    <div id="map" class="home-map"></div>
                </div>
            @else
                <div class="col-xl-12">
                    <h1 class="text-center">{{trans('front.great-loc')}}</h1>
                    <div class="pic"
                        @if(!empty(Settings::getFile('index_landing_image')))
                            style="background-image: url('{{ Settings::getFile('index_landing_image') }}');"
                        @else
                            style="background-image: url('{{ asset('images/fallback/placeholder.png') }}');"
                        @endif>
                    </div>
                    <div class="row">
                        <div class="col location-container-block">
                            <p>
                                @if(!empty(Administration::getStaticBlock('loc')))
                                    {!! Administration::getStaticBlock('loc') !!}
                                @else
                                    {{ trans('front.static-block-loc-section') }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <a class="animate" id="two" href="#view-cont"><span></span><span></span></a>

</section>

<section class="view-container" id="view-cont">
    <div class="view-container-bg view-container-parallax-img"
         @if(!empty(Settings::getFile('index_view_image')))
         style="background-image: url('{{ Settings::getFile('index_view_image') }}');"
         @else
         style="background-image: url('{{ asset('images/viewss.jpg') }}');"
            @endif>
        <h1 class="container-fluid view-container-title">
            <?php
                $str= trans('front.extra-view');
	            $exploded=explode(" ",$str);
	            echo str_replace(" ","<br>",$str);
            ?>
        </h1>
        <div class="view-container-section">
            <div class="container-fluid">
                <div class="row justify-content-center text-center view-container-box">
                    <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-image-container">
                            <img src="{{ asset('images/view/mishena.png') }}" alt="">
                        </div>
                        <h1>
                            <?php
                            $str= trans('front.visual-selection');
                            $exploded=explode(" ",$str);
                            echo str_replace(" ","<br>",$str);
                            ?>
                        </h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem consequuntur culpa delectus deserunt dicta doloribus, eius eum ipsa itaque iure numquam porro provident quo repellat saepe soluta ut voluptas voluptatem.</p>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-image-container">
                            <img src="{{ asset('images/view/360.png') }}" alt="">
                        </div>
                        <h1>
                            <?php
                            $str= trans('front.panoramic-view');
                            $exploded=explode(" ",$str);
                            echo str_replace(" ","<br>",$str);
                            ?>
                        </h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem consequuntur culpa delectus deserunt dicta doloribus, eius eum ipsa itaque iure numquam porro provident quo repellat saepe soluta ut voluptas voluptatem.</p>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-image-container">
                            <img src="{{ asset('images/view/connection.png') }}" alt="">
                        </div>
                        <h1>
                            <?php
                            $str= trans('front.available-upgrading');
                            $exploded=explode(" ",$str);
                            echo str_replace(" ","<br>",$str);
                            ?>
                        </h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem consequuntur culpa delectus deserunt dicta doloribus, eius eum ipsa itaque iure numquam porro provident quo repellat saepe soluta ut voluptas voluptatem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="animate" id="three" href="#showroom"><span></span><span></span></a>
</section>

<section class="showroom-container" id="showroom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-xs-12 showroom-description-container">
                <article class="showroom-description">
                    <img src="{{asset('images/showroom/chair.jpg')}}">
                    <div class="overlay">
                        <span class="showroom-bordered">{{ trans('front.showroom') }}</span>
                        <h1 class="showroom-class">{{ trans('front.first-class') }}</h1>
                        <h2 class="showroom-interior">{{ trans('front.interior') }}</h2>
                    </div>
                </article>
            </div>
            <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="showroom-container-list">
                    <div class="slide">
                        @foreach($showrooms as $showroom)
                            <article type="button" data-toggle="modal" data-target=".show_{{$showroom->id}}">

                                @if(!empty($showroom->media->first()))
                                    <img src="{{$showroom->media->first()->getPublicPath()}}" alt="Card image cap">
                                @else
                                    <img src="{{asset('images/fallback/placeholder.png')}}" alt="Card image cap">
                                @endif
                                <button>
                                    <?php
                                    explode(" ", $showroom->title);
                                    echo str_replace(" ","<br>",$showroom->title);
                                    ?>
                                </button>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($showrooms as $showroom)
        <div class="modal fade bd-example-modal-lg show_{{$showroom->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <button class="close-modal-carousel">&times;</button>
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content showroom-content">
                    <div id="carousel_{{$showroom->id}}" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach( $showroom->media as $media )
                                <li data-target="#carousel_{{$showroom->id}}" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @if($showroom->show_media === true)
                                @foreach($showroom->media as $media)
                                    <div class="carousel-item @if($loop->first) active @endif">
                                        <img class="d-block w-100" src="{{ $media->getPublicPath() }}" alt="MirageTower">
                                        @if(!empty($media->title) or !empty($media->description))
                                            <div class="carousel-caption d-none d-md-block">
                                                <h5><span>{{ $media->title }}</span></h5>
                                                <p><span>{!! $media->description !!}</span></p>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#carousel_{{$showroom->id}}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel_{{$showroom->id}}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

</section>
        @include('layouts.footer')

        {{--<a id="top" href="#land-img"><i></i></a>--}}

        <a href="#land-img" class="arrow-up">
            <span class="left-arm"></span>
            <span class="right-arm"></span>
            <span class="arrow-slide"></span>
        </a>

    @endsection