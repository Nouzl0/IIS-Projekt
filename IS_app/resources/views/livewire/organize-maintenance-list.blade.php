<div>
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">ID</th>
                <th class="list-up-box">ŠPZ</th>
                <th class="list-up-box">Názov údržby</th>
                <th class="list-up-box">Dátum</th>
                <th class="list-up-box">Čas</th>
                <th class="list-up-box">Technik</th>
                <th class="list-up-box"></th>
            </tr>
        </thead>
        <tbody class="list_low_body">
            @forelse ($maintenances as $maintenance)
                @if ($editButton && ($editValue === $maintenance['maintenanceId']))
                    <tr class="list-low-row"> <!-- Edit User -->
                        <td class="list-low-box"> {{ $maintenance['maintenanceId'] }} </td>     <!-- Input [ID] -->
                        <td class=list-low-box> <!-- Input [spz] -->
                            <input wire:model="spz" type="text" name="spz" value="{{ $vehicle['spz'] }}" class="list-low-input" required>
                        </td>
                        <td class=list-low-box> <!-- Input [maintenanceName] -->
                            <input wire:model="maintenanceName"  type="text" name="maintenanceName" value={{ $maintenance['maintenanceName'] }} class="list-low-input" required>
                        </td>
                        <td class=list-low-box> <!-- Input [maintenanceDate] -->
                            <input wire:model="maintenanceDate"  type="date" name="maintenanceDate" value={{ $maintenance['maintenanceDate'] }} class="list-low-input" required>
                        </td>
                        <td class=list-low-box>  <!-- Input [maintenanceTime] -->
                            <input wire:model="maintenanceTime" type="time" name="maintenanceTime" value={{ $maintenance['mainenanceTime'] }} class="list-low-input" required>
                        </td>
                        <td class=list-low-box>  <!-- Input [maintenanceTime] -->
                            <input wire:model="maintenanceTechnician" type="text" name="maintenanceTechnician" value={{ $maintenance['mainenanceTechnician'] }} class="list-low-input" required>
                        </td>                        
                        <td class="list-low-box"> <!-- Button [Save] -->
                            <button wire:click="maintenanceSave('{{ $maintenance['maintenanceId'] }}')" class="list-low-button">Uložiť</button>
                        </td>
                    </tr>
                @else
                    <tr class="list-low-row">
                        <td class="list-low-box"> {{ $maintenance['maintenanceId'] }} </td>
                        <td class="list-low-box"> {{ $maintenance['spz'] }} </td>
                        <td class="list-low-box"> {{ $maintenance['maintenanceName'] }} </td>
                        <td class="list-low-box"> {{ $maintenance['maintenanceDate'] }} </td>
                        <td class="list-low-box"> {{ $maintenance['maintenanceTime'] }} </td>
                        <td class="list-low-box"> {{ $maintenance['maintenanceTechnician'] }} </td>

                        <td class="list-low-box-buttons"> <!-- Button [Edit] & Button [Delete] -->
                            <button wire:click="maintenanceEdit('{{ $maintenance['maintenanceId'] }}')" class="list-low-button">Upraviť</button>
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
