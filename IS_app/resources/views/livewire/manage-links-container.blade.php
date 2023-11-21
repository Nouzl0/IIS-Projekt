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
                    @livewire('manage-links-add-stop')
                    @livewire('manage-links-list-of-stops')
                    @break
                @case('link')
                    @livewire('manage-links-add-line')
                    @livewire('manage-links-lines-list')
                    @break
                @default
                    @livewire('manage-links-add-routes') 
                    @livewire('manage-links-list-routes')
            @endswitch
        </div>
    </div>
</div>