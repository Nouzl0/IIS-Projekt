<div>
    <h2>Aktuálne vozidlá</h2>

    <table class="list-table">
        <thead class="list-up-body">
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
                @if ($isEdit && $editValue === $vehicle['id_vozidlo'])
                    <tr class="list-low-row">
                        <td class=list-low-box>
                            <input type="text" name="id_vozidlo" value="{{ $vehicle['id_vozidlo'] }}" wire:model="id_vozidlo" class="input_edit_form" readonly>
                        </td>
                        <td class=list-low-box>
                            <input type="text" name="spz" value="{{ $vehicle['spz'] }}" wire:model="spz" class="input_edit_form">
                        </td>
                        <td class=list-low-box> 
                            <input type="text" name="nazov" value={{ $vehicle['nazov'] }} wire:model="nazov" class="input_edit_form">
                        </td>
                        <td class=list-low-box> 
                            <input type="text" name="druh_vozidla" value={{ $vehicle['druh_vozidla'] }} wire:model="druh_vozidla" class="input_edit_form">
                        </td>
                        <td class=list-low-box> 
                            <input type="text" name="znacka_vozidla" value={{ isset($vehicle['znacka_vozidla']) }} wire:model="znacka_vozidla" class="input_edit_form">
                        </td>
                        <td class=list-low-box>
                            <button wire:click="toggleEdit({{ $vehicle['id_vozidlo'] }})" 
                                class="list-button-edit">Upraviť</button>
                            <button wire:click="deleteVehicle({{ $vehicle['id_vozidlo'] }})"
                                class="list-button-delete">Vymazať</button>
                        </td>

                    </tr>
                @else
                    <tr class="list-low-row">
                        <td class=list-low-box> {{ $vehicle['id_vozidlo'] }} </td>
                        <td class=list-low-box> {{ $vehicle['spz'] }} </td>
                        <td class=list-low-box> {{ $vehicle['nazov'] }} </td>
                        <td class=list-low-box> {{ $vehicle['druh_vozidla'] }} </td>
                        <td class=list-low-box> {{ $vehicle['znacka_vozidla'] }} </td>
                        <td class=list-low-box>
                            <button wire:click="toggleEdit({{ $vehicle['id_vozidlo'] }})" 
                                class="list-button-edit">Upraviť</button>
                            <button wire:click="deleteVehicle({{ $vehicle['id_vozidlo'] }})"
                                class="list-button-delete">Vymazať</button>
                        </td>
                    </tr>
                @endif
            @empty
            @endforelse
 
        </tbody>
    </table>
    @if (session()->has('message'))
            <div id="successMessage" class="alert alert-success">
                <p>{{ session('message') }}</p>
            </div>
    @endif
</div>
@livewireScripts
