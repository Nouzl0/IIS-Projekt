<div>
    <form wire:submit.prevent="lineAdd" class="add_box">
        <label class="add-label" for="cislo_linky">Názov zastávky*</label>
        <input class="add-input" type="text" name="cislo_linky" wire:model="cislo_linky" required> <br>

        <label class="add-label" for="vozidla_linky">Adresa zastávky*</label>
        <select wire:model="vozidla_linky" class="add-select" id="vozidla_linky" name="vozidla_linky" required>
            <option value=""></option>
            <option value="Autobus">Autobus</option>
            <option value="Električka">Električka</option>
            <option value="Trolejbus">Trolejbus</option>
        </select>

        <button type="submit" value="pridat_linku" class="list-low-button">Pridať linku</button>
    </form>
</div>
