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
        <link rel="stylesheet" href="{{ asset('css/component/footer.css') }}">          <!--'footer'-->

        <!-- WebPage Styles --> 
        <link rel="stylesheet" href="{{ asset('css/page.css') }}">

        @livewireStyles
    </head>
    <body>

        @livewire('nav')
        @livewire('alert')
        <div class="title">Prehľadávanie spojov</div>
        <div class="component-container">
            <div class="component-item">
                <label class="label">• Vyhľadať</label>
                <div class="component">@livewire('search-add-search')</div>
            </div>

            <div class="component-item-large">
                <label class="label">• Odchody - {{ session('selectedBusStop') }}</label>
                <div class="component">@livewire('search-list-departures')</div>
            </div>
        </div>
        @livewire('footer')
        @livewire('timeout')
        @livewireScripts
    </body>
</html>