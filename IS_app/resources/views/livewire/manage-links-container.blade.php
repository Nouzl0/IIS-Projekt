<div>
    <div class="component-box">
        <div class="component-switch"> <!-- Corrected typo: "compoenent-switch" to "component-switch" -->
            @switch($showValue)
                @case('stop')
                    <button wire:click="toggleShow('stop')" class="switch-button-active" id="right">Správa zástavok</button>
                    <button wire:click="toggleShow('route')"   class="switch-button">Správa trás</button>
                    <button wire:click="toggleShow('link')"  class="switch-button" id="left">Správa linek</button>
                @break
                @case('link')
                    <button wire:click="toggleShow('stop')" class="switch-button" id="right">Správa zástavok</button>
                    <button wire:click="toggleShow('route')"   class="switch-button">Správa trás</button>
                    <button wire:click="toggleShow('link')"  class="switch-button-active" id="left">Správa linek</button>
                @break
                @default
                    <button wire:click="toggleShow('stop')" class="switch-button" id="right">Správa zástavok</button>
                    <button wire:click="toggleShow('route')"   class="switch-button-active">Správa trás</button>
                    <button wire:click="toggleShow('link')"  class="switch-button" id="left">Správa linek</button>
            @endswitch
        </div>
        <div class="component-content">
            @switch($showValue)
                @case('stop')
                    <br> <br>
                    <label class="label"> • Vytvoriť novú zástavku</label>
                    @livewire('manage-links-add-stop')
                    <br> <br>
                    <label class="label">• Zoznam zástavok</label>
                    @livewire('manage-links-list-of-stops')
                    @break
                @case('link')
                    <br> <br>
                    <label class="label"> • Vytvoriť novú linku</label>
                    @livewire('manage-links-add-line')
                    <br> <br>
                    <label class="label"> • Zoznam liniek</label>
                    @livewire('manage-links-lines-list')
                    @break
                @default
                    <br> <br>
                    <label class="label"> • Vytvoriť novú trasy</label>
                    <br> <br>
                    @livewire('manage-links-add-routes')
                    <hr style="width:100%;text-align:left;margin-left:0"> 
                    <br> <br>
                    <label class="label"> • Zoznam trás</label>
                    @livewire('manage-links-list-routes')
            @endswitch
        </div>
    </div>
</div>