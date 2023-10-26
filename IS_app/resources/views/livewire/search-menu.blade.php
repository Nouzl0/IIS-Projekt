<div class="my-livewire-component">
    <div class="input-group">
        <label for="bus-stop">Bus Stop</label>
        <input type="text" id="bus-stop" wire:model="busStop" class="input-field">
    </div>

    <div class="input-group">
        <label for="date">Date</label>
        <input type="date" id="date" wire:model="date" class="input-field">
    </div>

    <div class="input-group">
        <label for="time">Time</label>
        <input type="time" id="time" wire:model="time" class="input-field">
    </div>

    <button wire:click="search" class="button_search">Hľadať</button>
</div>
