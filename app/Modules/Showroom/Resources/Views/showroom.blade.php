@extends('layouts.app')
@section('content')

    <h1>SHOWROOM</h1>

    @foreach($showrooms as $showroom)

        {{--<img src="{{$showroom->media->where('id', 4)->first()->getPublicPath()}}" alt="">--}}
        {{--<img src="{{ $showroom->media()->whereTranslation('title', 'image one')->first()->getPublicPath() }}" alt="">--}}
        <img src="{{ $showroom->media()->first()->getPublicPath() }}" alt="">
    @foreach ($showroom->media as $media)
    <img src="{{ $media->getPublicPath() }}" alt="">
        <p>{{ $media->description }}</p>
    @endforeach
    @endforeach
    {{--TAKE IMAGE FROM MODULE--}}
@endsection