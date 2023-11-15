<div class="add_component">
    <form wire:submit.prevent="addVehicleIssueReport" class="add_box">
        <label class="add-label" for="vehicle">ŠPZ vozidla*</label>
        <select name="spz" class="add-input" wire:model="spz">
            <option value=""></option>
            @foreach ($vehicles as $vehicle)
                <option value="{{ $vehicle->spz }}"> {{ $vehicle->spz }} </option>
            @endforeach
        </select>
        <label class="add-label" for="issue">Popis závady*</label>
        <textarea class="add-input" name="popis" wire:model='popis' required></textarea><br>
        <input type="submit" value="Nahlásiť" class="add_button">

        @if (session()->has('message'))
            <div class="alert alert-success">
                <p>{{ session('message') }}</p>
            </div>
        @endif
    </form>
</div>
@livewireScripts
