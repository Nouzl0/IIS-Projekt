<div>
    <!-- Form -->
    <form wire:submit.prevent="vehicleAdd" class="add-form">    <!-- Add User -->
        <div class="add-container">
            <div class="add-item">
                <label class="add-label" for="spz">ŠPZ*</label>    <!-- Input [spz] -->
                <input wire:model="spz" class="add-input" type="text" id="spz" name="spz" required>
            </div>
            <div class="add-item">
                <label class="add-label" for="vehicleName">Názov vozidla*</label>      <!-- Input [Názov vozidla] -->
                <input wire:model="vehicleName" class="add-input" type="text" id="vehicleName" name="vehicleName" required>
            </div>
        </div>
        <div class="add-container">
            <div class="add-item">
                <label class="add-label" for="vehicleType">Druh vozidla*</label>             <!-- Input [Druh vozidla] -->
                <select wire:model='vehicleType' class="add-select" id="vehicleType" name="vehicleType" required>
                    <option value=""></option>
                    <option value="Autobus">Autobus</option>
                    <option value="Trolejbus">Trolejbus</option>
                    <option value="Električka">Električka</option>
                </select>
            </div>
            <div class="add-item">
                <label class="add-label" for="vehicleBrand">Značka vozidla*</label>       <!-- Input [Password] -->
                <input wire:model="vehicleBrand" class="add-input" type="vehicleBrand" id="vehicleBrand" name="vehicleBrand" required>
            </div>
        </div>
        <div class="add-container">
            <div class="add-item">
                <br> <br>
                <button class="add-button-big" type="submit">Pridať vozidlo</button>
            </div>
        </div>
    </form>
</div>