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
        <link rel="stylesheet" href="{{ asset('css/component/login-nav.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/account-nav.css') }}"> 

        <!-- WebPage Styles --> 
        <link rel="stylesheet" href="{{ asset('css/search.css') }}">

        @livewireStyles
    </head>
    <body>

        @livewire('nav')

        <h1>Bus Search Results</h1>

        <!-- Search Input Form -->
        <form action="search.php" method="post">
            <input type="text" name="search" placeholder="Search for a bus station...">
            <button type="submit">Search</button>
        </form>

        <!-- Results Table -->
        <table>
            <thead>
                <tr>
                    <th>Starting Bus Station</th>
                    <th>Route Number</th>
                    <th>Arrival Time</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Bus Station 1</td>
                    <td>Route 123</td>
                    <td>08:00 AM</td>
                </tr>
                <tr>
                    <td>Bus Station 2</td>
                    <td>Route 456</td>
                    <td>08:30 AM</td>
                </tr>
                <!-- Add more rows as needed for search results -->
            </tbody>
        </table>

        @livewireScripts
    </body>
</html>