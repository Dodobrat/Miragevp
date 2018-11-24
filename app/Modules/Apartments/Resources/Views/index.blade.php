@extends('layouts.app')
@section('content')

    <section class="apartment-view">
        <div class="row">

            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 apartment-information">
                <h1 class="apartment-title">{{ trans('apartments::front.apartment') }} <span>{{$selected_apartment->title}}</span></h1>
                <div class="apartment-title-border"></div>
                <div class="apartment-description">
                    {!! $selected_apartment->description !!}
                </div>
                <h3 class="apartment-price">€ <span class="price">{{ $selected_apartment->price }}</span></h3>
                <div class="apartment-plan-container">

                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                        <ol class="carousel-indicators">
                            @foreach( $selected_apartment->apartment_plans_media as $plan )
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>

                        <div class="carousel-inner" role="listbox">
                            @foreach( $selected_apartment->apartment_plans_media as $plan )
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img class="d-block img-fluid" src="{{ $plan->getPublicPath() }}" alt="{{ $plan->slug }}">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
                <div class="apartment-similar">
                    @foreach($similar as $other)
                        <li>
                            <a href="{{ route('apartment', ['slug' => $other->slug]) }}">{{ $other->title }}</a>
                        </li>
                    @endforeach
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 apartment-media">

                <div class="apartment-image-container">
                    @if(!empty($selected_apartment->media->first()))
                        <img class="apartment-image" src="{{$selected_apartment->media->first()->getPublicPath()}}" alt="{{$selected_apartment->slug}}">
                    @else
                        <img class="apartment-image" src="{{asset('images/fallback/placeholder.png')}}" alt="{{$selected_apartment->slug}}">
                    @endif
                </div>


            </div>

        </div>
    </section>




@endsection