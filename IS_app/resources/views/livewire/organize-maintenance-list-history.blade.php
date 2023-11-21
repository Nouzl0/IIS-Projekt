<div>
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">ŠPZ</th>
                <th class="list-up-box">Názov údržby</th>
                <th class="list-up-box">Termín údržny</th>
                <th class="list-up-box">Dokončenie údržby</th>
                <th class="list-up-box">Technik (údržby)</th>
                <th class="list-up-box"></th>
            </tr>
        </thead>
        <tbody class="list_low_body">
            @forelse ($maintenances as $maintenance)
                @if ($showButton && ($showValue == $maintenance['maintenanceId']))
                    <tr class="list-low-row">
                        <td class="list-low-box"> {{ $maintenance['spz'] }} </td>
                        <td class="list-low-box"> {{ $maintenance['maintenanceName'] }} </td>
                        <td class="list-low-box"> {{ $maintenance['maintenanceDateTime'] }} </td>
                        <td class="list-low-box"> {{ $maintenance['maintenanceFinishDateTime'] }} </td>
                        <td class="list-low-box"> {{ $maintenance['maintenanceTechnician'] }} </td>

                        <td class="list-low-box-buttons"> <!-- Button [Minimalizovať] -->
                            <button wire:click="maintenanceShow('{{ $maintenance['maintenanceId'] }}')" class="list-low-button">Minimalizovať</button>
                        </td>
                    </tr>
                    <tr class="list-low-row">
                        <td class="list-low-box" colspan="7"> <!-- Use colspan to span across all columns in the table -->
                            <textarea class="list-low-textarea" readonly>{{ $maintenance['maintenanceDescription'] }}</textarea> <br>
                        </td> 
                    </tr>
                @else
                    <tr class="list-low-row">
                        <td class="list-low-box"> {{ $maintenance['spz'] }} </td>
                        <td class="list-low-box"> {{ $maintenance['maintenanceName'] }} </td>
                        <td class="list-low-box"> {{ $maintenance['maintenanceDateTime'] }} </td>
                        <td class="list-low-box"> {{ $maintenance['maintenanceFinishDateTime'] }} </td>
                        <td class="list-low-box"> {{ $maintenance['maintenanceTechnician'] }} </td>

                        <td class="list-low-box-buttons"> <!-- Button [Edit] & Button [Delete] & [Show] -->
                            <button wire:click="maintenanceShow('{{ $maintenance['maintenanceId'] }}')" class="list-low-button">Zobraziť</button>
                            <button wire:click="maintenanceDelete('{{ $maintenance['maintenanceId'] }}')" class="list-low-button">Vymazať</button>
                        </td>
                    </tr>
                @endif
            @empty
            <tr class="list-low-row">   <!-- No Vehicle -->
                <td class="list-low-box">V databáze nie je žiadna údržba</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
