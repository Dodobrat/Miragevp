@extends('layouts.app')
@section('content')


    @foreach($projects as $project)
        @if($project->visible == true)
            <div class="project-parallax-img-container">
                <div class="project-parallax-img"
                @if(!empty($project->media()->first()) && $project->show_media == true)
                     style="background-image: url('{{$project->media()->first()->getPublicPath()}}');"
                @else
                     style="background-image: url('{{ asset('images/fallback/placeholder.png') }}');"
                @endif
                >



            <div class="text-center project-overview">
                <div class="container">
                    <h1>{{$project->title}}</h1>
                    <p>{!! $project->description !!}</p>
                </div>

            </div>




            <div class="accordion" id="floor-select">
                @foreach($floors as $floor)

                    <div class="card floor-card">
                        <div class="row floor-row">
                            <div class="col-xl-2 col-lg-1 col-md-12 col-sm-12 col-xs-12 d-none d-xl-block">
                            </div>
                            <div class="col-xl-8 col-lg-10 col-md-12 col-sm-12 col-xs-12">

                                <button class="card-header collapsed" id="heading_{{$floor->id}}" type="button" data-toggle="collapse" data-target="#collapse_{{$floor->id}}" aria-expanded="false" aria-controls="collapse_{{$floor->id}}">
                                    @if(!empty($floor->thumbnail_media()->first()) && $floor->show_media == true)
                                        <img src="{{$floor->thumbnail_media()->first()->getPublicPath()}}" alt="">
                                    @else
                                        <img src="{{asset('images/fallback/placeholder.png')}}" alt="">
                                    @endif
                                    <div class="row text-center">
                                        <div class="col">
                                            <p class="available-ap">{{trans('projects::front.available-aps')}} : {{$floor->apartments->count()}}</p>
                                        </div>
                                        <div class="col">
                                            <p class="floor-num">{{$floor->floor_num}}</p>
                                        </div>
                                        <div class="col">
                                            @if(!empty($floor->apartments->first()))
                                            <p class="ap-price">

                                               {{trans('projects::front.from')}} : € {{$floor->apartments->first()->price}}

                                            </p>
                                            @endif
                                        </div>
                                    </div>


                                </button>

                            </div>
                            <div class="col-xl-2 col-lg-1 col-md-12 col-sm-12 col-xs-12 d-none d-xl-block"></div>
                        </div>


                        <div id="collapse_{{$floor->id}}" class="collapse" aria-labelledby="heading_{{$floor->id}}" data-parent="#floor-select">
                            <div class="card-body" style="background-color: rgba(255,255,255,1);">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <h1 class="accordion-floor-title">{{$floor->title}}</h1>
                                        <div class="accordion-floor-description">{!! $floor->description !!}</div>
                                        @if(!empty($floor->media()->first()) && $floor->show_media == true)
                                            <img class="accordion-floor-img" src="{{$floor->media()->first()->getPublicPath()}}" alt="" style="width: 50%">
                                        @else
                                            <img class="accordion-floor-img" src="{{asset('images/fallback/placeholder.png')}}" alt="" style="width: 50%">
                                        @endif
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        @if(!empty($floor->plan_media()->first()) && $floor->show_media == true)
                                            <img class="accordion-floor-img" src="{{$floor->plan_media()->first()->getPublicPath()}}" alt="" style="width: 100%; height: 100%;">
                                        @else
                                            <img class="accordion-floor-img" src="{{asset('images/fallback/placeholder.png')}}" alt="" style="width: 100%; height: 100%;">
                                        @endif
                                    </div>
                                </div>
                                {{--@if(!empty($floor->media()->first()) && $floor->show_media == true)--}}
                                    {{--<img src="{{$floor->media()->first()->getPublicPath()}}" alt="">--}}
                                {{--@else--}}
                                    {{--<img src="{{asset('images/fallback/placeholder.png')}}" alt="">--}}
                                {{--@endif--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

                </div>
                {{--<div class="project-parallax-img-2"--}}
                     {{--@if(!empty($project->media()->find(2)) && $project->show_media == true)--}}
                     {{--style="background-image: url('{{$project->media()->find(2)->getPublicPath()}}');"--}}
                     {{--@else--}}
                     {{--style="background-image: url('{{ asset('images/fallback/placeholder.png') }}');"--}}
                        {{--@endif--}}
                {{--></div>--}}
            </div>
        @endif
    @endforeach

{{--@foreach($projects as $project)--}}
    {{--@if($project->visible == true)--}}
        {{--<section class="project-container">--}}
            {{--<div class="project-img"--}}
                {{--@if($project->show_media == true)--}}
                     {{--@if(!empty($project->media()->first()))--}}
                     {{--style="background-image: url('{{ $project->media()->first()->getPublicPath() }}');"--}}
                     {{--@else--}}
                     {{--style="background-image: url('{{ asset('images/fallback/placeholder.png') }}');"--}}
                     {{--@endif--}}
                {{--@endif>--}}
            {{--</div>--}}
            {{--@foreach($floors as $floor)--}}
                {{--<div class="floor-select"--}}
                     {{--@if($floor->show_media == true)--}}
                     {{--@if(!empty($floor->media()->first()))--}}
                     {{--style="background-image: url('{{ $floor->media()->first()->getPublicPath() }}');"--}}
                     {{--@else--}}
                     {{--style="background-image: url('{{ asset('images/fallback/placeholder.png') }}');"--}}
                        {{--@endif--}}
                        {{--@endif>--}}

                {{--</div>--}}
            {{--@endforeach--}}
        {{--</section>--}}


    {{--@endif--}}
{{--@endforeach--}}




@endsection