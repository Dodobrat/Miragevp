@extends('layouts.app')
@section('content')

    {{--{!! Settings::get('contacts_lat') !!}--}}
    {{--{!! Settings::get('contacts_long') !!}--}}
    <div id="map" style="height: 400px; width: 100%;"></div>
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
            let defaultMark = {
                url: '{{asset('images/maps-marker/marker.png')}}',
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(45, 45)
            };
            let marker = new google.maps.Marker({
                position:{lat: parseFloat("{!! Settings::get('contacts_lat') !!}") , lng: parseFloat("{!! Settings::get('contacts_long') !!}")},
                map:map,
                icon: function setCustMarker(){
                        if(custMark === null){
                            defaultMark;
                        }else{
                            custMark;
                        }
                },

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
    {{--<h1 class="text-center mb-3 mt-3 page-title">CONTACT</h1>--}}
    @foreach($contacts as $contact)
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 form-wrapper">
                    <form class="form custom-form" method="POST" action="{{ route('contact.store') }}">
                        {{ csrf_field() }}
                        <h3 class="text-center form-title">{!! $contact->description !!}</h3>
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
@endsection