<!DOCTYPE html>
<html>
    <head>
        <!-- Title -->
        <title>ManageVehicles</title>

        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Component Styles -->  
        <link rel="stylesheet" href="{{ asset('css/component/account-nav.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/add_vehicle.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/list-of-vehicles.css') }}">

        <!-- WebPage Styles -->
        <!-- replace with css link -->

        @livewireStyles
    </head>

    <body>
        @livewire('nav')
        {{-- spz názov druh značka stav --}}
        <h1>Správa vozidiel</h1>
        @livewire('add-vehicles')
        
        
        @livewire('list-of-vehicles')




        @livewireScripts
    </body>
</html> 