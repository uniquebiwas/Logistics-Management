<!DOCTYPE html>
<html lang="en">

<head>
    @csrf
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title',env('APP_NAME'))</title>
    <link rel="icon" type="" href="img/icon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/AdminLTELogo.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/date.min.css') }}">
    <script src="{{ asset('/assets/front/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        input[name="startDate"]:before,
        input[name="endDate"]:before,
        input[type=datetime-local]:before,
        input[type=date]:before {
            content: attr(data-date);
        }

        input::-webkit-calendar-picker-indicator {
            right: 0px;
            color: black;
            opacity: 1;
        }

        input[name="startDate"]::-webkit-datetime-edit,
        input[name="startDate"]::-webkit-inner-spin-button,
        input[name="startDate"]::-webkit-clear-button,
        input[name="endDate"]::-webkit-datetime-edit,
        input[name="endDate"]::-webkit-inner-spin-button,
        input[name="endDate"]::-webkit-clear-button,
        input[type=datetime-local]::-webkit-datetime-edit,
        input[type=datetime-local]::-webkit-inner-spin-button,
        input[type=datetime-local]::-webkit-clear-button {
            opacity: 0;
        }

        input[type=date]::-webkit-datetime-edit,
        input[type=date]::-webkit-inner-spin-button,
        input[type=date]::-webkit-clear-button {
            opacity: 0;
        }

        .customer-navbar .main-header {
            margin-left: 0 !important;
        }

        .customer-navbar .main-header ul {
            margin-left: 10px;
        }

    </style>
    @stack('styles')
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
