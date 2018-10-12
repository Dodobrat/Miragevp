@extends('layouts.app')
@section('content')


        {{--{!! Administration::getStaticBlock('key-test') !!}--}}
        {{--TAKING STATIC BLOCK (SAME AS WRITTEN)--}}

        {{--<img src="{{ \ProVision\Administration\Facades\Settings::getFile('index_landing_image') }}" alt="">--}}
        {{--TAKING IMAGE FROM SETTINGS--}}

        {{--<div>--}}
            {{--<ul>--}}
                {{--@foreach($users as $user)--}}
                    {{--<li>{{ $user->getFullName() }}</li>--}}
                {{--@endforeach--}}
            {{--</ul>--}}
        {{--</div>--}}
        {{--TAKING NAMES FROM USERS AND PUTTING THEM INTO LIST--}}


        {{--@foreach($apartments as $apartment)--}}
        {{--@foreach ($apartment->media as $media)--}}
        {{--<img src="{{ $media->getPublicPath() }}" alt="">--}}
        {{--@endforeach--}}
        {{--@endforeach--}}
        {{--TAKE IMAGE FROM MODULE--}}

        {{--<div class="land-img" style="height: 2000px;"></div>--}}

        {{--<div class="landing-img"--}}
            {{--@if(!empty(Settings::getFile('index_landing_image')))--}}
            {{--style="background-image: url('{{ Settings::getFile('index_landing_image') }}')"--}}
            {{--@else--}}
            {{--style="background-image: url('{{ asset('images/google-logo.png') }}')"--}}
                {{--@endif ></div>--}}


<section class="landing-image-container" id="land-img">


    <div class="landing-image parallax-img"
         @if(!empty(Settings::getFile('index_landing_image')))
         style="background-image: url('{{ Settings::getFile('index_landing_image') }}');"
         @else
         style="background-image: url('{{ asset('images/fallback/placeholder.png') }}');"
            @endif >
        <div class="container">
            <h3 class="motto">
                @if(!empty(Administration::getStaticBlock('motto')))
                    {!! Administration::getStaticBlock('motto') !!}
                    @else
                    {{ trans('front.static-block-motto') }}
                @endif
            </h3>
        </div>
    </div>
    {{--@if(!empty(Settings::getFile('index_landing_image')))--}}
    {{--<div class="landing-image" style="background-image: url('{{ Settings::getFile('index_landing_image') }}')--}}

    {{--@else--}}
        {{--style="background-image: url('{{ asset('images/google-logo.png') }}')--}}
    {{--@endif--}}

    <a class="animate" id="one" href="#loc-cont"><span></span><span></span></a>
</section>
    <section class="location-container" id="loc-cont">
        <h1 class="text-center">{{trans('front.great-loc')}}</h1>
{{--{{dd(Settings::get('index_map.lat'))}}--}}
        <div class="row">
            {{--{{dd(Settings::get('index_map_visible'))}}--}}
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
                <div class="col-lg-12 col-xl-5 pl-xl-4 pr-xl-2 px-lg-4 px-md-4 px-sm-5 px-xs-5">
                        <div id="map" style="height: 50vh; width: 100%;"></div>
                </div>
                <div class="col-lg-12 col-xl-7 pr-xl-4 pl-xl-2 px-lg-4 px-md-4 px-sm-5 px-xs-5">
                        <div class="pic" style="width: 100%; height: 50vh; background-color: #2c3e50;"></div>

                </div>
        @else
                <div class="col-lg-12">
                    <div class="container-fluid">
                        <div class="pic" style="width: 100%; height: 50vh; background-color: #2c3e50;"></div>
                    </div>

                </div>
@endif

        </div>

        <div class="row">
            <div class="col" style="margin: auto 10%;text-align: center;">
                <p>@if(!empty(Administration::getStaticBlock('loc-section')))
                        {!! Administration::getStaticBlock('loc-section') !!}
                    @else
                        {{ trans('front.static-block-loc-section') }}
                    @endif
                </p>
            </div>
        </div>


        <a class="animate" id="two" href="#view-cont"><span></span><span></span></a>
    </section>

    <section class="view-container" id="view-cont">
        <h1 class="text-center">{{trans('front.extra-view')}}</h1>
        <a class="animate" id="three" href="#show-cont"><span></span><span></span></a>
    </section>

    <section class="showroom-preview-container" id="show-cont">
        <h1 class="text-center">{{trans('front.showroom')}}</h1>
    </section>


        <a id="top" href="#land-img"><i></i></a>

    @endsection