<div>
    <!-- Form -->
    <form wire:submit.prevent="addMaintenance" class="add-form-column">
        <div class="add-container-row">
            <div class="add-container">
                <div class="add-item">      <!-- Messaage name -->
                    <label class="add-label" for="maintenanceName">Názov správy*</label>
                    <input wire:model="maintenanceName" class="add-input" type="text" id="maintenanceName" name="maintenanceName" required>
                </div>
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
                <div class="add-item">      <!-- Vehicle SPZ -->
                    <label class="add-label" for="maintenanceTime">Čas údržby*</label>
                    <input wire:model="maintenanceTime" class="add-input" type="time" id="maintenanceTime" name="maintenanceTime" required>                    
                </div>
                <div class="add-item">
                    <label class="add-label" for="maintenanceState">Dátum údržby*</label>
                    <input wire:model="maintenanceDate" class="add-input" type="date" id="maintenanceDate" name="maintenanceDate" required>      
                </div>
            </div>
            <div class="add-container">
                <div class="add-item">
                    <label class="add-label" for="maintenanceTechnician">Priradiť technika*</label>
                    <input wire:model="maintenanceTechnician" class="add-input" type="text" id="maintenanceTechnician" name="maintenanceTechnician" required>      
                </div> <br>
                <div class="add-item">
                    <button class="add-button" type="submit">Vytvoriť údržbu</button>
                </div>
            </div>
        </div>
        <div class="add-container">
            <div class="add-item">  <!-- Messaage text-window -->
                <label class="add-label" for="maintenanceDescription">Popis závady*</label>
                <textarea wire:model='maintenanceDescription' class="add-text" type="text" id="maintenanceDescription" name="maintenanceDescription" required></textarea><br>
            </div>
        </div>
    </form>
</div>