<div>
    {{-- Do your work, then step back. --}}
    <form wire:submit.prevent="stopAdd" class="add_box">
        <label class="add-label" for="stop_name">Názov zastávky*</label>
        <input class="add-input" type="text" name="stop_name" wire:model="stop_name" required> <br>

        <label class="add-label" for="stop_address">Adresa zastávky*</label>
        <input class="add-input" type="text" name="stop_address" wire:model="stop_address" required> <br>

        <button type="submit" value="Pridať zastávku" class="list-low-button">Pridať zastávku</button>
    </form>

</div>
