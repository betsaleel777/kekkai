<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{asset('semantic-theme/assets/semantic/semantic.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('semantic-theme/assets/semantic/components/reset.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('semantic-theme/assets/semantic/components/site.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('semantic-theme/assets/semantic/components/grid.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <!--- Component CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('semantic-theme/assets/semantic/components/menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('semantic-theme/assets/semantic/components/input.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('semantic-theme/assets/semantic/components/dropdown.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('semantic-theme/assets/semantic/components/icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('semantic-theme/assets/semantic/components/button.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('semantic-theme/assets/semantic/components/transition.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('semantic-theme/assets/semantic/components/popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/noty.min.css')}}">
    <portal-target name="semantic-ui-vue">
    @yield('link')

    <script src="{{asset('semantic-theme/assets/library/jquery.min.js')}}"></script>
    <style>
        body {
            padding: 1em;
        }

        .ui.menu {
            margin: 3em 0em;
        }

        .ui.menu:last-child {
            margin-bottom: 110px;
        }
    </style>
    @yield('style')
    <script src="{{asset('js/noty.min.js')}}"></script>
    @yield('general_script')
</head>
