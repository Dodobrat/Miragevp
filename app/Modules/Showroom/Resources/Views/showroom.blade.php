@extends('layouts.app')
@section('content')

    <h1 class="page-title">{{ trans('showroom::front.module_name') }}</h1>
        {{--{{dd($showrooms->find(2))}}--}}

    <div class="row justify-content-center">
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
    </div>


    <div class="container-fluid">
        <ul class="nav nav-pills mb-3 nav-fill row justify-content-center" id="pills-tab" role="tablist">
            @foreach($showrooms as $showroom)

                <li class="nav-item col-4">
                    <a id="img-tab" data-toggle="pill" href="#tab_{{ $showroom->id }}" role="tab" aria-controls="tab" aria-selected="false">
                            <img class="show-link" src="

                    @if($showroom->media->isNotEmpty())
                            {{ $showroom->media()->first()->getPublicPath() }}
                            @else
                            {{--<div style="height: 200px; width: 500px; background: #0c5460;"></div>--}}
                            @endif
                                    " alt="">

                    </a>
                </li>



            @endforeach

        </ul>
        <div class="tab-content row justify-content-center" id="pills-tabContent">
            @foreach($showrooms as $showroomMedia)
                <div class="tab-pane fade" id="tab_{{ $showroomMedia->id }}" role="tabpanel" aria-labelledby="img-tab">

                @if($showroomMedia->media->isNotEmpty())
                    @foreach($showroomMedia->media as $media)
                            <h1>{{$media->title}}</h1>
                            <img class="show-link" src="{{$media->getPublicPath()}}">
                    @endforeach
                 @endif
                </div>
                @endforeach
        </div>
    </div>

@endsection