<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<link rel="dns-prefetch" href="{{env('APP_URL')}}"/>
<head>
	<meta charset="utf-8"/>
	<title>MS Frame</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width,height=device-height,initial-scale=1, shrink-to-fit=no,maximum-scale=1.0, user-scalable=0" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="Million Solutions LLP" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ asset("b/css/app.css") }}?{{\MS\Core\Helper\Comman::random(10)}}" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <meta name="theme-color" content="#db5945">


    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/ico/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/ico/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/ico/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/ico//site.webmanifest')}}">

</head>
<body class="min-vh-100"  >


<div id="msapp"  >
@yield('body')
    <transition name="slide"  mode="out-in">
    <mscalc v-if="msCalc"></mscalc>
    </transition>
</div>
    <script src="{{ asset("b/js/app.js") }}?{{\MS\Core\Helper\Comman::random(10)}}" type="text/javascript" defer></script>

</body>
</html>
