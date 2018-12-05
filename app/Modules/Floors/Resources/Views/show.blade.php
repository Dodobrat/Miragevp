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
                    <div class="float-left d-none d-xl-block">
                        <span class="floor-indicator">
                        {{ trans('floors::front.floor-indicator') }}
                    </span>
                        <div class="floor-numbers-bars"></div>

                        <ul class="floor-numbers">
                            @foreach($floors as $floor)
                                <a href="{{ route('floor', ['slug' => $floor->slug]) }}" @if ($floor->slug == $current_floor->slug) class="floor-activated" @endif>
                                    <li class="floor-number">
                                        {{ $floor->floor_num }}
                                    </li>
                                </a>
                            @endforeach
                        </ul>

                        <div class="floor-numbers-bars"></div>
                    </div>

                    <div class="d-xl-none">
                        <span class="floor-indicator" style="">
                                            {{ trans('floors::front.floor-indicator') }}
                                        </span>
                        <div class="floor-numbers-bars @if($agent->isMobile()) small-bars one @endif"></div>

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

                    <div class="floor-numbers-bars @if($agent->isMobile()) small-bars @endif"></div>
                    </div>

                </div>
                <img src="{{asset('images/visual-selection/legend/leegend (2).JPG')}}" alt="" class="small-compass-desk d-none d-xl-block">
            </div>
            <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-xs-12 current-floor-info">
                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-xs-12 c-f-p-c">

                        <div class="nav" role="tablist">
                            <svg viewBox="0 0 1018 1000" height="100%" width="100%" id="smth">
                                @if(!empty($current_floor->floor_plan_media->first()))
                                    <image
                                            width="100%"
                                            height="100%"
                                            preserveAspectRatio="none"
                                            xlink:href="{{$current_floor->floor_plan_media->first()->getPublicPath()}}"
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
                                    @if($apartment->position == 'a')
                                        @if($apartment->user_id == null)
                                            <a class="ap-link"
                                               id="nav-{{ $apartment->slug }}-tab"
                                               data-toggle="tab"
                                               href="#nav-{{ $apartment->slug }}"
                                               role="tab"
                                               aria-controls="nav-{{ $apartment->slug }}"
                                               aria-selected="false">

                                                <path class="path" d="M497.333,566h254v14H783v74H751.333v46H783v74.667H751.333v89.667H740v26.333H663.333V864.333H620v26.333H544V864.333H499.667v26.333H424.333V864.333h-44v26.333h-76V864.333H272.667v26.333H225.333V864.333H214.667v-11H189v-47h25.667V774.667H189V700h25.667V654H189V580h25.667V566H464.333"/>
                                                <text class="ap-path-title" transform="translate(453 684)">
                                                    <tspan x="0" y="38" font-size="35">{{$apartment->title}}</tspan>
                                                </text>
                                            </a>
                                        @else
                                                <path class="booked-ap" d="M497.333,566h254v14H783v74H751.333v46H783v74.667H751.333v89.667H740v26.333H663.333V864.333H620v26.333H544V864.333H499.667v26.333H424.333V864.333h-44v26.333h-76V864.333H272.667v26.333H225.333V864.333H214.667v-11H189v-47h25.667V774.667H189V700h25.667V654H189V580h25.667V566H464.333"/>
                                                <text class="ap-booked-title" transform="translate(453 684)">
                                                    <tspan x="0" y="38" font-size="35">{{$apartment->title}}</tspan>
                                                </text>

                                        @endif
                                    @elseif($apartment->position == 'b2')
                                                <path class="path level-2"
                                                      d="M215,566H457V332h56V89H499V60H425V89H379.333V60H304.667V89H271.333V60h-47V89H216v16.667H187.667V181H216v39H187.667V414.333H215v45.333H187.667v74.667H215Z"/>
                                                <text class="ap-path-title" transform="translate(326 328)">
                                                    <tspan x="0" y="-25" font-size="35">{{$apartment->title}}</tspan>
                                                </text>
                                    @elseif($apartment->position == 'b1')
                                        @if($apartment->user_id == null)
                                            <a class="ap-link"
                                               id="nav-{{ $apartment->slug }}-tab"
                                               data-toggle="tab"
                                               href="#nav-{{ $apartment->slug }}"
                                               role="tab"
                                               aria-controls="nav-{{ $apartment->slug }}"
                                               aria-selected="false">

                                                <path class="path"
                                                      d="M457.25,512.5v53.25H216v-31H190V459h26V414.75H190V220.5h26V182.75H190V107.5h26V91h9.5V61.5h47.75V91h32V61.5h75.5V91H425V61.5h75V91h13.75V332.75h-56.5V477.5"/>
                                                <text class="ap-path-title" transform="translate(326 328)">
                                                    <tspan x="0" y="-25" font-size="35">{{$apartment->title}}</tspan>
                                                </text>
                                            </a>
                                        @else
                                                <path class="booked-ap"
                                                      d="M215,566H457V332h56V89H499V60H425V89H379.333V60H304.667V89H271.333V60h-47V89H216v16.667H187.667V181H216v39H187.667V414.333H215v45.333H187.667v74.667H215Z"/>
                                                <text class="ap-booked-title" transform="translate(326 328)">
                                                    <tspan x="0" y="-25" font-size="35">{{$apartment->title}}</tspan>
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
                                                      d="M570,477.25V332H513V89.5h31.25v-30H619v30h45v-30h75.75v30H750.5V105h30.25v76.25H750.5V219h30.25v76H750.5v44h30.25v75H750.5v44.25h30.25v76H750.5v31.5H570V512"/>
                                                <text class="ap-path-title" transform="translate(622 304)">
                                                    <tspan x="0" y="0" font-size="35">{{$apartment->title}}</tspan>
                                                </text>
                                            </a>
                                        @else
                                                <path class="booked-ap"
                                                      d="M570,477.25V332H513V89.5h31.25v-30H619v30h45v-30h75.75v30H750.5V105h30.25v76.25H750.5V219h30.25v76H750.5v44h30.25v75H750.5v44.25h30.25v76H750.5v31.5H570V512"/>
                                                <text class="ap-booked-title" transform="translate(622 304)">
                                                    <tspan x="0" y="0" font-size="35">{{$apartment->title}}</tspan>
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
                                                      d="M238.667,62V91.333h-9.333v17h-27V183h27v39.333h-27v73h27V341h-27v75.333h27V461h-27v74.333h27v44.333h-27V655h27v45.333h-27V774h27v32.333h-27v48.333h27v10h10.333v28.667h48V864.667h30.667v28.667h75V864.667h45v28.667H514V864.667h44.667v28.667h75V864.667H678v28.667h76V864.667h9.667v-89h29V700.333h-29V655h29V579.667h-29V535.333h29V461h-29V416.333h29V341h-29V295.333h29v-73h-29V183h29V108.333h-29v-17H753.333V62h-76V91.333H634V62H558V91.333H513.667V62H437.333V91.333H394V62H318V91.333H287V62Z"/>


                                                <text class="ap-path-title" transform="translate(458 642)">
                                                    <tspan x="0" y="38" font-size="35">{{$apartment->title}}</tspan>
                                                </text>
                                            </a>
                                        @else
                                                <path class="booked-ap"
                                                      d="M238.667,62V91.333h-9.333v17h-27V183h27v39.333h-27v73h27V341h-27v75.333h27V461h-27v74.333h27v44.333h-27V655h27v45.333h-27V774h27v32.333h-27v48.333h27v10h10.333v28.667h48V864.667h30.667v28.667h75V864.667h45v28.667H514V864.667h44.667v28.667h75V864.667H678v28.667h76V864.667h9.667v-89h29V700.333h-29V655h29V579.667h-29V535.333h29V461h-29V416.333h29V341h-29V295.333h29v-73h-29V183h29V108.333h-29v-17H753.333V62h-76V91.333H634V62H558V91.333H513.667V62H437.333V91.333H394V62H318V91.333H287V62Z"/>


                                                <text class="ap-booked-title" transform="translate(458 642)">
                                                    <tspan x="0" y="38" font-size="35">{{$apartment->title}}</tspan>
                                                </text>

                                        @endif
                                    @elseif($apartment->position == 'e')
                                        @if($apartment->user_id == null)
                                            <a class="ap-link"
                                               id="nav-{{ $apartment->slug }}-tab"
                                               data-toggle="tab"
                                               href="#nav-{{ $apartment->slug }}"
                                               role="tab"
                                               aria-controls="nav-{{ $apartment->slug }}"
                                               aria-selected="false">


                                                <path class="path"
                                                      d="M681,94h-9.5V65.5H589V94H558V65.5H469V94H437.75V65.5H349V94H318.25V65.5h-89.5V94h-25V65.5h-48V94H146.5v17.5H119v75.75h27.5V218.5H119v89h27.5v31.25H119V427h27.5v32.5H119V666.75h27.5V698.5H119V787h27.5v24.25H119V859h27.5v10.5h10.25v27.25H205V869.5h24.25v27.25h89V869.5h31v27.25H438V869.5h31.75v27.25h88.5V869.5H589v27.25h92Z"/>

                                                <text class="ap-path-title" transform="translate(351 661)">
                                                    <tspan x="30" y="32" font-size="35">{{$apartment->title}}</tspan>
                                                </text>
                                            </a>
                                        @else

                                                <path class="booked-ap"
                                                      d="M681,94h-9.5V65.5H589V94H558V65.5H469V94H437.75V65.5H349V94H318.25V65.5h-89.5V94h-25V65.5h-48V94H146.5v17.5H119v75.75h27.5V218.5H119v89h27.5v31.25H119V427h27.5v32.5H119V666.75h27.5V698.5H119V787h27.5v24.25H119V859h27.5v10.5h10.25v27.25H205V869.5h24.25v27.25h89V869.5h31v27.25H438V869.5h31.75v27.25h88.5V869.5H589v27.25h92Z"/>

                                                <text class="ap-booked-title" transform="translate(351 661)">
                                                    <tspan x="30" y="32" font-size="35">{{$apartment->title}}</tspan>
                                                </text>
                                        @endif
                                    @elseif($apartment->position == 'g')
                                        @if($apartment->user_id == null)
                                            <a class="ap-link"
                                               id="nav-{{ $apartment->slug }}-tab"
                                               data-toggle="tab"
                                               href="#nav-{{ $apartment->slug }}"
                                               role="tab"
                                               aria-controls="nav-{{ $apartment->slug }}"
                                               aria-selected="false">

                                                <path class="path" d="M161,565V798H636V565H161"/>
                                                <text class="ap-path-title" transform="translate(336 665)">
                                                    <tspan x="-30" y="30" font-size="25">{{$apartment->title}}</tspan>
                                                </text>
                                            </a>
                                        @else
                                            <path class="booked-ap" d="M161,565V798H636V565H161"/>
                                            <text class="ap-booked-title" transform="translate(336 665)">
                                                <tspan x="-30" y="30" font-size="25">{{$apartment->title}}</tspan>
                                            </text>
                                        @endif
                                    @endif
                                @endforeach
                            </svg>
                        </div>
                    </div>

                        <div class="d-xl-none col-lg-12 col-md-12 col-sm-12 col-12 small-floor">
                            <div class="container px-3 mx-auto py-3">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    @if(!empty($current_floor->compass_media->first()))
                                        <img class="small-floor-compass" src="{{$current_floor->compass_media->first()->getPublicPath()}}" alt="{{$current_floor->slug}}">
                                    @else
                                        <img class="small-floor-compass" src="{{asset('images/fallback/placeholder.png')}}" alt="{{$current_floor->slug}}">
                                    @endif
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                                    <img src="{{asset('images/visual-selection/legend/leegend (2).JPG')}}" alt="" class="small-compass">
                                </div>
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
                                        <div class="floor-ap-border"></div>
                                        <div class="floor-ap-info">
                                            {!! $apartment->description !!}
                                        </div>
                                        <div class="floor-ap-price">
                                            €  {{$apartment->price}}
                                        </div>
                                        <div class="go-to-ap">
                                            <a href="{{ route('apartment', ['slug' => $apartment->slug]) }}">{{ trans('floors::front.view') }} {{ $apartment->type }}</a>
                                        </div>
                                    </div>

                                @endforeach

                            </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


</section>






@endsection
