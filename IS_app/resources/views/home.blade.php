<!DOCTYPE html>
<html>
    <head>
        <!-- Title -->
        <title>HomePage</title>

        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Component Styles -->
        <link rel="stylesheet" href="{{ asset('css/component/account-nav.css') }}">     <!--'nav'-->
        <link rel="stylesheet" href="{{ asset('css/component/alert.css') }}">           <!--'alert'-->
        <link rel="stylesheet" href="{{ asset('css/component/list-add.css') }}">        <!--'home-add-search'-->
        <link rel="stylesheet" href="{{ asset('css/component/list-show.css') }}">       <!--'home-list-timetables'-->
        <link rel="stylesheet" href="{{ asset('css/component/footer.css') }}">          <!--'footer'-->
        
        <!-- WebPage Styles -->
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">

        @livewireStyles
    </head>

    <body>
        @livewire('nav')
        @livewire('alert')

        <div class="title">
            <div class="title-text">Mestská doprava</div>
            <img class="title-img" src="{{ asset('images/tram-prague.jpg') }}" alt="login icon">
            <div class="home-add-search">
                @livewire('home-add-search')
            </div>
        </div>

        <div class="home-list-timetables">
            @livewire('home-list-timetables')
        </div>

        @livewire('footer')
        @livewire('timeout')
        @livewireScripts
    </body>
</html>
