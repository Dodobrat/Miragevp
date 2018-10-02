@extends('layouts.app')
@section('content')

    <h1 class="text-center mb-3 mt-3 page-title">{{ trans('showroom::front.module_name') }}</h1>
        {{--{{dd($showrooms->find(2))}}--}}
        {{--@foreach($showrooms as $showroom)--}}

            {{--@if(!empty($showroom->media->isNotEmpty()))--}}
                {{--<img src="{{ $showroom->media()->first()->getPublicPath() }}" alt="">--}}
                {{--<h3>{{ $showroom->media()->first()->title }}</h3>--}}
                {{--<p>{{ $showroom->media()->first()->description }}</p>--}}
                {{--<div style="background-image: url('{{ $showroom->media()->first()->getPublicPath() }}')"></div>--}}
            {{--@else--}}
                {{--<div style="height: 200px; width: 500px; background: #0c5460;"></div>--}}
            {{--@endif--}}




            {{--<img src="{{$showroom->media->where('id', 4)->first()->getPublicPath()}}" alt="">--}}
            {{--<img src="{{ $showroom->media()->whereTranslation('title', 'image one')->first()->getPublicPath() }}" alt="">--}}
            {{--@if(!empty($showroom->media))--}}
                {{--<img src="{{ $showroom->media()->first()->getPublicPath() }}" alt="">--}}
                {{--@foreach ($showroom->media as $media)--}}
                    {{--@if(!empty($media))--}}
                    {{--<img src="{{ $media->getPublicPath() }}" alt="">--}}
                    {{--<p>{{ $media->description }}</p>--}}
                    {{--@endif--}}
                {{--@endforeach--}}
            {{--@endif--}}

        {{--@endforeach--}}




    <div class="showroom-thumbnail-container">
        <ul class="showroom-thumbnail-images-list">
            @foreach($showrooms as $showroom)
            <li class="showroom-thumbnail-images-list-item">
                <a href="#show_{{ $showroom->id }}" class="showroom-thumbnail-images-link">
                    <img class="showroom-thumbnail-img" src="
                        @if($showroom->media->isNotEmpty())
                            {{ $showroom->media()->first()->getPublicPath() }}
                        @else
                            {{--<div style="height: 200px; width: 500px; background: #0c5460;"></div>--}}
                        @endif
                    ">
                </a>
            </li>
            @endforeach
        </ul>
    </div>


    <div class="showroom-media-view-container">
        @foreach($showrooms as $showroomMedia)
        <div class="showroom-media-image-container" id="show_{{ $showroomMedia->id }}">
            @if($showroomMedia->media->isNotEmpty())
                @foreach($showroomMedia->media as $media)
                    <h1 class="showroom-media-img-title">{{$media->title}}</h1>
                    <p class="showroom-media-img-desc">{{$media->description}}</p>
                    <img class="showroom-media-img" src="{{$media->getPublicPath()}}">
                @endforeach
            @endif
        </div>
        @endforeach
    </div>





    {{--<div class="showroom-thumbnail-container">--}}
        {{--<ul class="nav nav-pills showroom-thumbnail-images-list" id="pills-tab" role="tablist">--}}
            {{--@foreach($showrooms as $showroom)--}}
                {{--<li class="nav-item showroom-thumbnail-images-list-item">--}}
                    {{--<a class="showroom-thumbnail-images-link" id="img-tab" data-toggle="pill" href="#tab_{{ $showroom->id }}" role="tab" aria-controls="tab" aria-selected="false">--}}
                            {{--<img class="showroom-thumbnail-img" src="--}}
                    {{--@if($showroom->media->isNotEmpty())--}}
                            {{--{{ $showroom->media()->first()->getPublicPath() }}--}}
                            {{--@else--}}
                            {{--<div style="height: 200px; width: 500px; background: #0c5460;"></div>--}}
                            {{--@endif--}}
                                    {{--" alt="">--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
        {{--<div class="tab-content showroom-media-view-container" id="pills-tabContent">--}}
            {{--@foreach($showrooms as $showroomMedia)--}}
                {{--<div class="tab-pane showroom-media-image-container" id="tab_{{ $showroomMedia->id }}" role="tabpanel" aria-labelledby="img-tab">--}}

                {{--@if($showroomMedia->media->isNotEmpty())--}}
                    {{--@foreach($showroomMedia->media as $media)--}}
                        {{--<h1 class="showroom-media-img-title">{{$media->title}}</h1>--}}
                        {{--<p class="showroom-media-img-desc">{{$media->description}}</p>--}}
                        {{--<img class="showroom-media-img" src="{{$media->getPublicPath()}}">--}}
                    {{--@endforeach--}}
                 {{--@endif--}}
                {{--</div>--}}
                {{--@endforeach--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection