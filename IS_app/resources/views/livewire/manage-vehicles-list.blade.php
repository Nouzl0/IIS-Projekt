<div>
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">ID</th>
                <th class="list-up-box">ŠPZ</th>
                <th class="list-up-box">Názov</th>
                <th class="list-up-box">Druh</th>
                <th class="list-up-box">Značka</th>
                <th class="list-up-box"></th>
            </tr>
        </thead>
        <tbody class="list_low_body">
            @forelse ($vehicles as $vehicle)
                @if ($editButton && ($editValue === $vehicle['spz']))
                    <tr class="list-low-row"> <!-- Edit User -->
                        <td class="list-low-box"> {{ $vehicle['vehicleId'] }} </td>     <!-- Input [vehicleId] -->
                        <td class=list-low-box> <!-- Input [spz] -->
                            <input wire:model="spz" type="text" name="spz" value="{{ $vehicle['spz'] }}" class="list-low-input" required>
                        </td>
                        <td class=list-low-box> <!-- Input [vehicleName] -->
                            <input wire:model="vehicleName"  type="text" name="vehicleName" value={{ $vehicle['vehicleName'] }} class="list-low-input" required>
                        </td>
                        <td class=list-low-box> <!-- Input [vehicleType] -->
                            <select wire:model='vehicleType' name="vehicleType" id="vehicleType" name="vehicleType" class="list-low-select" required>
                                <option value=""></option>
                                <option value="Autobus">Autobus</option>
                                <option value="Trolejbus">Trolejbus</option>
                                <option value="Električka">Električka</option>
                            </select>
                        </td>
                        <td class=list-low-box>  <!-- Input [vehicleBrand] -->
                            <input type="text" name="vehicleBrand" value={{ $vehicle['vehicleBrand'] }} wire:model="vehicleBrand" class="list-low-input" required>
                        </td>
                        <td class="list-low-box"> <!-- Button [Save] -->
                            <button wire:click="vehicleSave('{{ $vehicle['spz'] }}')" class="list-low-button">Uložiť</button>
                        </td>
                    </tr>
                @else
                    <tr class="list-low-row">
                        <td class="list-low-box"> {{ $vehicle['vehicleId'] }} </td>
                        <td class="list-low-box"> {{ $vehicle['spz'] }} </td>
                        <td class="list-low-box"> {{ $vehicle['vehicleName'] }} </td>
                        <td class="list-low-box"> {{ $vehicle['vehicleType'] }} </td>
                        <td class="list-low-box"> {{ $vehicle['vehicleBrand'] }} </td>

                        <td class="list-low-box-buttons"> <!-- Button [Edit] & Button [Delete] -->
                            <button wire:click="vehicleEdit('{{ $vehicle['spz'] }}')" class="list-low-button">Upraviť</button>
                            <button wire:click="vehicleDelete('{{ $vehicle['spz'] }}')" class="list-low-button">Vymazať</button>
                        </td>
                    </tr>
                @endif
            @empty
            <tr class="list-low-row">   <!-- No Vehicle -->
                <td class="list-low-box">V databáze nie je žiadne vozidlo</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
