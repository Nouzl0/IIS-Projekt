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
    <link rel="stylesheet" href="{{ asset('css/component/account-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/component/list-show.css') }}">
    <link rel="stylesheet" href="{{ asset('css/component/list-add.css') }}">

    <!-- WebPage Styles -->
    <!-- replace with css link -->

    @livewireStyles
</head>

<body>
    @livewire('nav')
    @livewire('alert')
    <h1>ManageLinksConnections</h1>
    {{-- <h2>Pridať zastávku</h2>
    @livewire('manage-links-add-stop')
    @livewire('manage-links-list-of-stops') --}}
    <h2>Pridať trasu</h2>
    @livewire('manage-links-add-routes') 
    @livewire('manage-links-list-routes')

    {{-- <h2>Vytvoriť linku</h2>
    @livewire('manage-links-add-line')
    <h3>Aktuálne linky</h3>
    @livewire('manage-links-lines-list') --}}

    @livewire('timeout')
    @livewireScripts
</body>

</html>
