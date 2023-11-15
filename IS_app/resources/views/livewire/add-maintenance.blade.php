<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <form wire:submit.prevent="submit" class="add_box">
        <label class="add-label" for="spz">SPŽ vozidla</label>
        <select name="spz" class="add-input" wire:model="spz">
            <option value=""></option>
            @foreach ($vehicles as $vehicle)
                <option value="{{ $vehicle->spz }}"> {{ $vehicle->spz }} </option>
            @endforeach
        </select>
        <label class="add-label" for="time_of_start_maintenance">Čas začiatku</label>
        <input class="add-input" type="time" name="time_of_start_maintenance" wire:model="cas" required ><br>
        <label class="add-label" for="date_of_start_maintenance">Dátum údržby</label>
        <input class="add-input" type="date" name="date_of_start_maintenance" wire:model="datum" required><br>
        <label class="add-label" for="stav">Stav</label>
        <input class="add-input" type="text" name="status" wire:model="stav" required> <br>
        <label class="add-label" for="popis">Popis</label>
        <textarea class="add-input" name="popis" wire:model='popis' required></textarea><br>
        <input class="add_button" type="submit" value="Vytvoriť" class="button_add">
        @if (session()->has('message'))
            <div id="successMessage" class="alert alert-success">
                <p style="color:red;">{{ session('message') }}</p>
            </div>
        @endif
    </form>
</div>
@livewireScripts
