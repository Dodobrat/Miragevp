@extends('layouts.app')
@section('content')


    <div class="blog-banner" style="background: url('{{ asset('images/fallback/banner.png') }}')">

        <div class="row">
            <div class="col-10">
                <h1 class="text-center blog-banner-title">{{Settings::getLocale('blog_page_title', false)}}</h1>
            </div>
        </div>

    </div>

    <div class="container py-5 px-4 mt-3 text-center">
        {!! Settings::getLocale('blog_page_description', false) !!}
    </div>

<div class="container-fluid blog-container">
    <div class="row align-items-center">
        @foreach($blog as $post)
            @if($post->visible == true)
                @if($post->id % 2 == 0)
                    <div class="col-lg-7 col-md-12 col-12 my-md-5 px-md-5">
                        <div class="row upper-row">
                            <div class="col-2 align-self-end">
                                <p class="post-date">
                                    @if(empty($post->date_made))
                                        {{$post->created_at->format('m.d')}}
                                    @else
                                        {{$post->date_made->format('m.d')}}
                                    @endif
                                </p>
                            </div>
                            <div class="col-10">
                                <h2 class="post-title text-right">
                                    @if(strlen($post->title) >= 100)
                                        {{substr($post->title,0,100)." ..."}}
                                    @else
                                        {{$post->title}}
                                    @endif
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <p class="post-year">
                                    @if(empty($post->date_made))
                                        {{$post->created_at->format('Y')}}
                                    @else
                                        {{$post->date_made->format('Y')}}
                                    @endif
                                </p>
                            </div>
                            <div class="col-10">
                                <p class="post-author text-right">
                                    {{$post->author}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-12 my-5">
                        <button class="post-link" type="button" data-toggle="modal" data-target=".read_{{ $post->id }}">
                            @if(!empty($post->thumbnail_media->first()) && $post->show_media == true)
                                <img class="post-img" src="{{$post->thumbnail_media->first()->getPublicPath()}}">
                            @else
                                <img class="post-img" src="{{asset('images/fallback/placeholder.png')}}">
                            @endif
                        </button>
                    </div>

                @else
                    <div class="col-lg-7 col-md-12 col-12 my-md-5 px-md-5 d-block d-lg-none">
                        <div class="row upper-row">
                            <div class="col-10">
                                <h2 class="post-title">
                                    @if(strlen($post->title) >= 100)
                                        {{substr($post->title,0,100)." ..."}}
                                    @else
                                        {{$post->title}}
                                    @endif
                                </h2>
                            </div>
                            <div class="col-2 align-self-end">
                                <p class="post-date">
                                    @if(empty($post->date_made))
                                        {{$post->created_at->format('m.d')}}
                                    @else
                                        {{$post->date_made->format('m.d')}}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <p class="post-author">
                                    {{$post->author}}
                                </p>
                            </div>
                            <div class="col-2">
                                <p class="post-year">
                                    @if(empty($post->date_made))
                                        {{$post->created_at->format('Y')}}
                                    @else
                                        {{$post->date_made->format('Y')}}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-12 my-5">
                        <button class="post-link" type="button" data-toggle="modal" data-target=".read_{{ $post->id }}">
                            @if(!empty($post->thumbnail_media->first()) && $post->show_media == true)
                                <img class="post-img" src="{{$post->thumbnail_media->first()->getPublicPath()}}">
                            @else
                                <img class="post-img" src="{{asset('images/fallback/placeholder.png')}}">
                            @endif
                        </button>
                    </div>
                    <div class="col-lg-7 col-md-12 col-12 my-5 px-md-5 d-none d-lg-block">
                        <div class="row upper-row">
                            <div class="col-10">
                                <h2 class="post-title">
                                    @if(strlen($post->title) >= 100)
                                        {{substr($post->title,0,100)." ..."}}
                                    @else
                                        {{$post->title}}
                                    @endif
                                </h2>
                            </div>
                            <div class="col-2 align-self-end">
                                <p class="post-date">
                                    @if(empty($post->date_made))
                                        {{$post->created_at->format('m.d')}}
                                    @else
                                        {{$post->date_made->format('m.d')}}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <p class="post-author">
                                    {{$post->author}}
                                </p>
                            </div>
                            <div class="col-2">
                                <p class="post-year">
                                    @if(empty($post->date_made))
                                        {{$post->created_at->format('Y')}}
                                    @else
                                        {{$post->date_made->format('Y')}}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                @endif
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
                                    @if(!empty($post->header_media->first()) && $post->show_media == true)
                                        <img class="post-head-img" src="{{$post->header_media->first()->getPublicPath()}}">
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