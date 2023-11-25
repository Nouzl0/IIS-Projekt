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
            <tr class="list-low-row">
                <td class="list-low-box">1</td> 
                <td class="list-low-box">
                    <select wire:model="zastavka.0" class="list-low-select" id="zastavka.0" name="zastavka.0" required> {{-- <input type="text" wire:model="zastavka.0" placeholder="Zastavka"> --}}
                        <option value=""></option>
                        @foreach ($stops as $stop)
                            <option value="{{ $stop->meno_zastavky }}">{{ $stop->meno_zastavky }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="list-low-box">
                    <input wire:model="dlzka.0" class="list-low-input" type="text" placeholder="Dĺžka úseku (km)" required>
                </td>
                <td class="list-low-box">
                    <input wire:model="cas.0" class="list-low-input" type="text" placeholder="Čas úseku (min)" required>
                </td>
                <td class="list-low-box"></td>
            </tr>
            @if ($i == 1)
                <tr class="list-low-row">
                    <td class="list-low-box-buttons" colspan="5">
                        <button wire:click="add({{ $i }})" class="list-low-button" type="button">Pridať novú zástavku</button>
                    </td>
                </tr>
            @endif
            @foreach ($inputs as $key => $value)
                <tr class="list-low-row">
                    <td class="list-low-box">{{$key + 2}}</td> 
                    <td class="list-low-box">
                        {{-- <input type="text" wire:model="zastavka.{{ $value }}" placeholder="Zastavka"> --}}
                        <select wire:model="zastavka.{{ $value }}" class="list-low-select"  id="zastavka.{{ $value }}" name="zastavka.{{ $value }}" required>
                            <option value=""></option>
                            @foreach ($stops as $stop)
                                <option value="{{ $stop->meno_zastavky }}">{{ $stop->meno_zastavky }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="list-low-box">
                        <input wire:model="dlzka.{{ $value }}" class="list-low-input" type="text" placeholder="Dĺžka úseku (km)" required>
                    </td>
                    <td class="list-low-box">
                        <input wire:model="cas.{{ $value }}" class="list-low-input" type="text" placeholder="Čas úseku (min)" required>
                    </td>
                    <td class="list-low-box-buttons">
                        <button wire:click="remove({{ $key }})" class="list-low-button" type="button">Vymazať zastávku</button>
                    </td>
                </tr>
                @if ($i == $key+2)
                    <tr class="list-low-row">
                        <td class="list-low-box-buttons" colspan="5">
                            <button wire:click="add({{ $i }})" class="list-low-button" type="button">Pridať novú zastávku</button>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
        {{-- <label class="add-label" for="add_stop" Pridať zastávku></label>
        <input type="submit" name="add_stop" value="  +  "><br> --}}
        {{-- <button name="add_stop">+</button> <br> --}}
