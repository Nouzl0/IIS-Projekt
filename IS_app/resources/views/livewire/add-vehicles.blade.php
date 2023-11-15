<div>
    <form wire:submit.prevent="submit" class="add_box">
        <label class="add-label" for="id_vozidlo">ŠPZ*</label>
        <input class="add-input" type="text" name="spz" wire:model="spz" required> <br>
        <label class="add-label" for="nazov">Názov vozidla*</label>
        <input class="add-input" type="text" name="nazov_vozidla" wire:model="nazov_vozidla" required> <br>

        <label class="add-label" for="druh_vozidla">Druh vozidla*</label>
        <select name="druh_vozidla" wire:model='druh_vozidla' class="add-input">
            <option value=""></option>
            <option value="Autobus">Autobus</option>
            <option value="Trolejbus">Trolejbus</option>
            <option value="Električka">Električka</option>
        </select>

        <label class="add-label" for="znacka_vozidla">Značka vozidla*</label>
        <input class="add-input" type="text" name="znacka_vozidla" wire:model="znacka_vozidla" required> <br>
        <button type="submit" value="Pridať vozidlo" class="add_button">Pridať vozidlo</button>

        @if (session()->has('message'))
            <div id="successMessage" class="alert alert-success">
                <p style="color:red;">{{ session('message') }}</p>
            </div>
        @endif
    </form>

</div>
@livewireScripts
