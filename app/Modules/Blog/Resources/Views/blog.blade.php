@extends('layouts.app')
@section('content')

    <h1 class="text-center page-title">{{Settings::getLocale('blog_page_title', false)}}</h1>

<div class="container-fluid blog-container">
    <div class="row">
        @foreach($blog as $post)
            @if($post->visible == true)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="post">
                        <button class="post-link" type="button" data-toggle="modal" data-target=".read_{{ $post->id }}">
                            @if(!empty($post->thumbnail_media()->first()) && $post->show_media == true)
                                <img class="post-img" src="{{$post->thumbnail_media()->first()->getPublicPath()}}">
                            @else
                                <img class="post-img" src="{{asset('images/fallback/placeholder.png')}}">
                            @endif
                            <p class="post-title">
                                <span>
                                    @if(strlen($post->title) >= 50)
                                        {{substr($post->title,0,50)." ..."}}
                                    @else
                                        {{$post->title}}
                                    @endif
                                </span>
                            </p>
                                <p class="post-author">{{trans('front.by')}} <span>{{$post->author}}</span></p>
                                <p class="post-date text-left">
                                    @if(empty($post->date_made))
                                        {{$post->created_at->format('Y-m-d')}}
                                    @else
                                        {{$post->date_made}}
                                    @endif
                                </p>
                        </button>
                    </div>
                </div>


                <div class="modal fade bd-example-modal-lg read_{{$post->id}} blog-modal-bg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg blog-modal">
                        <div class="modal-content post-content">
                            <button class="close-blog-modal">&times;</button>
                            <div class="container post-container">
                                <h1 class="modal-post-title">{{$post->title}}</h1>
                                <h5 class="modal-post-sub-title">{{$post->sub_title}}</h5>
                                <span class="modal-post-author">{{trans('front.by')}} <span>{{ $post->author }}</span></span>
                                <span class="modal-post-date">
                                    @if(empty($post->date_made))
                                        {{$post->created_at->format('Y-m-d')}}
                                    @else
                                        {{$post->date_made}}
                                    @endif
                                </span>
                                <hr>
                                @if(!empty($post->header_media()->first()) && $post->show_media == true)
                                    <img class="post-head-img" src="{{$post->header_media()->first()->getPublicPath()}}">
                                @else
                                    <img class="post-head-img" src="{{asset('images/fallback/placeholder.png')}}">
                                @endif
                                <p class="modal-post-text">
                                    {!! $post->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

{{$blog->links()}}

@include('layouts.footer')
@endsection