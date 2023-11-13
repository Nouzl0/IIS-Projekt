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
        <h1>ReportVehicleIssue</h1>
        <div class="add_component">
            <form action="" >
                <label for="vehicle">Poškodené vozidlo</label>
                <input type="text" name="vehicle"> <br>
                <label for="issue">Závada</label>
                <input type="text" name="issue"> <br>
                <input type="submit" value="Nahlásiť" class="button_add"> 
            </form>
        </div>
        

        @livewireScripts
    </body>
</html>