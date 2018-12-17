<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MIRAGETOWER') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ mix('/assets/css/app.css') }}" rel="stylesheet">

</head>
<body>

    <div id="app"></div>

    <div id="help">
        @yield('content')
    </div>


<!-- Scripts -->
    <script src="{{ mix('assets/js/app.js') }}"></script>
</body>
</html>
