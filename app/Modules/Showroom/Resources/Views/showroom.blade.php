@extends('layouts.app')
@section('content')

    <h1 class="page-title">{{ trans('showroom::front.module_name') }}</h1>


    <div class="row justify-content-center">
        @foreach($showrooms as $showroom)

            @if(!empty($showroom->media->isNotEmpty()))
                <img src="{{ $showroom->media()->first()->getPublicPath() }}" alt="">
                <h3>{{ $showroom->media()->first()->title }}</h3>
                <p>{{ $showroom->media()->first()->description }}</p>
                {{--<div style="background-image: url('{{ $showroom->media()->first()->getPublicPath() }}')"></div>--}}
            @else
                <div style="height: 200px; width: 500px; background: #0c5460;"></div>
            @endif


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

        @endforeach
    </div>
    {{--TAKE IMAGE FROM MODULE--}}
@endsection