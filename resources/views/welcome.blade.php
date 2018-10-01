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

        {{--<div class="land-img" style="height: 2000px;"></div>--}}

        {{--<div class="landing-img"--}}
            {{--@if(!empty(Settings::getFile('index_landing_image')))--}}
            {{--style="background-image: url('{{ Settings::getFile('index_landing_image') }}')"--}}
            {{--@else--}}
            {{--style="background-image: url('{{ asset('images/google-logo.png') }}')"--}}
                {{--@endif ></div>--}}


<section class="landing-image-container">


    <div class="landing-image parallax-img"
         @if(!empty(Settings::getFile('index_landing_image')))
         style="background-image: url('{{ Settings::getFile('index_landing_image') }}');"
         @else
         style="background-image: url('{{ asset('images/fallback/placeholder.png') }}');"
            @endif >
        <div class="container">
            <h3 class="motto">
                @if(!empty(Administration::getStaticBlock('motto')))
                    {!! Administration::getStaticBlock('motto') !!}
                    @else
                    {{ trans('front.static-block-motto') }}
                @endif
            </h3>
        </div>
    </div>
    {{--@if(!empty(Settings::getFile('index_landing_image')))--}}
    {{--<div class="landing-image" style="background-image: url('{{ Settings::getFile('index_landing_image') }}')--}}

    {{--@else--}}
        {{--style="background-image: url('{{ asset('images/google-logo.png') }}')--}}
    {{--@endif--}}
</section>
    <section class="location-container">

        <div class="row">
            <div class="col-lg-5">
                <div class="container-fluid">
                    <h1 class="loc-title">{{trans('front.loc-title')}}</h1>
                    <div class="map" style="width: 100%; height: 50vh; background-color: #2c3e50;"></div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="container-fluid">
                    <div class="pic" style="width: 100%; height: 50vh; background-color: #2c3e50;"></div>
                    <div class="row">
                        <div class="col">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium adipisci amet aspernatur beatae commodi cumque cupiditate distinctio error eum ex expedita, inventore iusto laboriosam libero maxime modi quia quod quos rerum sed similique sint tempore temporibus tenetur voluptas voluptatem. Accusamus amet animi commodi</div>
                        <div class="col">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad at aut consectetur consequatur, debitis distinctio doloremque expedita harum, magni mollitia non rem sint sunt veniam voluptatem voluptatibus? Aperiam assumenda atque blanditiis deserunt expedita iste laboriosam magni mollitia necessitatibus nesciunt pariatur praesen</div>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <section class="view-container">
        <h1 class="text-center">{{trans('front.extra-view')}}</h1>
    </section>

    <section class="showroom-preview-container">
        <h1 class="text-center">{{trans('front.showroom')}}</h1>
    </section>




    @endsection