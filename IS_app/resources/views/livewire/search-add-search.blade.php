<div>
    <!-- Form -->
    <form wire:submit.prevent="searchAdd" class="add-form">    <!-- Add Search QUarry -->
        <div class="add-container">
            <div class="add-item">
                <label class="add-label" for="firstName">Zástavka:</label>    <!-- Input [Zástavka] -->
                <input wire:model="busStop" class="add-input" type="text" id="busStop" name="busStop" required>
            </div>
        </div>
        <div class="add-container">
            <div class="add-item">
                <label class="add-label" for="date">Dátum:</label>      <!-- Input [Dátum] -->
                <input wire:model="date" class="add-input" type="date" id="date" name="date" required>
            </div>
        </div>
        <div class="add-container">
            <div class="add-item">
                <label class="add-label" for="time">Čas:</label>             <!-- Input [Email] -->
                <input wire:model="time" class="add-input" type="time" id="time" name="time" required>
            </div>
        </div>
        <div class="add-container">
            <div class="add-item"></div>
            <div class="add-item">                                        <!-- Button Submit [Hladať] -->
                <button class="add-button" type="submit">Hladať</button>
            </div>
        </div>
    </form>
</div>