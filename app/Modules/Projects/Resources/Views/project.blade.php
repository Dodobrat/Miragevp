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
                <div class="container overview-box">
                    <h1>{{$project->title}}</h1>
                    {!! $project->description !!}
                </div>

            </div>




            <div class="accordion" id="floor-select">
                @foreach($floors as $floor)

                    <div class="card floor-card">

                        <div class="row floor-row">

                            <div class="container">
                                <button class="card-header collapsed" id="heading_{{$floor->id}}" type="button" data-toggle="collapse" data-target="#collapse_{{$floor->id}}" aria-expanded="false" aria-controls="collapse_{{$floor->id}}">
                                    @if(!empty($floor->thumbnail_media()->first()) && $floor->show_media == true)
                                        <img src="{{$floor->thumbnail_media()->first()->getPublicPath()}}" alt="">
                                    @else
                                        <img src="{{asset('images/fallback/placeholder.png')}}" alt="">
                                    @endif
                                    <div class="row floor-head-details">
                                        <div class="col text-center">
                                            <p class="floor-num">{{$floor->floor_num}}</p>
                                        </div>
                                    </div>
                                </button>
                            </div>

                        </div>


                        <div id="collapse_{{$floor->id}}" class="collapse" aria-labelledby="heading_{{$floor->id}}" data-parent="#floor-select">
                            <div class="card-body" style="background-color: rgba(255,255,255,1);">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                        <h1 class="accordion-floor-title" style="font-weight: 200; color:  #869AA6; padding: 20px;">{{$floor->title}}</h1>
                                        <div class="accordion-floor-description" style="padding: 0 20px 20px 20px; font-size: 18px;">{!! $floor->description !!}</div>
                                        <p class="floor-details" style="padding: 0 20px 20px 20px; font-size: 20px; font-weight: 200;">
                                            {{trans('projects::front.available-aps')}} :
                                            <span style="font-size: 30px; font-weight: 400; color: #869AA6;">
                                                {{$floor->apartments->count()}}
                                            </span>
                                            <br>
                                            @if(!empty($floor->apartments->first()))
                                                {{trans('projects::front.from')}} : <span style="font-size: 30px; font-weight: 400; color: #869AA6;">€ {{$floor->apartments->first()->price}}</span>
                                            @endif
                                        </p>

                                        @if(!empty($floor->media()->first()) && $floor->show_media == true)
                                            <img class="accordion-floor-img" src="{{$floor->media()->first()->getPublicPath()}}" alt="" style="width: 30%;object-fit: contain; margin: 20px;">
                                        @else
                                            <img class="accordion-floor-img" src="{{asset('images/fallback/placeholder.png')}}" alt="" style="width: 30%;object-fit: contain; margin: 20px;">
                                        @endif
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">

                                        <a class="" href="#">

                                            @if(!empty($floor->plan_media()->first()) && $floor->show_media == true)
                                                <img class="accordion-plan-img" src="{{$floor->plan_media()->first()->getPublicPath()}}" alt="" style="width: 100%; height: 100%; object-fit: contain;">
                                            @else
                                                <img class="accordion-plan-img" src="{{asset('images/fallback/placeholder.png')}}" alt="" style="width: 100%; height: 100%; object-fit: contain;">
                                            @endif

                                        </a>

                                    </div>
                                </div>

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