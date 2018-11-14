@extends('layouts.app')

@section('content')

    <div class="container-fluid my-5">
        <h1 class="text-center">
           {{ trans('index::front.hello') }}, {{ $current_user->first_name }} !
        </h1>
    </div>

    <div class="container-fluid">

        @foreach($user_apartments as $user_apartment)
            @if($user_apartment->type == 'apartment')
                <h1>your status on apartment
                    {{ $user_apartment->title }}
                </h1>
            @elseif($user_apartment->type == 'office')
                <h1>your status on office
                    {{ $user_apartment->title }}
                </h1>
            @endif
        @endforeach

    </div>


@endsection



