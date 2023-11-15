<div>
    {{-- The Master doesn't talk, he acts. --}}
    <table>
        <thead>
            <tr>
                <th>ŠPZ</th>
                <th>Čas</th>
                <th>Dátum</th>
                <th>Stav</th>
                <th>Popis</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($maintenance as $udrzba)
                @if ($isEdit && $editValue === $udrzba['id_udrzba'])
                    <tr class="list-low-row">
                        <td>
                            <select name="spz" class="list-low-box" wire:model="spz">
                                <option value=""></option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->spz }}"> {{ $vehicle->spz }} </option>
                                @endforeach
                            </select>
                        </td>
                        <td class=list-low-box> 
                            <input type="text" name="zaciatok_udrzby" value={{ $udrzba['zaciatok_udrzby'] }} wire:model="datum" class="input_edit_form">
                        </td>
                        <td class=list-low-box> 
                            <input type="text" name="stav" value={{ $udrzba['stav'] }} wire:model="stav" class="input_edit_form">
                        </td>
                        <td class=list-low-box> 
                            <input type="text" name="popis" value={{ $udrzba['popis'] }} wire:model="popis" class="input_edit_form">
                        </td>
                        <td class=list-low-box>
                            <button wire:click="toggleEdit({{ $udrzba['id_udrzba'] }})" 
                                class="list-button-edit">Upraviť</button>
                            <button wire:click="deleteMaintenance({{ $udrzba['id_udrzba'] }})"
                                class="list-button-delete">Vymazať</button>
                        </td>
                    </tr>
                @else
                    <tr class="list-low-row">
                        <td class="list-low-box"> {{ $udrzba['spz'] }} </td>
                        <td class="list-low-box"> {{ $udrzba['zaciatok_udrzby'] }} </td>
                        <td class="list-low-box"> {{ $udrzba['stav'] }} </td>
                        <td class="list-low-box"> {{ $udrzba['popis'] }} </td>
                        <td class="list-low-box">
                            <button wire:click="toggleEdit({{ $udrzba['id_udrzba'] }})"
                                class="list-button-edit">Upraviť</button>
                            <button wire:click="deleteMaintenance({{ $udrzba['id_udrzba'] }})"
                                class="list-button-delete">Vymazať</button>
                        </td>
                    </tr>
                @endif
            @endforeach

        </tbody>
    </table>
    @if (session()->has('message'))
        <div id="successMessage" class="alert alert-success">
            <p>{{ session('message') }}</p>
        </div>
    @endif
</div>
@livewireScripts
