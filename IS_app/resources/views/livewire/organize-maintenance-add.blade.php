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
                    <label class="add-label" for="spz">ŠPZ vozidla*</label>
                    <select class="add-select" wire:model="spz" id="spz" name="spz" required>
                        <option value=""></option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->spz }}">{{ $vehicle->spz }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="add-container">
                <div class="add-item">      <!-- Vehicle SPZ -->
                    <label class="add-label" for="maintenanceTime">Čas dokončenia údržby*</label>
                    <input wire:model="maintenanceTime" class="add-input" type="time" id="maintenanceTime" name="maintenanceTime" required>                    
                </div>
                <div class="add-item">
                    <label class="add-label" for="maintenanceState">Dátum dokončenia údržby*</label>
                    <input wire:model="maintenanceDate" class="add-input" type="date" id="maintenanceDate" name="maintenanceDate" required>      
                </div>
            </div>
            <div class="add-container">
                <div class="add-item">
                    <label class="add-label" for="maintenanceTechnician">Priradiť technika*</label>
                    <select class="add-select" wire:model="maintenanceTechnician" id="maintenanceTechnician" name="maintenanceTechnician" required>
                        <option value=""></option>
                        @foreach ($technicians as $technician)
                            <option value="{{ $technician->id_uzivatel }}">{{ $technician->meno_uzivatela }} {{ $technician->priezvisko_uzivatela }} - ({{ $technician->email_uzivatela }})</option>
                        @endforeach
                    </select>    
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
                
        @if ($importMode) <!-- Import Mode (options) -->
            <div class="add-container-row">
                <div class="add-container">
                    <div class="add-select" type="text" id="maintenanceDescription" name="maintenanceDescription">*Vytvára sa údržba pre nahlásenú závadu číslo ({{ $importValue }})</div>
                </div>
                <div class="add-container">
                    <button wire:click="importMaintenance('{{ '-1' }}')" class="add-button">Zrušiť</button>
                </div>
            </div>
        @endif
    </form>
</div>