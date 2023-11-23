<!DOCTYPE html>
<html>
    <head>
        <!-- Title -->
        <title>AssignVehicles</title>

        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Component Styles -->
        <link rel="stylesheet" href="{{ asset('css/component/account-nav.css') }}">     <!--nav-->
        <link rel="stylesheet" href="{{ asset('css/component/alert.css') }}">           <!--alert-->
        <link rel="stylesheet" href="{{ asset('css/component/multi-component.css') }}"> <!--assign-vehicles-container-->
        <link rel="stylesheet" href="{{ asset('css/component/list-show.css') }}">       <!--assign-vehicles-list-(assign/edit/history)-->
        <link rel="stylesheet" href="{{ asset('css/component/footer.css') }}">          <!--'footer'-->

        <!-- WebPage Styles -->
        <link rel="stylesheet" href="{{ asset('css/page.css') }}">

        @livewireStyles
    </head>

    <body>
        @livewire('nav')
        @livewire('alert')
        <div class="title">Správa dispečinku</div>
        <div class="component-container">
            <div class="component-item-large">
                <div class="component">@livewire('assign-vehicles-container')</div>
            </div>
        </div>
        @livewire('footer')
        @livewire('timeout')
        @livewireScripts
    </body>
</html>