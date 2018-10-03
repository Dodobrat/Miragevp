@extends('layouts.app')
@section('content')

    <h1 class="text-center mb-3 mt-3 page-title">{{ trans('showroom::front.module_name') }}</h1>

        {{--@foreach($showrooms as $showroom)--}}
            {{--{{dd($showroom->find($showroom->id)->media)}}--}}
            {{--{{dd($showroom)}}--}}
            {{--{{dd($showroom->first()->media()->get())}}--}}

            {{--@if($showroom->media->isNotEmpty())--}}
                {{--<img src="{{ $showroom->media()->first()->getPublicPath() }}" alt="">--}}
                {{--<h3>{{ $showroom->media()->first()->title }}</h3>--}}
                {{--<p>{{ $showroom->media()->first()->description }}</p>--}}
                {{--<div style="background-image: url('{{ $showroom->media()->first()->getPublicPath() }}')"></div>--}}
            {{--@else--}}
                {{--<div style="height: 200px; width: 500px; background: #0c5460;"></div>--}}
            {{--@endif--}}




            {{--<img src="{{$showroom->media->where('id', 4)->first()->getPublicPath()}}" alt="">--}}
            {{--<img src="{{ $showroom->media()->whereTranslation('title', 'image one')->first()->getPublicPath() }}" alt="">--}}
            {{--@if($showroom->media->isNotEmpty())--}}
                {{--<img src="{{ $showroom->media()->first()->getPublicPath() }}" alt="">--}}
                {{--@foreach ($showroom->media as $media)--}}
                    {{--@if(!empty($media))--}}
                    {{--<img src="{{ $media->where('id', 5)->first()->getPublicPath() }}" alt="">--}}
                    {{--<p>{{ $media->description }}</p>--}}
                    {{--@endif--}}
                {{--@endforeach--}}
            {{--@endif--}}

        {{--@endforeach--}}



    {{--<div class="showroom-thumbnail-container">--}}
        {{--<ul class="showroom-thumbnail-images-list">--}}
            {{--@foreach($showrooms as $showroom)--}}
            {{--<li class="showroom-thumbnail-images-list-item">--}}
                {{--<a href="#show_{{ $showroom->id }}" class="showroom-thumbnail-images-link">--}}
                    {{--<img class="showroom-thumbnail-img" src="--}}
                        {{--@if($showroom->media->isNotEmpty())--}}
                            {{--{{ $showroom->media()->first()->getPublicPath() }}--}}
                        {{--@else--}}
                            {{--<div style="height: 200px; width: 500px; background: #0c5460;"></div>--}}
                        {{--@endif--}}
                    {{--">--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
    {{--</div>--}}


    {{--<div class="showroom-media-view-container">--}}
        {{--<ul class="showroom-media-view-list">--}}
            {{--@foreach($showrooms as $showroomMedia)--}}
            {{--<li class="showroom-media-view-list-item" id="show_{{ $showroomMedia->id }}">--}}
                {{--@if($showroomMedia->media->isNotEmpty())--}}
                    {{--@foreach($showroomMedia->media as $media)--}}
                        {{--<h1 class="showroom-media-img-title">{{$media->title}}</h1>--}}
                        {{--<p class="showroom-media-img-desc">{{$media->description}}</p>--}}
                        {{--<img class="showroom-media-img" src="{{$media->getPublicPath()}}">--}}
                    {{--@endforeach--}}
                {{--@endif--}}
            {{--</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
    {{--</div>--}}


    {{--<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">--}}
                {{--<div class="carousel-inner">--}}
                    {{--<div class="carousel-item active">--}}
                        {{--@foreach($showrooms as $showroomMedia)--}}
                        {{--@if($showroomMedia->media->isNotEmpty())--}}
                            {{--@foreach($showroomMedia->media as $media)--}}
                        {{--<img class="d-block w-100" src="{{$media->getPublicPath()}}" alt="...">--}}
                        {{--<div class="carousel-caption d-none d-md-block">--}}
                            {{--<h5>{{$media->title}}</h5>--}}
                            {{--<p>{{$media->description}}</p>--}}
                        {{--</div>--}}
                            {{--@endforeach--}}
                        {{--@endif--}}
                        {{--@endforeach--}}
                        {{--<h1 class="showroom-media-img-title">{{$media->title}}</h1>--}}
                        {{--<p class="showroom-media-img-desc">{{$media->description}}</p>--}}
                        {{--<img class="showroom-media-img" src="{{$media->getPublicPath()}}">--}}
                    {{--</div>--}}
                {{--</div>--}}

        {{--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">--}}
            {{--<span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
            {{--<span class="sr-only">Previous</span>--}}
        {{--</a>--}}
        {{--<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">--}}
            {{--<span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
            {{--<span class="sr-only">Next</span>--}}
        {{--</a>--}}
    {{--</div>--}}





    {{--@foreach($showrooms as $showroomMedia)--}}
    {{--<div class="carousel-item">--}}
        {{--@if($showroomMedia->media->isNotEmpty())--}}
            {{--@foreach($showroomMedia->media as $media)--}}
                {{--<img src="{{$media->getPublicPath()}}" alt="...">--}}
                {{--<div class="carousel-caption d-none d-md-block">--}}
                    {{--<h5>{{$media->title}}</h5>--}}
                    {{--<p>{{$media->description}}</p>--}}
                {{--</div>--}}
                {{--<h1 class="showroom-media-img-title">{{$media->title}}</h1>--}}
                {{--<p class="showroom-media-img-desc">{{$media->description}}</p>--}}
                {{--<img class="showroom-media-img" src="{{$media->getPublicPath()}}">--}}
            {{--@endforeach--}}
        {{--@endif--}}

    {{--</div>--}}
    {{--@endforeach--}}
    {{--<div class="showroom-media-view-container">--}}
        {{--@foreach($showrooms as $showroomMedia)--}}
        {{--<div class="showroom-media-image-container" id="show_{{ $showroomMedia->id }}">--}}
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