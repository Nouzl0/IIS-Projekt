<!DOCTYPE html>
<html>

<head>
    <!-- Title -->
    <title>ManageLinksConnections</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Component Styles -->
    <link rel="stylesheet" href="{{ asset('css/component/account-nav.css') }}">     <!--nav-->
    <link rel="stylesheet" href="{{ asset('css/component/alert.css') }}">           <!--alert-->
    <link rel="stylesheet" href="{{ asset('css/component/multi-component.css') }}"> <!--manage-links-container-->
    <link rel="stylesheet" href="{{ asset('css/component/list-show.css') }}">       <!--list-->
    <link rel="stylesheet" href="{{ asset('css/component/list-add.css') }}">        <!--add-->

    <!-- WebPage Styles -->
    <!-- replace with css link -->

    @livewireStyles
</head>

<body>
    @livewire('nav')
    @livewire('alert')

    @livewire('manage-links-container')

    @livewire('timeout')
    @livewireScripts
</body>

</html>
