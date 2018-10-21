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



            <div class=" text-center project-overview">
                <div class="container">
                    <h1>{{$project->title}}</h1>
                    <p>{!! $project->description !!}</p>
                </div>

            </div>




            <div class="accordion" id="floor-select">
                @foreach($floors as $floor)
                    <div class="card">
                        <button class="card-header collapsed" id="heading_{{$floor->id}}" type="button" data-toggle="collapse" data-target="#collapse_{{$floor->id}}" aria-expanded="false" aria-controls="collapseOne">
                                @if(!empty($floor->thumbnail_media()->first()) && $floor->show_media == true)
                                    <img src="{{$floor->thumbnail_media()->first()->getPublicPath()}}" alt="">
                                @else
                                    <img src="{{asset('images/fallback/placeholder.png')}}" alt="">
                                @endif
                        </button>
                        <div id="collapse_{{$floor->id}}" class="collapse" aria-labelledby="heading_{{$floor->id}}" data-parent="#floor-select">
                            <div class="card-body">
                                <h1>{{$floor->title}}</h1>
                                <div>{!! $floor->description !!}</div>
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