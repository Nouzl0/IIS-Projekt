<div>
    <!-- Table --><!-- TODO!!! -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">ŠPZ</th>
                <th class="list-up-box">Názov správy</th>
                <th class="list-up-box">Stav</th>
                <th class="list-up-box"></th>
                <th class="list-up-box"></th>
            </tr>
        </thead>
        <tbody class="list-low-body"> <!-- Table Body -->
            @forelse ($assigned_maintenances as $assigned_maintenance)
                @if($show_description === true)
                    <tr class="list-low-row">   <!-- Show User -->
                        <td class="list-low-box">{{ $assigned_maintenance['spz'] }}</td> <!-- Text [spz] -->
                        <td class="list-low-box">{{ $assigned_maintenance['nazov_spravy'] }}</td> <!-- Text [nazov_spravy] -->
                        <td class="list-low-box">{{ $assigned_maintenance['stav'] }}</td>  <!-- Text [stav] -->
                        <td class="list-low-box"> <!-- Button [Edit] & Button [Delete] -->
                            <button wire:click="hideDescription()" class="list-low-button">Zobraziť popis</button>
                        </td>
                        <td class="list-low-box">
                            <button wire:click="updateMaintenance('{{ $assigned_maintenance['id_udrzba'] }}')" class="list-low-button">Údržba bola vykonaná</button>
                        </td>
                    </tr>
                    <tr class="list-low-row">
                            <td class="list-low-box" colspan="7"> <!-- Use colspan to span across all columns in the table -->
                                <textarea class="list-low-textarea" readonly>{{ $assigned_maintenance['popis'] }}</textarea> <br>
                            </td> 
                    </tr>
                @else
                    <tr class="list-low-row">   <!-- Show User -->
                        <td class="list-low-box">{{ $assigned_maintenance['spz'] }}</td> <!-- Text [spz] -->
                        <td class="list-low-box">{{ $assigned_maintenance['nazov_spravy'] }}</td> <!-- Text [nazov_spravy] -->
                        <td class="list-low-box">{{ $assigned_maintenance['stav'] }}</td>  <!-- Text [stav] -->
                        <td class="list-low-box"> <!-- Button [Edit] & Button [Delete] -->
                            <button wire:click="showDescription()" class="list-low-button">Zobraziť popis</button>
                        </td>
                        <td class="list-low-box">
                            <button wire:click="updateMaintenance('{{ $assigned_maintenance['id_udrzba'] }}')" class="list-low-button">Údržba bola vykonaná</button>
                        </td>
                    </tr>
                @endif
            @empty
                <tr class="list-low-row">   <!-- No User -->
                    <td class="list-low-box">Nemáte priradené žiadne údržby</td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
