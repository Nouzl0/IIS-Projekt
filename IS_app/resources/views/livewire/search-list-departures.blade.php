<div>
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">Linka</th>
                <th class="list-up-box">Smer trasy</th>
                <th class="list-up-box">Odchod</th>
                <th class="list-up-box">Dátum</th>
                <th class="list-up-box"></th>
            </tr>
        </thead>
        <tbody class="list-low-body"> <!-- Table Body -->
            @forelse ($departures as $departure)
                @if($showButton && ($showValueTime === $departure['time']) && ($showValueDate === $departure['date']) && ($showValueRoute === $departure['route']))
                    <tr class="list-low-row">   <!-- Show Departure -->
                        <td class="list-low-box">{{ $departure['line'] }}</td> <!-- Text [line] -->
                        <td class="list-low-box">{{ $departure['route'] }}</td> <!-- Text [route] -->
                        <td class="list-low-box">{{ $departure['time'] }}</td>  <!-- Text [time] -->
                        <td class="list-low-box">{{ $departure['date'] }}</td> <!-- Text [date] -->
                        <td class="list-low-box"> <!-- Button [Zobraziť] -->
                            <button wire:click="departureShow('{{ json_encode($departure) }}')" class="list-low-button">Zobraziť</button>
                        </td>
                    </tr>
                    @forelse ($routes as $route)
                    <tr class="list-sub-low-row"> 
                        <td class="list-sub-low-box"></td> 
                        <td class="list-sub-low-box">{{ $route['stop'] }}</td> <!-- Text [stop/stand] -->
                        <td class="list-sub-low-box">{{ $route['time'] }}</td>  <!-- Text [departure-time] -->
                        <td class="list-sub-low-box"></td>
                        <td class="list-sub-low-box"></td>
                    </tr>
                        @if ($route['stop'] === session('selectedBusStop'))
                            <tr class="list-sub-low-row"> 
                                <td class="list-sub-low-box-bold"></td> 
                                <td class="list-sub-low-box-bold">• {{ $route['stop'] }}</td> <!-- Text [stop/stand] -->
                                <td class="list-sub-low-box-bold">{{ $route['time'] }}</td>  <!-- Text [departure-time] -->
                                <td class="list-sub-low-box-bold"></td>
                                <td class="list-sub-low-box-bold"></td>
                            </tr>
                        @endif
                    @empty
                        <tr class="list-sub-low-row">
                            <td class="list-sub-low-box">Žiadne zastávky neboli nájdené</td>
                        </tr>
                    @endforelse
                @else
                    <tr class="list-low-row">   <!-- Show Departure -->
                        <td class="list-low-box">{{ $departure['line'] }}</td> <!-- Text [line] -->
                        <td class="list-low-box">{{ $departure['route'] }}</td> <!-- Text [route] -->
                        <td class="list-low-box">{{ $departure['time'] }}</td>  <!-- Text [time] -->
                        <td class="list-low-box">{{ $departure['date'] }}</td> <!-- Text [date] -->
                        <td class="list-low-box"> <!-- Button [Zobraziť] -->
                            <button wire:click="departureShow('{{ json_encode($departure) }}')" class="list-low-button">Zobraziť</button>
                        </td>
                    </tr>
                @endif
            @empty
                <tr class="list-low-row">   <!-- No User -->
                    <td class="list-low-box">Žiadne odchody neboli nájdené</td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
