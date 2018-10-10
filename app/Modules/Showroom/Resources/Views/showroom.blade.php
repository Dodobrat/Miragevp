@extends('layouts.app')
@section('content')

    <h1 class="text-center mb-3 mt-3 page-title">{{ trans('showroom::front.module_name') }}</h1>

<div class="container-fluid">
    <div class="card-deck flex-column flex-lg-row flex-wrap">

        @foreach($showrooms as $showroom)

            <div class="card">
                @if(!empty($showroom->media->first()))
                    <img class="card-img" src="{{$showroom->media->first()->getPublicPath()}}" alt="Card image cap">
                    @else
                    <img class="card-img" src="{{asset('images/fallback/placeholder.png')}}" alt="Card image cap">
                    @endif
                <div class="card-img-overlay">
                    <h5 class="card-title">{{ $showroom->title }}</h5>
                    <p class="card-text">{!! $showroom->description !!}</p>
                    <button type="button" data-toggle="modal" data-target=".show_{{$showroom->id}}">{{trans('showroom::front.thumb_show')}}</button>
                </div>
            </div>


            <div class="modal fade bd-example-modal-lg show_{{$showroom->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div id="carousel_{{$showroom->id}}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($showroom->media as $media)
                                    <div class="carousel-item @if($loop->first) active @endif">
                                        <img class="d-block w-100" src="{{ $media->getPublicPath() }}" alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>{{ $media->title }}</h5>
                                            <p>{!! $media->description !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carousel_{{$showroom->id}}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel_{{$showroom->id}}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    </div>
</div>

@endsection