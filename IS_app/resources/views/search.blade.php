<!DOCTYPE html>
<html>
    <head>
        <!-- Title -->
        <title>SearchResults</title>

        <!-- Meta Tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Component Styles -->
        <link rel="stylesheet" href="{{ asset('css/component/account-nav.css') }}">     <!--'nav'-->
        <link rel="stylesheet" href="{{ asset('css/component/alert.css') }}">           <!--'alert'-->
        <link rel="stylesheet" href="{{ asset('css/component/list-add.css') }}">        <!--'search-add-search'-->
        <link rel="stylesheet" href="{{ asset('css/component/list-show.css') }}">       <!--'search-list-departures'-->

        <!-- WebPage Styles --> 
        <link rel="stylesheet" href="{{ asset('css/search.css') }}">

        @livewireStyles
    </head>
    <body>

        @livewire('nav')
        @livewire('alert')

        <h1>Vyhladať</h1>
        @livewire('search-add-search')


        <!-- TODO: Name of "Meno zástavky" should be dynamically changed based on the search input. -->
        <h1>Odchody - {{ session('selectedBusStop') }}</h1>
        @livewire('search-list-departures')

        @livewire('timeout')
        @livewireScripts
    </body>
</html>