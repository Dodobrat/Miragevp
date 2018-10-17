@extends('layouts.app')
@section('content')

    <h1 class="text-center page-title">{{Settings::getLocale('blog_page_title', false)}}</h1>

<div class="container-fluid">
    <div class="row">
        @foreach($blog as $post)
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="post">
                    <a class="post-link" href="#">
                        @if(!empty($post->thumbnail_media()->first()))
                            <img class="post-img" src="{{$post->thumbnail_media()->first()->getPublicPath()}}">
                        @else
                            <img class="post-img" src="{{asset('images/fallback/placeholder.png')}}">
                        @endif
                        <h5 class="post-title">{{ $post->title }}</h5>
                        <p class="post-author">{{trans('front.by')}} <span>{{ $post->author }}</span></p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection