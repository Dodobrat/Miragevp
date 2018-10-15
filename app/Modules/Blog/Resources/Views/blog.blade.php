@extends('layouts.app')
@section('content')

    <h1 class="text-center page-title">{{Settings::getLocale('blog_page_title', false)}}</h1>

    {{--{{dd($blog_categories->first())}}--}}

@endsection