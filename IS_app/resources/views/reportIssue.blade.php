<!DOCTYPE html>
<html>  <!-- (Driver) - Creates a report of a vehicle issue -->
    <head>
        <!-- Title -->
        <title>ReportVehicleIssue</title>

        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Component Styles -->
        <link rel="stylesheet" href="{{ asset('css/component/account-nav.css') }}">    <!--nav-->
        <link rel="stylesheet" href="{{ asset('css/component/alert.css') }}">          <!--alert-->
        <link rel="stylesheet" href="{{ asset('css/component/list-add.css') }}">       <!--report-issue-add-->
        


        <!-- WebPage Styles -->
        <!-- replace with css link -->

        @livewireStyles
    </head>

    <body>
        @livewire('nav')
        @livewire('alert')
        <h1>Nahlásiť závadu vozidla</h1>
        @livewire('report-issue-add')

        @livewireScripts
    </body>
</html>