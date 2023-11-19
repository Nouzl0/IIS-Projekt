<div>
    <!-- Form -->
    <form wire:submit.prevent="addVehicleIssue" class="add-form-column">
        <div class="add-container-row">
            <div class="add-container">
                <div class="add-item">      <!-- Messaage name -->
                    <label class="add-label" for="messageName">Názov správy*</label>
                    <input wire:model="messageName" class="add-input" type="text" id="messageName" name="messageName" required>
                </div>
            </div>
            <div class="add-container">
                <div class="add-item">      <!-- Vehicle SPZ -->
                    <label class="add-label" for="vehicle">ŠPZ vozidla*</label>
                    <select class="add-select" wire:model="spz" id="vehicle" name="vehicle" required>
                        <option value=""></option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->spz }}">{{ $vehicle->spz }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="add-container">
                <div class="add-item"></div>
                <div class="add-item">
                    <button class="add-button" type="submit">Nahlásiť</button>
                </div>
            </div>
        </div>
        <div class="add-container">
            <div class="add-item">  <!-- Messaage text-window -->
                <label class="add-label" for="issue">Popis závady*</label>
                <textarea wire:model='popis' class="add-text" type="text" id="popis" name="popis" required></textarea><br>
            </div>
        </div>
    </form>
</div>