<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="globalData">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/logo_sm.svg')}}?v=1">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/logo_sm.svg')}}?v=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/logo_sm.svg')}}?v=1">
    <meta name="theme-color" content="#FFFFFF">

    <link href="{{asset('cp-assets/lib/ui-kit/ui-kit.css')}}" rel="stylesheet">
    <link href="{{asset('cp-assets/css/main.css')}}" rel="stylesheet">
    <script src="{{asset('cp-assets/lib/ui-kit/ui-kit.min.js')}}"></script>
    <script src="{{asset('cp-assets/js/main.js')}}"></script>

    <!-- Alpine JS -->
    <script src="{{ asset('vendor/axios/axios.min.js') }}" defer></script>
    <script src="{{ asset('vendor/alpine-3.10.2.min.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script>
        UIKit.network.setCsrfToken('_token', '{!! csrf_token() !!}');
        const axiosConfig =  { headers: {
                "Content-type": "application/json;charset=UTF-8",
                "X-Requested-With": "XMLHttpRequest",
                'X-CSRF-TOKEN' : '{!! csrf_token() !!}'
            }}
    </script>
</head>
<body>

@include('cp.common.header')

<div id="content">
    {!! $content !!}
</div>

<div class="pt-2"></div>
</body>
@include('cp.common.message-box')
@include('cp.common._alpine_init_script')
</html>
