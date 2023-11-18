<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">Meno zastávky</th>
                <th class="list-up-box">Adresa zastávky</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="list-low-body"> <!-- Table Body -->
            @forelse ($stops as $stop)
                @if ($editButton && $editValue === $stop['id_zastavka'])
                    <tr class="list-low-row">
                        <td class=list-low-box>
                            <input type="text" name="id_vozidlo" value="{{ $stop['meno_zastavky'] }}"
                                wire:model="stop_name" class="input_edit_form" readonly>
                        </td>
                        <td class=list-low-box>
                            <input type="text" name="stop_address" value="{{ $stop['adresa_zastavky'] }}" wire:model="stop_address"
                                class="input_edit_form">
                        </td>

                        <td class=list-low-box>
                            <button wire:click="toggleEdit({{ $stop['id_zastavka'] }})"
                                class="list-button-edit">Upraviť</button>
                            <button wire:click="deleteStop({{ $stop['id_zastavka'] }})"
                                class="list-button-delete">Vymazať</button>
                        </td>

                    </tr>
                @else
                    <tr class="list-low-row"> <!-- Show User -->
                        <td class="list-low-box">{{ $stop['meno_zastavky'] }}</td> <!-- Text [meno_zastavky] -->
                        <td class="list-low-box">{{ $stop['adresa_zastavky'] }}</td> <!-- Text [adresa_zastavky] -->
                        <td class=list-low-box>
                            <button wire:click="toggleEdit({{ $stop['id_zastavka'] }})"
                                class="list-button-edit">Upraviť</button>
                            <button wire:click="deleteStop({{ $stop['id_zastavka'] }})"
                                class="list-button-delete">Vymazať</button>
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
