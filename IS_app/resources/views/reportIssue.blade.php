<!DOCTYPE html>
<html>
    <head>
        <!-- Title -->
        <title>ReportVehicleIssue</title>

        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Component Styles -->
        <link rel="stylesheet" href="{{ asset('css/component/account-nav.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/add_vehicle.css') }}">
        


        <!-- WebPage Styles -->
        <!-- replace with css link -->

        @livewireStyles
    </head>

    <body>
        @livewire('nav')
        <h1>Nahlásiť závadu vozidla</h1>
        @livewire('report-vehicle-issue')

        @livewireScripts
    </body>
</html>