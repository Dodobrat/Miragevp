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
                            <svg viewBox="0 0 1903 1600" height="100%" width="100%" id="smth">
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
                                        {{--{{ dd($apartment->user_id) }}--}}
                                        @if($apartment->type == 'apartment')
                                            @if($apartment->position == 'a')
                                                @if($apartment->user_id == null)
                                                    <a class="ap-link"
                                                       id="nav-{{ $apartment->slug }}-tab"
                                                       data-toggle="tab"
                                                       href="#nav-{{ $apartment->slug }}"
                                                       role="tab"
                                                       aria-controls="nav-{{ $apartment->slug }}"
                                                       aria-selected="false">
                                                        <path class="path"
                                                              d="M491.715,905.324h914.792v18.343h63.905v117.751h-63.905v91.716h63.905v118.343h-63.905V1407.1h-12.426v52.663h-117.16V1407.1h-92.9v52.663h-117.16V1407.1H975.147v52.663H856.8V1407.1H765.088v52.663H646.745V1407.1H579.289v52.663H508.283V1407.1H491.715v-18.343H437.278v-69.822h54.438v-67.456H437.278V1133.135h54.438v-91.716H437.278V923.668h54.438Z"/>
                                                        <text class="ap-path-title" transform="translate(952 1170)">
                                                            <tspan x="-30" y="0" font-size="60">{{$apartment->title}}</tspan>
                                                        </text>
                                                    </a>
                                                @else
                                                    <path class="booked-ap"
                                                          d="M491.715,905.324h914.792v18.343h63.905v117.751h-63.905v91.716h63.905v118.343h-63.905V1407.1h-12.426v52.663h-117.16V1407.1h-92.9v52.663h-117.16V1407.1H975.147v52.663H856.8V1407.1H765.088v52.663H646.745V1407.1H579.289v52.663H508.283V1407.1H491.715v-18.343H437.278v-69.822h54.438v-67.456H437.278V1133.135h54.438v-91.716H437.278V923.668h54.438Z"/>
                                                    <text class="ap-booked-title" transform="translate(952 1170)">
                                                        <tspan x="-30" y="0" font-size="60">{{$apartment->title}}</tspan>
                                                    </text>
                                                @endif
                                            @elseif($apartment->position == 'b')
                                                @if($apartment->user_id == null)
                                                    <a class="ap-link"
                                                       id="nav-{{ $apartment->slug }}-tab"
                                                       data-toggle="tab"
                                                       href="#nav-{{ $apartment->slug }}"
                                                       role="tab"
                                                       aria-controls="nav-{{ $apartment->slug }}"
                                                       aria-selected="false">
                                                        <path class="path"
                                                              d="M901.532,879.381H491.578v-48.25H437.413v-118.8h54.165V620.845H437.413V293.581h54.165V212.562H437.413V95.585h54.165V71.461H506.6V9.558h70.551v61.9h69.64V9.558h118.8v61.9h91.488V9.558H974.963v61.9H991.8V477.013H901.532Z"/>
                                                        <text class="ap-path-title" transform="translate(758 320)">
                                                            <tspan x="-30" y="0" font-size="60">{{$apartment->title}}</tspan>
                                                        </text>
                                                    </a>
                                                @else
                                                    <path class="booked-ap"
                                                          d="M901.532,879.381H491.578v-48.25H437.413v-118.8h54.165V620.845H437.413V293.581h54.165V212.562H437.413V95.585h54.165V71.461H506.6V9.558h70.551v61.9h69.64V9.558h118.8v61.9h91.488V9.558H974.963v61.9H991.8V477.013H901.532Z"/>
                                                    <text class="ap-booked-title" transform="translate(758 320)">
                                                        <tspan x="-30" y="0" font-size="60">{{$apartment->title}}</tspan>
                                                    </text>
                                                @endif
                                            @elseif($apartment->position == 'c')
                                                @if($apartment->user_id == null)
                                                    <a class="ap-link"
                                                       id="nav-{{ $apartment->slug }}-tab"
                                                       data-toggle="tab"
                                                       href="#nav-{{ $apartment->slug }}"
                                                       role="tab"
                                                       aria-controls="nav-{{ $apartment->slug }}"
                                                       aria-selected="false">
                                                        <path class="path"
                                                              d="M1110,879.381h297V831h63V713h-63V621h63V503.5h-63V411h63V294h-63V212.5h63V95.5h-63v-24h-13V9H1276.5V71.5H1184V9H1066.5V71.5h-49v406H1110Z"/>
                                                        <text class="ap-path-title" transform="translate(1201 320)">
                                                            <tspan x="-30" y="0" font-size="60">{{$apartment->title}}</tspan>
                                                        </text>
                                                    </a>
                                                @else
                                                    <path class="booked-ap"
                                                          d="M1110,879.381h297V831h63V713h-63V621h63V503.5h-63V411h63V294h-63V212.5h63V95.5h-63v-24h-13V9H1276.5V71.5H1184V9H1066.5V71.5h-49v406H1110Z"/>
                                                    <text class="ap-booked-title" transform="translate(1201 320)">
                                                        <tspan x="-30" y="0" font-size="60">{{$apartment->title}}</tspan>
                                                    </text>
                                                @endif
                                            @elseif($apartment->position == 'd')
                                                @if($apartment->user_id == null)
                                                    <a class="ap-link"
                                                       id="nav-{{ $apartment->slug }}-tab"
                                                       data-toggle="tab"
                                                       href="#nav-{{ $apartment->slug }}"
                                                       role="tab"
                                                       aria-controls="nav-{{ $apartment->slug }}"
                                                       aria-selected="false">

                                                        <path class="path"
                                                              d="M506.5,9.5H577V72h70.5V9.5H765V72h92.5V9.5H975V72h92V9.5h117.5V72h92V9.5h118V72h13V95.5h63v118h-63V294h63V411h-63v92.5h63v118h-63V713h63V831.5h-63V923h63v118h-63v92h63v118h-63v155h-14v54H1276v-54h-92v54H1066.5v-54H975v54H856v-54H764v54H647v-54H578.5v54h-71v-54h-16v-17H438v-69.5h53.5v-69H438v-118h53.5V1041H438V922.5h53.5V831H438V713h53.5V621h-54V293.5h54V213h-54V95h54V72H507Z"/>


                                                        <text class="ap-path-title" transform="translate(952 717)">
                                                            <tspan x="-30" y="70" font-size="60">{{$apartment->title}}</tspan>
                                                        </text>
                                                    </a>
                                                @else
                                                    <path class="booked-ap"
                                                          d="M506.5,9.5H577V72h70.5V9.5H765V72h92.5V9.5H975V72h92V9.5h117.5V72h92V9.5h118V72h13V95.5h63v118h-63V294h63V411h-63v92.5h63v118h-63V713h63V831.5h-63V923h63v118h-63v92h63v118h-63v155h-14v54H1276v-54h-92v54H1066.5v-54H975v54H856v-54H764v54H647v-54H578.5v54h-71v-54h-16v-17H438v-69.5h53.5v-69H438v-118h53.5V1041H438V922.5h53.5V831H438V713h53.5V621h-54V293.5h54V213h-54V95h54V72H507Z"/>
                                                    <text class="ap-booked-title" transform="translate(952 717)">
                                                        <tspan x="-30" y="70" font-size="60">{{$apartment->title}}</tspan>
                                                    </text>
                                                @endif
                                            @endif
                                        @elseif($apartment->type == 'office')
                                            @if($apartment->position == 'a')
                                                @if($apartment->user_id == null)
                                                    <a class="ap-link"
                                                       id="nav-{{ $apartment->slug }}-tab"
                                                       data-toggle="tab"
                                                       href="#nav-{{ $apartment->slug }}"
                                                       role="tab"
                                                       aria-controls="nav-{{ $apartment->slug }}"
                                                       aria-selected="false">
                                                        <path class="path"
                                                              d="M491.715,905.324h914.792v18.343h63.905v117.751h-63.905v91.716h63.905v118.343h-63.905V1407.1h-12.426v52.663h-117.16V1407.1h-92.9v52.663h-117.16V1407.1H975.147v52.663H856.8V1407.1H765.088v52.663H646.745V1407.1H579.289v52.663H508.283V1407.1H491.715v-18.343H437.278v-69.822h54.438v-67.456H437.278V1133.135h54.438v-91.716H437.278V923.668h54.438Z"/>
                                                    </a>
                                                    <text class="ap-path-title" transform="translate(952 1170)">
                                                        <tspan x="-30" y="0" font-size="60">{{$apartment->title}}</tspan>
                                                    </text>
                                                @else
                                                    <path class="booked-ap"
                                                          d="M491.715,905.324h914.792v18.343h63.905v117.751h-63.905v91.716h63.905v118.343h-63.905V1407.1h-12.426v52.663h-117.16V1407.1h-92.9v52.663h-117.16V1407.1H975.147v52.663H856.8V1407.1H765.088v52.663H646.745V1407.1H579.289v52.663H508.283V1407.1H491.715v-18.343H437.278v-69.822h54.438v-67.456H437.278V1133.135h54.438v-91.716H437.278V923.668h54.438Z"/>
                                                @endif
                                            @elseif($apartment->position == 'b')
                                                @if($apartment->user_id == null)
                                                    <a class="ap-link"
                                                       id="nav-{{ $apartment->slug }}-tab"
                                                       data-toggle="tab"
                                                       href="#nav-{{ $apartment->slug }}"
                                                       role="tab"
                                                       aria-controls="nav-{{ $apartment->slug }}"
                                                       aria-selected="false">
                                                        <path class="path"
                                                              d="M901.532,879.381H491.578v-48.25H437.413v-118.8h54.165V620.845H437.413V293.581h54.165V212.562H437.413V95.585h54.165V71.461H506.6V9.558h70.551v61.9h69.64V9.558h118.8v61.9h91.488V9.558H974.963v61.9H991.8V477.013H901.532Z"/>
                                                    </a>
                                                @else
                                                    <path class="booked-ap"
                                                          d="M901.532,879.381H491.578v-48.25H437.413v-118.8h54.165V620.845H437.413V293.581h54.165V212.562H437.413V95.585h54.165V71.461H506.6V9.558h70.551v61.9h69.64V9.558h118.8v61.9h91.488V9.558H974.963v61.9H991.8V477.013H901.532Z"/>
                                                @endif
                                            @elseif($apartment->position == 'c')
                                                @if($apartment->user_id == null)
                                                    <a class="ap-link"
                                                       id="nav-{{ $apartment->slug }}-tab"
                                                       data-toggle="tab"
                                                       href="#nav-{{ $apartment->slug }}"
                                                       role="tab"
                                                       aria-controls="nav-{{ $apartment->slug }}"
                                                       aria-selected="false">
                                                        <path class="path"
                                                              d="M1110,879.381h297V831h63V713h-63V621h63V503.5h-63V411h63V294h-63V212.5h63V95.5h-63v-24h-13V9H1276.5V71.5H1184V9H1066.5V71.5h-49v406H1110Z"/>
                                                    </a>
                                                @else
                                                    <path class="booked-ap"
                                                          d="M1110,879.381h297V831h63V713h-63V621h63V503.5h-63V411h63V294h-63V212.5h63V95.5h-63v-24h-13V9H1276.5V71.5H1184V9H1066.5V71.5h-49v406H1110Z"/>

                                                @endif
                                            @elseif($apartment->position == 'd')
                                                @if($apartment->user_id == null)
                                                    <a class="ap-link"
                                                       id="nav-{{ $apartment->slug }}-tab"
                                                       data-toggle="tab"
                                                       href="#nav-{{ $apartment->slug }}"
                                                       role="tab"
                                                       aria-controls="nav-{{ $apartment->slug }}"
                                                       aria-selected="false">

                                                        <path class="path"
                                                              d="M506.5,9.5H577V72h70.5V9.5H765V72h92.5V9.5H975V72h92V9.5h117.5V72h92V9.5h118V72h13V95.5h63v118h-63V294h63V411h-63v92.5h63v118h-63V713h63V831.5h-63V923h63v118h-63v92h63v118h-63v155h-14v54H1276v-54h-92v54H1066.5v-54H975v54H856v-54H764v54H647v-54H578.5v54h-71v-54h-16v-17H438v-69.5h53.5v-69H438v-118h53.5V1041H438V922.5h53.5V831H438V713h53.5V621h-54V293.5h54V213h-54V95h54V72H507Z"/>


                                                        <text class="ap-path-title" transform="translate(952 717)">
                                                            <tspan x="-30" y="70" font-size="60">{{$apartment->title}}</tspan>
                                                        </text>
                                                    </a>
                                                @else
                                                    <path class="booked-ap"
                                                          d="M506.5,9.5H577V72h70.5V9.5H765V72h92.5V9.5H975V72h92V9.5h117.5V72h92V9.5h118V72h13V95.5h63v118h-63V294h63V411h-63v92.5h63v118h-63V713h63V831.5h-63V923h63v118h-63v92h63v118h-63v155h-14v54H1276v-54h-92v54H1066.5v-54H975v54H856v-54H764v54H647v-54H578.5v54h-71v-54h-16v-17H438v-69.5h53.5v-69H438v-118h53.5V1041H438V922.5h53.5V831H438V713h53.5V621h-54V293.5h54V213h-54V95h54V72H507Z"/>
                                                    <text class="ap-booked-title" transform="translate(952 717)">
                                                        <tspan x="-30" y="70" font-size="60">{{$apartment->title}}</tspan>
                                                    </text>
                                                @endif
                                            @endif

@endif

                                    @endforeach

                            </svg>
                        </div>
                    </div>
                    <div class="d-xl-none col-lg-12 col-md-12 col-sm-12 col-12 small-floor pt-5">
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
                                            € @php echo sprintf("%.2f", $apartment->price); @endphp
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
            <div class="col-xl-12 d-none d-xl-block pt-5">
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
