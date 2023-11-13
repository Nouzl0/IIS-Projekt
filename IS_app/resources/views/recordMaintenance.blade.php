<!DOCTYPE html>
<html>
    <head>
        <!-- Title -->
        <title>RecordVehicleMaintanence</title>

        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Component Styles -->  
        <link rel="stylesheet" href="{{ asset('css/component/account-nav.css') }}">
        <link rel="stylesheet" href="{{ asset('css/component/add_vehicle.css') }}">
        <link rel="stylesheet" href="{{ asset('css/recordMaintenance.css') }}">


        <!-- WebPage Styles -->
        <!-- replace with css link -->

        @livewireStyles
    </head>

    <body>
        @livewire('nav')
        <h1>Záznam o údržbe</h1>

        <div class="maintanence_record">

            <form action="">
                <label for="maintenancing_vehicle">SPŽ vozidla</label>
                <input type="text" name="maintenancing_vehicle"> <br>
                <label for="time_of_start_maintenance">Čas začiatku</label>
                <input type="dateime-local" name="time_of_start_maintenance"><br>
                <label for="date_of_start_maintenance">Dátum údržby</label>
                <input type="date" name="date_of_start_maintenance"><br>
                <input type="submit" value="Vytvoriť" class="button_add">
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ŠPZ</th>
                    <th>Čas</th>
                    <th>Dátum</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>4A23000</td>
                    <td>14:00</td>
                    <td>12.11.2023</td>
                    <td id="td_button"> <button wire:click="editVehicles" class="button_edit" >Upraviť</button> </td>
                </tr>
            </tbody>
        </table>


        @livewireScripts
    </body>
</html>