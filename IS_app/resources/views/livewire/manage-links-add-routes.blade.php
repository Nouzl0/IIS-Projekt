<div>
    {{-- Do your work, then step back. --}}
    <form wire:submit.prevent="stopAdd" class="add_box">
        <label class="add-label" for="route_name">Názov trasy*</label>
        <input class="add-input" type="text" name="route_name" wire:model="route_name" required> <br>

        <label class="add-label" for="info">Informácie o trase*</label>
        <input class="add-input" type="text" name="info" wire:model="info" required> <br>
        
        <label class="add-label" for="stop">Zastavka*</label>
        <input class="add-input" type="text"b name="stop" wire:model="stop" required> <br>


        <button type="submit" value="Pridať zastávku" class="add_button">Pridať zastávku</button>
    </form>
</div>
