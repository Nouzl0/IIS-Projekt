<div>
    <!-- Form -->
    <form wire:submit.prevent="scheduleAdd" class="add-form">
        <div class="add-container">
            <div class="add-item">      <!-- Input [Route] -->
                <label class="add-label" for="scheduledRoute">Trasa*</label>
                <select wire:model="scheduledRoute" class="add-select" id="scheduledRoute" name="scheduledRoute" required>
                    <option value=""></option>
                    @foreach ($linkRoutes as $linkRoute)
                        <option value="{{ $linkRoute['routeId'] }}">{{ $linkRoute['linkName'] }} - {{ $linkRoute['routeName'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="add-item"> <!-- Input [scheduledDate] -->
                <label class="add-label" for="scheduledDate">Dátum začiatku*</label>
                <input wire:model="scheduledDate"  type="date" name="scheduledDate" class="list-low-input" required>
            </div>
            <div class="add-item"> <!-- Input [scheduledTime] -->
                <label class="add-label" for="scheduledTime">Čas*</label>
                <input wire:model="scheduledTime"  type="time" name="scheduledTime" class="list-low-input" required>
            </div>
        </div>
        <div class="add-container">
            <div class="add-item">      <!-- Input -->
                <label class="add-label" for="scheduledRepeat">Opakovanie*</label>
                <select wire:model="scheduledRepeat" class="add-select" id="scheduledRepeat" name="scheduledRepeat" required>
                    <option value=""></option>
                    @foreach ($repeatTypes as $repeatType)
                        <option value="{{ $repeatType }}">{{ $repeatType }}</option>
                    @endforeach
                </select>                 
            </div>
            <div class="add-item">
                <label class="add-label" for="maintenanceState">Platný do*</label>
                <input wire:model="scheduledValidUntil" class="add-input" type="date" id="scheduledValidUntil" name="scheduledValidUntil" required>      
            </div>
            <div class="add-item"> <br>
                <button class="add-button" type="submit">Vytvoriť plánovaný spoj</button>
            </div>
        </div>
    </form>
</div>