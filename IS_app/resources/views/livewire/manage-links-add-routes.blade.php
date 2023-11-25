<div>
    <form wire:submit.prevent="routeAdd" class="add-form"> 
        <div class="add-container">
            <div class="add-item">
                <label class="add-label" for="route_name">Názov trasy*</label>
                <input wire:model="meno_trasy" class="add-input" type="text" name="route_name" required>
            </div>
            <div class="add-item">
                <label class="add-label" for="linka">Linka*</label>
                <select wire:model="cislo_linky" name="linka" id="linka" class="add-select" required>
                    <option value=""></option>
                    @foreach ($lines as $line)
                        <option value="{{ $line->cislo_linky }}"> {{ $line->cislo_linky }} </option>    <!-- TODO: zmenit z cisla_linky na id -->
                    @endforeach
                </select>
            </div>
        </div>
        <div class="add-container">
            <div class="add-item">
                <br> <br>
                <button type="submit" class="add-button-big">Vytvoriť novú trasu</button>
            </div>
        </div>
    </form>

    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">Poradie</th>
                <th class="list-up-box">Zastávka*</th>
                <th class="list-up-box">Dĺžka úseku*</th>
                <th class="list-up-box">Čas úseku*</th>
                <th class="list-up-box"></th>
            </tr>
        </thead>
        <tbody class="list-low-body"> 
            @foreach ($zastavka as $key => $value)
                <tr class="list-low-row">
                    <td class="list-low-box">{{$key + 1}}</td> 
                    <td class="list-low-box">
                        {{-- <input type="text" wire:model="zastavka.{{ $value }}" placeholder="Zastavka"> --}}
                        <select wire:model="zastavka.{{ $key }}" class="list-low-select"  id="zastavka" name="zastavka" required>
                            <option value=""></option>
                            @foreach ($stops as $stop)
                                <option value="{{ $stop->meno_zastavky }}">{{ $stop->meno_zastavky }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="list-low-box">
                        <input wire:model="dlzka.{{ $key }}" class="list-low-input" type="text" placeholder="Dĺžka úseku (km)" required>
                    </td>
                    <td class="list-low-box">
                        <input wire:model="cas.{{ $key }}" class="list-low-input" type="text" placeholder="Čas úseku (min)" required>
                    </td>
                    <td class="list-low-box-buttons">
                        <button wire:click="remove({{ $key }})" class="list-low-button" type="button">Vymazať zastávku</button>
                    </td>
                </tr>
                @endforeach
                <tr class="list-low-row">
                    <td class="list-low-box-buttons" colspan="5">
                        <button wire:click="add" class="list-low-button" type="button">Pridať novú zastávku</button>
                    </td>
                </tr>
        </tbody>
    </table>
</div>
        {{-- <label class="add-label" for="add_stop" Pridať zastávku></label>
        <input type="submit" name="add_stop" value="  +  "><br> --}}
        {{-- <button name="add_stop">+</button> <br> --}}
