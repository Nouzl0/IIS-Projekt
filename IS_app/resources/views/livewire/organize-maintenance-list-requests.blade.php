<div>
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">ŠPZ</th>
                <th class="list-up-box">Názov údržby</th>
                <th class="list-up-box">Popis</th>
                <th class="list-up-box"></th>   <!-- Buttons -->
            </tr>
        </thead>
        <tbody class="list_low_body">
            @forelse ($maintenances as $maintenance)
                <tr class="list-low-row">
                    <td class="list-low-box"> {{ $maintenance['spz'] }} </td>
                    <td class="list-low-box"> {{ $maintenance['maintenanceName'] }} </td>
                    <td class="list-low-box">
                        <textarea class="list-low-textarea-long" readonly>{{ $maintenance['maintenanceDescription'] }}</textarea>
                    </td> 
                    <td class="list-low-box-buttons">
                        <button wire:click="maintenanceImport('{{ $maintenance['maintenanceId'] }}')" class="list-low-button">Pridať údržbu</button>
                        <button wire:click="maintenanceDelete('{{ $maintenance['maintenanceId'] }}')" class="list-low-button">Vymazať</button>
                    </td>
                </tr>
            @empty
            <tr class="list-low-row">   <!-- No Vehicle -->
                <td class="list-low-box">V databáze nie je nahlásená žiadna závada</td>
                <td class="list-low-box"></td>
                <td class="list-low-box"></td>
                <td class="list-low-box"></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
