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

        {{-- beginning stops --}}
        <div>
            {{-- first stop --}}
            <div>
                <div>
                    <label for="zastavka.0" class="add-label">Meno zastávky</label>
                    <select wire:model="zastavka.0" id="zastavka.0" class="add-input" name="zastavka.0" required>
                        <option value=""></option>
                        @foreach ($stops as $stop)
                            <option value="{{ $stop->meno_zastavky }}">{{ $stop->meno_zastavky }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="dlzka.0" class="add-label">Dĺžka úseku[km]</label>
                    <select wire:model="dlzka.0" id="dlzka.0" class="add-input">
                        @foreach ($numRange as $number)
                            <option value="{{ $number }}">{{ $number }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="cas.0" class="add-label">Čas úseku[min]</label>
                    <select wire:model="cas.0" id="cas.0" class="add-input">
                        @foreach ($numRange as $number)
                            <option value="{{ $number }}">{{ $number }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="text" wire:click="add({{ $i }})" class="list-low-button">Pridať
                    zástavku</button>
            </div>

            {{-- ass stop --}}
            @foreach ($inputs as $key => $value)
                <div>
                    <div>
                        <label for="zastavka.{{ $value }}" class="add-label">Meno zastávky</label>
                        <select wire:model="zastavka.{{ $value }}" id="zastavka.{{ $value }}"
                            class="add-input" name="zastavka.{{ $value }}" required>
                            <option value=""></option>
                            @foreach ($stops as $stop)
                                <option value="{{ $stop->meno_zastavky }}">{{ $stop->meno_zastavky }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="dlzka.{{ $value }}" class="add-label">Dĺžka úseku[km]</label>
                        <select wire:model="dlzka.{{ $value }}" id="dlzka.{{ $value }}"
                            class="add-input">
                            @foreach ($numRange as $number)
                                <option value="{{ $number }}">{{ $number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="cas.{{ $value }}" class="add-label">Čas úseku[min]</label>
                        <select wire:model="cas.{{ $value }}" id="cas.{{ $value }}" class="add-input">
                            @foreach ($numRange as $number)
                                <option value="{{ $number }}">{{ $number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="text" wire:click="remove({{ $key }})"
                        class="list-low-button">Vymaž</button>
                </div>
                @endforeach
        </div>
        {{-- end stops --}}
        <button type="submit" value="Pridať" class="add-button-big">Vytvoriť trasu</button>
    </form>
</div>
