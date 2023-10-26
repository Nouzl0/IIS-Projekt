<!DOCTYPE html>
<html>
    <head>
        <!-- Title -->
        <title>HomePage</title>

        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Component Styles -->
        <link rel="stylesheet" href="{{ asset('css/component/search-menu.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/login-nav.css') }}">   

        <!-- WebPage Styles -->
        <!--
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">  
        -->

        @livewireStyles
    </head>

    <body>

        @livewire('login-nav')
        <h1>Mestská doprava Brno</h1>
        @livewire('search-menu')

        <div id="poriadky">
            <h3>Cestovné poriadky</h3>
            <p>1. Řečkovice - Hlavní nádraží - Ečerová <br></p>
            <p>2. Stará osada - Celní - Modřice <br></p>
            <p>3. Tomkovo námestí - Námestí Míru <br></p>
        </div>


        @livewireScripts
    </body>
</html>
