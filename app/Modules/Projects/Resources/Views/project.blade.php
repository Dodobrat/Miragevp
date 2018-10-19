@extends('layouts.app')
@section('content')

@foreach($projects as $project)
    @if($project->visible == true)
        <section class="project-container">
            <div class="project-img"
                @if($project->show_media == true)
                     @if(!empty($project->media()->first()))
                     style="background-image: url('{{ $project->media()->first()->getPublicPath() }}');"
                     @else
                     style="background-image: url('{{ asset('images/fallback/placeholder.png') }}');"
                     @endif
                @endif>
            </div>
            @foreach($floors as $floor)
                <div class="floor-select"
                     @if($floor->show_media == true)
                     @if(!empty($floor->media()->first()))
                     style="background-image: url('{{ $floor->media()->first()->getPublicPath() }}');"
                     @else
                     style="background-image: url('{{ asset('images/fallback/placeholder.png') }}');"
                        @endif
                        @endif>

                </div>
            @endforeach
        </section>


    @endif
@endforeach

@endsection