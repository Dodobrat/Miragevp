@extends('layouts.app')
@section('content')


    <h1 class="text-center page-title">{{Settings::getLocale('contacts_page_title', false)}}</h1>

<p class="text-center page-desc">
    @if(!empty(Administration::getStaticBlock('contact_page_desc')))
        {!! Administration::getStaticBlock('contact_page_desc') !!}
    @else
        {{ trans('front.static-block-contact') }}
    @endif</p>

    @if(Settings::get('contacts_map_visible') == 1)
        <div class="contacts-map-container">
            <div id="map" style="height: 500px; width: 100%;margin: auto;"></div>
        </div>
        <script>
            function initMap(){

                let map = new google.maps.Map(document.getElementById('map'),{
                    zoom: Number("{!! Settings::get('contacts_zoom') !!}"),
                    center: {lat: parseFloat("{!! Settings::get('contacts_lat') !!}") , lng: parseFloat("{!! Settings::get('contacts_long') !!}")},
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
        <script async defer src="{!! Settings::get('google_map_api_key') !!}" type="text/javascript"></script>
        @else

@endif

    {{--<h1 class="text-center mb-3 mt-3 page-title">CONTACT</h1>--}}
    @foreach($contacts as $contact)
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 form-wrapper">
                    <form class="form custom-form" method="POST" action="{{ route('contact.store') }}">
                        {{ csrf_field() }}
                        <h3 class="text-center form-title">{!! $contact->title !!}</h3>
                        <h5 class="text-center form-title">{!! $contact->description !!}</h5>
                        @if ($errors->any())
                            <div class="mt-0 mb-4 alert alert-danger alert-dismissible fade show error" role="alert">
                                {{ $errors->first() }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif(session()->has('status'))
                            <div class="mt-0 mb-4 alert alert-success alert-dismissible fade show error" role="alert">
                                <span>{{ session()->get('status') }}</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="positioning input-effect{{ $errors->has('names') ? ' has-error' : '' }}">
                            <input class="effect" id="names" type="text" name="names" placeholder="" required>
                            <label>{{trans('contacts::front.names')}}</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="positioning input-effect{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <input class="effect" id="phone" type="text" name="phone" placeholder="" required>
                            <label>{{trans('contacts::front.phone')}}</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="positioning input-effect{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input class="effect" id="email" type="email" name="email" placeholder="" required>
                            <label>{{trans('contacts::front.email')}}</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="positioning input-effect{{ $errors->has('comment') ? ' has-error' : '' }}">
                            <textarea class="effect" id="comment" type="text" name="comment" placeholder="" required></textarea>
                            <label>{{trans('contacts::front.comment')}}</label>
                            <span class="focus-border" id="textarea"></span>
                        </div>
                        <input type="hidden" name="contact_id" value="{{$contact->id}}">

                        <button type="submit" class="submit-btn">{{trans('contacts::front.send')}}</button>

                    </form>
                </div>
            </div>

        </div>

    @endforeach


    @include('layouts.footer')
@endsection