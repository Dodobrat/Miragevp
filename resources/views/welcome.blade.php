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


<section class="landing-image-container">


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
</section>
    <section class="location-container">

        <div id="map" style="height: 400px; width: 500px;"></div>
        <script>
            function initMap(){
                let options = {
                    zoom: Number("{!! Settings::get('contacts_zoom') !!}"),
                    center: {lat: parseFloat("{!! Settings::get('contacts_lat') !!}") , lng: parseFloat("{!! Settings::get('contacts_long') !!}")},
                    mapTypeControlOptions: {
                        mapTypeIds: ['styled_map']
                    },
                };
                let map = new google.maps.Map(document.getElementById('map'),options);
                let custMark = {
                    url: '{{Settings::getFile('contacts_pin_icon')}}',
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(45, 45)
                };
                let marker = new google.maps.Marker({
                    position:{lat: parseFloat("{!! Settings::get('contacts_lat') !!}") , lng: parseFloat("{!! Settings::get('contacts_long') !!}")},
                    map:map,
                    icon: custMark,

                });
                let styledMapType = new google.maps.StyledMapType(
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
                        {"featureType": "water","elementType": "labels.text.fill","stylers": [{"color": "#9e9e9e"}]}], {name: 'Styled Map'});
                map.mapTypes.set('styled_map', styledMapType);
                map.setMapTypeId('styled_map');
            }
        </script>
        <script async defer src="{!! Settings::get('google_map_api_key') !!}" type="text/javascript"></script>

        <div class="row">
            <div class="col-lg-5">
                <div class="container-fluid">
                    <h1 class="loc-title">{{trans('front.loc-title')}}</h1>
                    <div class="map" style="width: 100%; height: 50vh; background-color: #2c3e50;"></div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="container-fluid">
                    <div class="pic" style="width: 100%; height: 50vh; background-color: #2c3e50;"></div>
                    <div class="row">
                        <div class="col">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium adipisci amet aspernatur beatae commodi cumque cupiditate distinctio error eum ex expedita, inventore iusto laboriosam libero maxime modi quia quod quos rerum sed similique sint tempore temporibus tenetur voluptas voluptatem. Accusamus amet animi commodi</div>
                        <div class="col">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad at aut consectetur consequatur, debitis distinctio doloremque expedita harum, magni mollitia non rem sint sunt veniam voluptatem voluptatibus? Aperiam assumenda atque blanditiis deserunt expedita iste laboriosam magni mollitia necessitatibus nesciunt pariatur praesen</div>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <section class="view-container">
        <h1 class="text-center">{{trans('front.extra-view')}}</h1>
    </section>

    <section class="showroom-preview-container">
        <h1 class="text-center">{{trans('front.showroom')}}</h1>
    </section>




    @endsection