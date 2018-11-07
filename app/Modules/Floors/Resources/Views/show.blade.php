@extends('layouts.app')
@section('content')

    {{--{{dd($current_floor->apartments->type)}}--}}

<div class="container">
    <div class="row">
        <div class="col">
            {!! Breadcrumbs::render('index') !!}
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-2 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center floor-selection-section">
        <span class="floor-indicator">
            {{ trans('floors::front.floor-indicator') }}
        </span>
            <ul class="floor-numbers">
                @foreach($floors as $floor)
                    <a href="{{ route('floor', ['slug' => $floor->slug]) }}" @if ($floor->slug == $current_floor->slug) class="floor-activated" @endif>
                        <li class="floor-number">
                            {{ $floor->floor_num }}
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
        <div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-xs-12 current-floor-info">
            <div class="row">
                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @if(!empty($current_floor->plan_media->first()))
                        <img class="current-floor-plan" src="{{$current_floor->plan_media->first()->getPublicPath()}}" alt="{{$current_floor->slug}}">
                    @else
                        <img class="current-floor-plan" src="{{asset('images/fallback/placeholder.png')}}" alt="{{$current_floor->slug}}">
                    @endif
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-xs-12 current-floor-ap-info">
                    @if(!empty($current_floor->compass_media->first()))
                        <img class="current-floor-compass" src="{{$current_floor->compass_media->first()->getPublicPath()}}" alt="{{$current_floor->slug}}">
                    @else
                        <img class="current-floor-compass" src="{{asset('images/fallback/placeholder.png')}}" alt="{{$current_floor->slug}}">
                    @endif
                    <h1 class="floor-ap-title">
                        jyhtfkjyhgj
                    </h1>
                    <div class="floor-ap-info">
                        texttextalsc als fcbaslcf :
                        <br>
                        lackjasjccl,  ac,a
                        <br>
                        lasck kasmcsa m
                        <br>
                        ascn  as fasokji
                    </div>
                    <div class="floor-ap-price">
                        $ 123 899
                    </div>
                    <div class="go-to-ap">
                        <a href="#">view apartment</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>





@endsection
