@extends('layouts.app')
@section('content')

    <h1 class="text-center page-title">{{Settings::getLocale('blog_page_title', false)}}</h1>

    <div class="container-fluid">
        <div class="card-deck flex-column flex-xl-row flex-wrap">

            @foreach($blog as $post)
{{--{{dd($post->thumbnail_media()->first())}}--}}
                <div class="card">
                    @if(!empty($post->thumbnail_media()->first()))
                        <img class="card-img" src="{{$post->thumbnail_media()->first()->getPublicPath()}}" alt="Card image cap">
                    @else
                        <img class="card-img" src="{{asset('images/fallback/placeholder.png')}}" alt="Card image cap">
                    @endif

                        {{--<h5 class="card-title">{{ $post->title }}</h5>--}}
                        {{--<p class="card-text">{!! $post->description !!}</p>--}}
                        {{--<button><a href="read_{{$post->id}}">{{trans('blog::front.thumb_read')}}</a></button>--}}

                </div>
            @endforeach

        </div>
    </div>

@endsection