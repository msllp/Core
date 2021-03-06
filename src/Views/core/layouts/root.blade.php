<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js text-gray-900 antialiased leading-tight">
<!--<![endif]-->
<!--<link rel="dns-prefetch" href="{{env('APP_URL')}}"/>-->
<head>
	<meta charset="utf-8"/>
	<title>O3 ERP : Ozone for Business : made business on your Finger tips </title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width,height=device-height,initial-scale=1, shrink-to-fit=no,maximum-scale=1.0, user-scalable=0" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="Million Solutions LLP" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ secure_asset("b/css/app.css") }}?{{\MS\Core\Helper\Comman::random(10)}}" />
	<link rel="stylesheet" href="{{ secure_asset("b/css/fontawesome.css") }}?{{\MS\Core\Helper\Comman::random(10)}}" />
<!--
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
-->
    <meta name="theme-color" content="#db5945">
    @include('MS::core.B.s.svg.v1')
    <link rel="icon" href="{{secure_asset('images/ico/favicon.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{secure_asset('images/ico/favicon.ico')}}" type="image/x-icon" />
    <link rel="icon" href="{{secure_asset('images/ico/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{secure_asset('images/ico/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{secure_asset('images/ico/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{secure_asset('images/ico/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/ico/site.webmanifest')}}">
    <meta http-equiv="Refresh" content="7200">

</head>
<body >


<div id="msapp" class="min-vh-100 min-h-screen" :class="{
'ms-dark-mode-body':getDarkModeStatus()
}"  >
@yield('body')

    <div class="ms-loading " >
        <div class="ms-loading-animation" >
            <div class="ms-loader" style="z-index: 8"></div>
            <div class="ms-loader-1" style="z-index: 7"></div>
            <div class="ms-loader-2" style="z-index: 6"></div>
            <div class="ms-loader-3" style="z-index: 5"></div>
            <div class="ms-loader-4" style="z-index: 4"></div>
            <div class="ms-loader-5" style="z-index: 3"></div>
            <div class="ms-loader-6" style="z-index: 2"></div>
            <div class="ms-loader-7" style="z-index: 1"></div>
        </div>
        <div   class="ms-loading-text" >
            <div>
                Loading
            </div>

        </div>

    </div>


</div>

  <script src="{{ asset("b/js/app.js") }}?{{\MS\Core\Helper\Comman::random(10)}}" type="text/javascript" defer></script>

</body>
</html>
