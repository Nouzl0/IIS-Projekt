<!DOCTYPE html>
<html>
    <head>
        <!-- Title -->
        <title>LoginPage</title>

        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">        

        <!-- Component Styles -->
        <link rel="stylesheet" href="{{ asset('css/component/alert.css') }}">       <!--alert -->
        <link rel="stylesheet" href="{{ asset('css/component/add-form.css') }}">    <!--login -->

        <!-- WebPage Styles -->
        <style>
            body { background-color: #f5f5f5; }
            .login { align-items: center; }
        </style>

        @livewireStyles
    </head>


    <body>
        @livewire('alert') 

        <div class="login">
            @livewire('login')
        </div>
        
        @livewireScripts
    </body>
</html>