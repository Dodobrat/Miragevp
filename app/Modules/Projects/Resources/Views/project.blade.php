@extends('layouts.app')
@section('content')

{{--{{dd($agent->isDesktop() && $agent->is('Chrome'))}}--}}
    @foreach($projects as $project)
        @if($project->visible == true)
            {{--{{dd($project->floors->apartments)}}--}}
            <div class="project-parallax-img-container">
                @if($agent->isDesktop() && $agent->is('Chrome'))
                    <div class="project-parallax-img-layer-one"
                        @if(!empty($project->layer_one_media()->first()) && $project->show_media == true)
                             style="background-image: url('{{$project->layer_one_media->first()->getPublicPath()}}');"
                        @else
                             style="background-image: url('{{ asset('images/visual-selection/Asset 3.png') }}');"
                        @endif
                    >@endif<!--endif Desktop-->
                        @if($agent->isDesktop() && $agent->is('Chrome'))
                    <div class="project-parallax-img-layer-two"
                        @if(!empty($project->layer_two_media()->first()) && $project->show_media == true)
                             style="background-image: url('{{$project->layer_two_media->first()->getPublicPath()}}');"
                        @else
                             style="background-image: url('{{ asset('images/visual-selection/Asset 7.png') }}');"
                        @endif
                    >@endif<!--endif Desktop-->
                        @if($agent->isDesktop() && $agent->is('Chrome'))
                    <div class="project-layer-three"
                        @if(!empty($project->layer_three_media()->first()) && $project->show_media == true)
                            style="background-image: url('{{$project->layer_three_media->first()->getPublicPath()}}');"
                        @else
                            style="background-image: url('{{ asset('images/visual-selection/final-bg-no-tree.png') }}');"
                        @endif
                    >
                    @endif<!--endif Desktop-->
                        @if($agent->isMobile() || $agent->is('Firefox'))
                    <div class="project-static-bg"
                        @if(!empty($project->layer_one_media()->first()) && $project->show_media == true)
                            style="background-image: url('{{$project->layer_one_media->first()->getPublicPath()}}');"
                        @else
                            style="background-image: url('{{ asset('images/visual-selection/Asset 3.png') }}');"
                        @endif
                    >
                @endif<!--endif Mobile / Firefox-->
                        @if($agent->is('Firefox'))
                            <div class="project-layer-three"
                                 @if(!empty($project->layer_three_media()->first()) && $project->show_media == true)
                                 style="background-image: url('{{$project->layer_three_media->first()->getPublicPath()}}');"
                                 @else
                                 style="background-image: url('{{ asset('images/visual-selection/final-bg-no-tree.png') }}');"
                                    @endif
                            >
                            @endif<!--endif Firefox-->




            <div class="text-center project-overview">
                <h1 id="project-title"><em>{{$project->title}}</em></h1>
                <div class="container overview-box">
                    <div class="row project-instructions">
                        <div class="d-none d-xl-block col-xl-4 vis-select pt-2 pl-5">
                            <i></i>
                            <h1>{{trans('projects::front.vis-selection')}}</h1>
                        </div>
                        <div class="d-xl-none col-lg-12 col-md-12 col-sm-12 col-xs-12 vis-select text-center">
                            <i class="mob-i"></i>
                            <h1 class="mob-p">{{trans('projects::front.vis-selection')}}</h1>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12 how-to text-center">
                            <p>{{trans('projects::front.scroll-down')}}</p>
                            <div class="arrow-1"></div>
                            <p>{{trans('projects::front.choose-floor')}}</p>
                            <div class="arrow-1"></div>
                            <p>{{trans('projects::front.view-floor-plans')}}</p>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12 project-info pt-4">
                            <h1><span>{{$project->floors->count()}}</span><br>{{trans('projects::front.floors')}}</h1>
                            <p class="mob-ap"><em><span>{{$apartments->where('type','apartment')->count()}}</span> {{trans('projects::front.apartments')}}</em></p>
                            <p><em><span>{{$apartments->where('type','office')->count()}}</span> {{trans('projects::front.office-spaces')}}</em></p>
                        </div>
                    </div>
                </div>

            </div>


            <div class="accordion" id="floor-select">
                @foreach($project->floors as $floor)

                    <div class="card floor-card">

                        <div class="row floor-row">

                            <div class="container-fluid" id="building">
                                <button class="col card-header collapsed" id="heading_{{$floor->id}}" type="button" data-toggle="collapse" data-target="#collapse_{{$floor->id}}" aria-expanded="false" aria-controls="collapse_{{$floor->id}}">
                                    @if(!empty($floor->thumbnail_media->first()) && $floor->show_media == true)
                                        <img src="{{$floor->thumbnail_media->first()->getPublicPath()}}" alt="">
                                    @else
                                        <img src="{{asset('images/fallback/placeholder.png')}}" alt="">
                                    @endif
                                    @if($agent->isDesktop())
                                    <p class="floor-number">
                                        {{ $floor->floor_num }}
                                    </p>
                                    <p class="floor-ap-stats">
                                        {{$floor->apartments->count()}}/{{ $apartments->where('floor_id', $floor->id)->count() }}
                                        <br><span>
                                            {{trans('projects::front.available-aps')}}
                                            {{--@if(!empty($floor->apartments->first()))--}}
                                                {{--{{trans('projects::front.from')}} : € {{$floor->apartments->first()->price}}--}}
                                            {{--@endif--}}
                                        </span>
                                    </p>
                                    @elseif($agent->isMobile())
                                        <p class="floor-mobile-num">
                                            {{ $floor->floor_num }}
                                        </p>
                                    @endif<!--endif Desktop & Mobile-->
                                </button>
                            </div>

                        </div>


                        <div id="collapse_{{$floor->id}}" class="collapse floor-coll" aria-labelledby="heading_{{$floor->id}}" data-parent="#floor-select">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 floor-acc-info">
                                        <h1 class="accordion-floor-title">{{trans('projects::front.floor')}} {{$floor->floor_num}}</h1>
                                        <div class="accordion-floor-border"></div>
                                        <div class="accordion-floor-description">{!! $floor->description !!}</div>
                                        <br>
                                        <p class="floor-details">
                                            @if(!empty($floor->apartments->first()))
                                                {{trans('projects::front.from')}}
                                                <span>
                                                    € {{$floor->apartments->first()->price}}
                                                </span>
                                            @endif
                                        </p>
                                        <p class="floor-details-2">
                                            {{trans('projects::front.available-aps')}} :
                                            <span>
                                                {{$floor->apartments->count()}}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-xs-12 plan-image-container">
                                        <a class="" href="{{ route('floor', ['slug' => $floor->slug]) }}">

                                            @if(!empty($floor->plan_media->first()) && $floor->show_media == true)
                                                @if($agent->isDesktop())
                                                    <img class="accordion-plan-img" src="{{$floor->plan_media->first()->getPublicPath()}}" alt="">
                                                @elseif($agent->isMobile())
                                                    <img class="accordion-plan-img clickable" src="{{$floor->plan_media->first()->getPublicPath()}}" alt="">
                                                @endif
                                            @else
                                                <img class="accordion-plan-img" src="{{asset('images/fallback/placeholder.png')}}" alt="">
                                            @endif

                                        </a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div><!-- FLOOR -->
                @endforeach<!--endforeach Floor-->
            </div><!-- ACCORDION -->
                @if($agent->isDesktop() && $agent->is('Chrome'))
                </div><!-- PARALLAX IMG LAYER 3 -->
                </div><!-- PARALLAX IMG LAYER 2 -->
                </div><!-- PARALLAX IMG LAYER 1 -->
                @elseif($agent->is('Firefox'))
                </div>
                @elseif($agent->isMobile())
                </div><!-- STATIC IMG BG -->
                @endif<!--endif Desktop / Firefox / Mobile-->

                <div class="visual-footer">
                    @if(!empty($project->base_media->first()) && $project->show_media == true)
                        <img src="{{$project->base_media->first()->getPublicPath()}}" alt="">
                    @else
                        <img src="{{ asset('images/visual-selection/base.png') }}" alt="">
                    @endif
                    <div class="visual-sales">
                        <div class="row enquiries">
                            <div class="col">{{ trans('projects::front.ideal-place') }}</div>
                            <div class="enquiries-border"></div>
                        </div>
                        <div class="container-fluid">


                        @if(isset($contacts_cache) == true)
                            @if( !empty($contacts_cache->first()->phone) || !empty($contacts_cache->first()->address) || !empty($contacts_cache->first()->email) )
                                <div class="row query-info">
                                    @if(!empty($contacts_cache->first()->address))
                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-xs-12 q-i">
                                            {{ $contacts_cache->first()->address }}
                                        </div>
                                    @endif
                                    @if(!empty($contacts_cache->first()->email))
                                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-xs-12 q-i">
                                            {{ $contacts_cache->first()->email }}
                                        </div>
                                    @endif
                                    @if(!empty($contacts_cache->first()->phone))
                                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-xs-12 q-i">
                                            {{ $contacts_cache->first()->phone }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endif<!--endif CONTACTS CACHE-->
                        </div>
                    </div>

                </div>

            </div><!-- PARALLAX IMG CONTAINER -->
        @endif
    @endforeach <!--foreach PROJECT-->


@endsection