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

        <!-- WebPage Styles -->
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">

        @livewireStyles
    </head>


    <body>
        <div class="login-container">
            <h2>Login</h2>
            <form>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>
        </div>

        @livewireScripts
    </body>
</html>