<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doprava Brno</title>
    <link rel="stylesheet" href="/css/home.css">
</head>
<body>
    <h2> Login</h2>
    <div style="border: 3px solid black;">
        <form class="login" action="/login" method="POST">
            @csrf
            <label for="email"> email</label>
            <input name="email" type="text" placeholder="email">
            <label for="password"> password</label>
            <input name="password" type="password" placeholder="password">
            <button class="button_login">Login</button>
        </form> 
    </div>

    <div class="searchbar">
        <h2 class="banner"> Mestská doprava Brno </h2>
        <form class="searching_from" action="/search" method="POST">
            @csrf
            <label><b>Zastávka</b></label>
            <input name="zastavka" type="text" placeholder="zastávka">
            <label><b>Dátum</b></label>
            <input name="datum" id="datum" type="date" aria-describedby="date-format" min="2021-03-01" max="2031-01-01" placeholder="dátum">
            <br><label><b>Čas</b></label>
            <input name="cas" type="text" placeholder="čas"> <br>
            <button class="button_search">Hľadať</button>
        </form>
    </div>

    <div id="poriadky">
        <h3>Cestovné poriadky</h3>
        <p>1. Řečkovice - Hlavní nádraží - Ečerová <br></p>
        <p>2. Stará osada - Celní - Modřice <br></p>
        <p>3. Tomkovo námestí - Námestí Míru <br></p>
    </div>


</body>
</html>