@extends('layouts.app')
@section('content')


    <div class="row">
        <div class="col-xl-6 apartment-information">
            <h1 class="apartment-title">{{$selected_apartment->title}}</h1>
            <div class="apartment-description">
                {!! $selected_apartment->description !!}
            </div>
            <h3 class="apartment-price">{{$selected_apartment->price}}</h3>
            <div class="apartment-plan-container">


                <script>

                </script>
            </div>
        </div>
        <div class="col-xl-6 apartment-media">

        </div>
    </div>


@endsection