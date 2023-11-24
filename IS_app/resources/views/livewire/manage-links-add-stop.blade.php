<div>
    <br> <br>
    <form wire:submit.prevent="stopAdd" class="add-form">
        <div class="add-container">
            <div class="add-item">
                <label class="add-label" for="stop_name">Názov zastávky*</label>
                <input class="add-input" type="text" name="stop_name" wire:model="stop_name" required> <br>
            </div>
            <div class="add-item">
                <label class="add-label" for="stop_address">Adresa zastávky*</label>
                <input class="add-input" type="text" name="stop_address" wire:model="stop_address" required> <br>
            </div>
        </div>
        <div class="add-container">
            <div class="add-item">
                <br> <br>
                <button type="submit" value="Pridať zastávku" class="add-button-big">Pridať zastávku</button>
            </div>
        </div>
    </form>

</div>
