<div>
    <br> <br>
    <form wire:submit.prevent="lineAdd" class="add-form"> 
        <div class="add-container">
            <div class="add-item">
                <label class="add-label" for="cislo_linky">Číslo linky*</label>
                <input class="add-input" type="text" name="cislo_linky" wire:model="cislo_linky" required> <br>
            </div>
            <div class="add-item">
                <label class="add-label" for="vozidla_linky">Typ vozidla (linka)*</label>
                <select wire:model="vozidla_linky" class="list-low-select" id="vozidla_linky" name="vozidla_linky" required>
                    <option value=""></option>
                    <option value="Autobus">Autobus</option>
                    <option value="Električka">Električka</option>
                    <option value="Trolejbus">Trolejbus</option>
                </select>
            </div>
        </div>
        <div class="add-container">
            <div class="add-item">
                <br> <br>
                <button type="submit" value="pridat_linku" class="add-button-big">Pridať linku</button>
            </div>
        </div>
    </form>
</div>
