<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">Číslo linky</th>
                <th class="list-up-box">Typ vozidla (linka)</th>
                <th class="list-up-box"></th>
            </tr>
        </thead>
        <tbody class="list-low-body"> <!-- Table Body -->
            @forelse ($lines as $line)
                @if ($editButton && $editValue == $line['cislo_linky'])
                    <tr class="list-low-row"> <!-- Edit line -->
                        <td class="list-low-box">
                            <input wire:model="cislo_linky" type="text" name="cislo_linky" class="list-low-input" required>
                        </td>
                        <td class="list-low-box"> 
                            <select wire:model="vozidla_linky" class="add-select" id="vozidla_linky" name="vozidla_linky" required>
                                <option value="Autobus">Autobus</option>
                                <option value="Električka">Električka</option>
                                <option value="Trolejbus">Trolejbus</option>
                            </select>
                        </td>
                        <td class="list-low-box-buttons"> <!-- Button [Save] -->
                            <button wire:click="lineSave('{{ $line['cislo_linky'] }}')" class="list-low-button">Uložiť</button>
                        </td>
                    </tr>
                @else
                    <tr class="list-low-row"> <!-- Show line -->
                        <td class="list-low-box">{{ $line['cislo_linky'] }}</td> <!-- Text [cislo_linky] -->
                        <td class="list-low-box">{{ $line['vozidla_linky'] }}</td> <!-- Text [vozidla_linky] -->
                        <td class="list-low-box-buttons"> <!-- Button [Edit] & Button [Delete] -->
                            <button wire:click="lineEdit('{{ $line['cislo_linky'] }}')" class="list-low-button">Upraviť</button>
                            <button wire:click="lineDelete('{{ $line['cislo_linky'] }}')" class="list-low-button">Vymazať</button>
                        </td>
                    </tr>
                @endif
            @empty
                <tr class="list-low-row">
                    <td class="list-low-box">Neexistuju žiadne linky</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
