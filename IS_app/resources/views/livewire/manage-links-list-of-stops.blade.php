<div>
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">Meno zastávky</th>
                <th class="list-up-box">Adresa zastávky</th>
                <th class="list-up-box"></th>
            </tr>
        </thead>
        <tbody class="list-low-body"> <!-- Table Body -->
            @forelse ($stops as $stop)
                @if ($editButton && $editValue === $stop['meno_zastavky'])
                    <tr class="list-low-row">
                        <td class=list-low-box>
                            <input wire:model="stop_name" class="list-low-input" type="text" name="stop_name" required>
                        </td>
                        <td class=list-low-box>
                            <input wire:model="stop_address" class="list-low-input" type="text" name="stop_address" required>
                        </td>
                        <td class=list-low-box-buttons>
                            <button wire:click="stopSave('{{ $stop['meno_zastavky'] }}')" class="list-low-button">Uložiť</button>
                        </td>
                    </tr>
                @else
                    <tr class="list-low-row">
                        <td class="list-low-box">{{ $stop['meno_zastavky'] }}</td> <!-- Text [meno_zastavky] -->
                        <td class="list-low-box">{{ $stop['adresa_zastavky'] }}</td> <!-- Text [adresa_zastavky] -->
                        <td class=list-low-box-buttons>
                            <button wire:click="stopEdit('{{ $stop['meno_zastavky'] }}')" class="list-low-button">Upraviť</button>
                            <button wire:click="stopDelete('{{ $stop['meno_zastavky'] }}')" class="list-low-button" class="list-low-button">Vymazať</button>
                        </td>
                    </tr>
                @endif
            @empty
                <tr class="list-low-row"> <!-- No User -->
                    <td class="list-low-box">Neexistuju žiadne zastávky</td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
