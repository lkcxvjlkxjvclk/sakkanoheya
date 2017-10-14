<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>作家のヘヤ</title>

        {{-- Fonts --}}
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,600|Raleway:600,300|Josefin+Slab:400,700,600italic,600,400italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/slick.css">
        <link rel="stylesheet" type="text/css" href="/css/slick-team-slider.css"/>
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="{{URL::asset('js/jquery-ui.min.css')}}">

        {{--GOOGLE MATERIAL ICON--}}
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <style>
            html,body {
                height : 100%;
                margin : 0
            }
        </style>

    </head>
    <body class="height-max-set">
      @include('partials.header2')
      <script type="text/javascript" src="/js/jquery-3.2.0.js"></script>
      <script type="text/javascript" src="/js/jquery.easing.min.js" type="text/javascript"></script>
      <script type="text/javascript" src="/js/jquery.mixitup.js" type="text/javascript"></script>
      <script type="text/javascript" src="/js/bootstrap.js"></script>
      <script type="text/javascript" src="/js/slick.js"></script>
      <script type="text/javascript" src="/js/custom.js"></script>
      <script type="text/javascript" src="/js/d3.v3.js"></script>
      <!-- <script type="text/javascript" src="/js/d3.layout.js"></script> -->
      <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
      @yield('content')
      @include('partials.footer')

    </body>
</html>
