<div class="add_component">
            <form wire:submit.prevent="addVehicleIssueReport" class="add_box">
                <label class="add-label" for="vehicle">ŠPZ vozidla*</label>
                <input class="add-input" type="text" name="spz" wire:model="spz" required> <br>
                <label class="add-label" for="issue">Popis závady*</label>
                <textarea class="add-input" name="popis" wire:model='popis' required></textarea><br>
                <input type="submit" value="Nahlásiť" class="add_button"> 

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <p>{{ session('message') }}</p>
                    </div>
                @endif
            </form>
</div>