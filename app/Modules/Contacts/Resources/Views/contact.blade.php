@extends('layouts.app')
@section('content')

    {{--<h1 class="text-center page-title">{{Settings::getLocale('contacts_page_title', false)}}</h1>--}}
    <h2 class="text-center contact-title">{{trans('front.contact')}}</h2>

    <div class="container">
        <ul class="nav nav-pills my-3 contact-info-tabs justify-content-lg-center" id="pills-tab" role="tablist">
            @foreach($contacts as $map)
                <li class="nav-item contact-info-tab-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="pills-{{ $map->id }}-tab" data-toggle="pill" href="#pills-{{ $map->id }}" role="tab" aria-controls="pills-{{ $map->id }}" aria-selected="true">
                        @if(!empty($map->contact_media->first()))
                            <img src="{{ $map->contact_media->first()->getPublicPath() }}" alt="">
                        @else
                            <img src="{{ asset('images/fallback/placeholder.png') }}" alt="">
                        @endif
                            <p>{{ $map->title }}</p>
                    </a>
                    <br><br><br><br>
                </li>

            @endforeach
        </ul>
    </div>


    <div class="tab-content" id="pills-tabContent">
        @foreach($contacts as $map)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pills-{{ $map->id }}" role="tabpanel" aria-labelledby="pills-{{ $map->id }}-tab">

        <div class="row justify-content-center">
            <div class="col-lg-1 col-md-none" style="background-color: #7B8793;"></div>
            <div class="col-lg-10 col-md-12">
                <div class="row">
                    <div class="col-lg-7 col-md-12 contact-left-section">
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                @if(!empty($map->contact_media->first()))
                                    <img class="contact-left-img" src="{{ $map->contact_media->first()->getPublicPath() }}" alt="">
                                @else
                                    <img class="contact-left-img" src="{{ asset('images/fallback/placeholder.png') }}" alt="">
                                @endif
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <h1 class="contact-left-title">{{ $map->title }}</h1>
                                <div class="row">
                                    <div class="col">
                                        <span class="contact-left-span">{{ trans('contacts::front.working_days') }}:</span><br>
                                        <div class="contact-left-work">
                                            {!! $map->working_days !!}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <span class="contact-left-span">{{ trans('contacts::front.telephone') }}:</span><br>
                                        <h5 class="contact-left-phone">{{ $map->phone }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-5 col-md-12 contact-right-section">
                        <h5 class="contact-right-title">{{ $map->address }}</h5>
                        <div class="contact-right-desc">{!! $map->description !!}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-md-none" style="background-color: #D3DAE0;"></div>
        </div>



                @if($map->show_map == 1)
                    <div id="map-{{$map->id}}" style="height: 350px; width: 100%;margin: auto;"></div>
                    <script>
                        function initMap(){
                            let map{{$map->id}};

                            map{{$map->id}} = new google.maps.Map(document.getElementById('map-{{$map->id}}'),{
                                zoom: 13,
                                center: {lat: parseFloat("{{ $map->lat }}") , lng: parseFloat("{{ $map->lng }}")},
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
                                name: {
                                    name: ['Dark']
                                },
                                mapTypeControlOptions: {
                                    mapTypeIds: ['roadmap', 'styled_map']
                                },
                            });

                            let custMark = {
                                url: '{{asset('images/maps-marker/marker.png')}}',
                                size: new google.maps.Size(71, 71),
                                origin: new google.maps.Point(0, 0),
                                anchor: new google.maps.Point(17, 34),
                                scaledSize: new google.maps.Size(45, 45)
                            };
                            let marker = new google.maps.Marker({
                                position:{lat: parseFloat("{{ $map->lat }}") , lng: parseFloat("{{ $map->lng }}")},
                                map:map{{$map->id}},
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

                            map{{$map->id}}.mapTypes.set('styled_map', styledMapType);
                            map{{$map->id}}.setMapTypeId('styled_map');
                        }
                    </script>
                    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ Settings::get('google_map_api_key') }}&callback=initMap" type="text/javascript"></script>
                @else

                @endif

<div class="container-fluid con-bg-form">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 form-wrapper">
            <form class="form custom-form con-cust-form" method="POST" action="{{ url('store') }}">
                {{ csrf_field() }}
                <h3 class="text-left con-form-title">{{ trans('contacts::front.send_request') }}{{ $map->title }}</h3>
                <div class="alert alert-danger alert-dismissible fade error d-none" role="alert">
                </div>
                <div class="alert alert-success alert-dismissible fade error d-none" role="alert">
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="positioning input-effect{{ $errors->has('names') ? ' has-error' : '' }}">
                                    <input class="effect" id="names_{{$map->id}}" type="text" name="names" placeholder="" required>
                                    <label>{{trans('contacts::front.names')}}</label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="positioning input-effect{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <input class="effect" id="phone_{{$map->id}}" type="text" name="phone" placeholder="" required>
                                    <label>{{trans('contacts::front.phone')}}</label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="positioning input-effect{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input class="effect" id="email_{{$map->id}}" type="email" name="email" placeholder="" required>
                                    <label>{{trans('contacts::front.email')}}</label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="positioning input-effect{{ $errors->has('comment') ? ' has-error' : '' }}">
                                    <textarea class="effect" id="comment_{{$map->id}}" type="text" name="comment" placeholder="" required></textarea>
                                    <label>{{trans('contacts::front.comment')}}</label>
                                    <span class="focus-border" id="textarea"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <input type="hidden" name="contact_id" value="{{ $map->id }}">

                <button type="button" class="submit-btn float-right con-submit-btn" id="ajaxSubmitCon_{{$map->id}}">{{trans('contacts::front.send')}}</button>

            </form>
        </div>
    </div>
</div>




            </div>
        @endforeach
    </div>

    {{--<h1 class="text-center mb-3 mt-3 page-title">CONTACT</h1>--}}
    {{--@foreach($contacts as $contact)--}}


    {{--@endforeach--}}


    {{--@include('layouts.footer')--}}
@endsection