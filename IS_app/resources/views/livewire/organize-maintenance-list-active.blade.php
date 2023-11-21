<div>
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">ŠPZ</th>
                <th class="list-up-box">Názov údržby</th>
                <th class="list-up-box">Dátum termínu</th>
                <th class="list-up-box">Čas termínu</th>
                <th class="list-up-box">Priradený technik</th>
                <th class="list-up-box"></th>
            </tr>
        </thead>
        <tbody class="list_low_body">
            @forelse ($maintenances as $maintenance)
                @if ($editButton && ($editValue == $maintenance['maintenanceId']))
                    <tr class="list-low-row"> <!-- Edit User -->
                        <td class=list-low-box> <!-- Input [spz] -->
                            <select class="add-select" wire:model="spz" id="spz" name="spz" required>
                                <option value=""></option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->spz }}">{{ $vehicle->spz }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class=list-low-box> <!-- Input [maintenanceName] -->
                            <input wire:model="maintenanceName"  type="text" name="maintenanceName" value={{ $maintenance['maintenanceName'] }} class="list-low-input" required>
                        </td>
                        <td class=list-low-box> <!-- Input [maintenanceDate] -->
                            <input wire:model="maintenanceDate"  type="date" name="maintenanceDate" value={{ $maintenance['maintenanceDate'] }} class="list-low-input" required>
                        </td>
                        <td class=list-low-box>  <!-- Input [maintenanceTime] -->
                            <input wire:model="maintenanceTime" type="time" name="maintenanceTime" value={{ $maintenance['maintenanceTime'] }} class="list-low-input" required>
                        </td>
                        <td class=list-low-box>  <!-- Input [maintenanceTime] -->
                            <select class="add-select" wire:model="maintenanceTechnician" id="maintenanceTechnician" name="maintenanceTechnician" required>
                                <option value=""></option>
                                @foreach ($technicians as $technician)
                                    <option value="{{ $technician->id_uzivatel }}">{{ $technician->meno_uzivatela }} {{ $technician->priezvisko_uzivatela }} - ({{ $technician->email_uzivatela }})</option>
                                @endforeach
                            </select>  
                        </td>                        
                        <td class="list-low-box-buttons"> <!-- Button [Save] -->
                            <button wire:click="maintenanceSave('{{ $maintenance['maintenanceId'] }}')" class="list-low-button">Uložiť</button>
                        </td>
                    </tr>
                    <tr class="list-low-row">
                        <td class="list-low-box" colspan="7"> <!-- Use colspan to span across all columns in the table -->
                            <textarea wire:click="maintenanceDescription" type="text" name="maintenanceDescription" class="list-low-textarea" value={{ $maintenance['maintenanceDescription'] }} required>{{ $maintenance['maintenanceDescription'] }}</textarea> 
                            <br>
                        </td> 
                    </tr>
                @else
                    @if ($showButton && ($showValue == $maintenance['maintenanceId']))
                        <tr class="list-low-row">
                            <td class="list-low-box"> {{ $maintenance['spz'] }} </td>
                            <td class="list-low-box"> {{ $maintenance['maintenanceName'] }} </td>
                            <td class="list-low-box"> {{ $maintenance['maintenanceDate'] }} </td>
                            <td class="list-low-box"> {{ $maintenance['maintenanceTime'] }} </td>
                            <td class="list-low-box"> {{ $maintenance['maintenanceTechnician'] }} </td>

                            <td class="list-low-box-buttons"> <!-- Button [Edit] & Button [Delete] -->
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
                            <td class="list-low-box"> {{ $maintenance['maintenanceDate'] }} </td>
                            <td class="list-low-box"> {{ $maintenance['maintenanceTime'] }} </td>
                            <td class="list-low-box"> {{ $maintenance['maintenanceTechnician'] }} </td>

                            <td class="list-low-box-buttons"> <!-- Button [Edit] & Button [Delete] & [Show] -->
                                <button wire:click="maintenanceShow('{{ $maintenance['maintenanceId'] }}')" class="list-low-button">Zobraziť</button>
                                <button wire:click="maintenanceEdit('{{ $maintenance['maintenanceId'] }}')" class="list-low-button">Upraviť</button>
                                <button wire:click="maintenanceDelete('{{ $maintenance['maintenanceId'] }}')" class="list-low-button">Vymazať</button>
                            </td>
                        </tr>
                    @endif
                @endif
            @empty
            <tr class="list-low-row">   <!-- No Vehicle -->
                <td class="list-low-box">V databáze nie je žiadna údržba</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
