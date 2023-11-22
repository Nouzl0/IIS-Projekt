<div>
    {{-- Do your work, then step back. --}}
    <form wire:submit.prevent="routeAdd" class="add_box">
        <label class="add-label" for="route_name">Názov trasy*</label>
        <input class="add-input" type="text" name="route_name" wire:model="meno_trasy" required> <br>

        <label class="add-label" for="info">Informácie o trase*</label>
        <input class="add-input" type="text" name="info" wire:model="info_trasy" required> <br>

        <label class="add-label" for="linka">Linka*</label>
        <select name="linka" class="add-input" wire:model="cislo_linky">
            <option value=""></option>
            @foreach ($lines as $line)
                <option value="{{ $line->cislo_linky }}"> {{ $line->cislo_linky }} </option>
            @endforeach
        </select>
        {{-- 
        <label class="add-label" for="stop">Prvá zastavka*</label>
        <input class="add-input" type="text"b name="stop" wire:model="stop"> <br> --}}


        <div>
            {{-- <input type="text" wire:model="zastavka.0" placeholder="Zastavka"> --}}
            <select  wire:model="zastavka.0" id="zastavka.0"
                name="zastavka.0" required>
                <option value=""></option>
                @foreach ($stops as $stop)
                    <option value="{{ $stop->meno_zastavky }}">{{ $stop->meno_zastavky }}</option>
                @endforeach
            </select>
            <input type="text" wire:model="dlzka.0" placeholder="Dlzka useku">
            <input type="text" wire:model="cas.0" placeholder="Čas úseku">
            <button type="text" wire:click="add({{ $i }})">Pridať zástavku</button>
        </div>

        @foreach ($inputs as $key => $value)
            <div>
                {{-- <input type="text" wire:model="zastavka.{{ $value }}" placeholder="Zastavka"> --}}
                <select  wire:model="zastavka.{{ $value }}" id="zastavka.{{ $value }}"
                name="zastavka.{{ $value }}" required>
                <option value=""></option>
                @foreach ($stops as $stop)
                    <option value="{{ $stop->meno_zastavky }}">{{ $stop->meno_zastavky }}</option>
                @endforeach
            </select>
                <input type="text" wire:model="dlzka.{{ $value }}" placeholder="Dlzka useku">
                <input type="text" wire:model="cas.{{ $value }}" placeholder="Čas úseku">
                <button type="text" wire:click="remove({{ $key }})">Vymaž</button>
            </div>
        @endforeach

        {{-- <label class="add-label" for="add_stop" Pridať zastávku></label>
        <input type="submit" name="add_stop" value="  +  "><br> --}}
        {{-- <button name="add_stop">+</button> <br> --}}
        <button type="submit" value="Pridať" class="add_button">Pridať</button>
    </form>
</div>
