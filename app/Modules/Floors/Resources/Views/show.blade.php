@extends('layouts.app')
@section('content')

    {{--{{dd(App::getLocale())}}--}}

THIS IS FLOOR : {{$current_floor->floor_num}} , {{ $current_floor->title}}


@endsection
