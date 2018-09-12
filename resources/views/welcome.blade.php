@extends('layouts.app')
@section('content')


        {{--{!! Administration::getStaticBlock('key-test') !!}--}}
        {{--TAKING STATIC BLOCK (SAME AS WRITTEN)--}}

        {{--<img src="{{ \ProVision\Administration\Facades\Settings::getFile('index_landing_image') }}" alt="">--}}
        {{--TAKING IMAGE FROM SETTINGS--}}

        {{--<div>--}}
            {{--<ul>--}}
                {{--@foreach($users as $user)--}}
                    {{--<li>{{ $user->getFullName() }}</li>--}}
                {{--@endforeach--}}
            {{--</ul>--}}
        {{--</div>--}}
        {{--TAKING NAMES FROM USERS AND PUTTING THEM INTO LIST--}}


        {{--@foreach($apartments as $apartment)--}}
        {{--@foreach ($apartment->media as $media)--}}
        {{--<img src="{{ $media->getPublicPath() }}" alt="">--}}
        {{--@endforeach--}}
        {{--@endforeach--}}
        {{--TAKE IMAGE FROM MODULE--}}

        <div class="land-img" style="height: 2000px;"></div>
    <div class="container">


    </div>

    @endsection