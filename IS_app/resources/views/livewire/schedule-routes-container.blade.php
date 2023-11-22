<div>
    <div class="component-box">
        <div class="component-switch"> <!-- Corrected typo: "compoenent-switch" to "component-switch" -->
            @switch($showValue)
                @case('history')
                    <button wire:click="toggleShow('edit')"   class="switch-button" id="right" >Naplánované spoje</button>
                    <button wire:click="toggleShow('history')"  class="switch-button-active" id="left">História naplánovaných spojov</button>
                @break
                @default
                    <button wire:click="toggleShow('edit')"   class="switch-button-active" id="right">Naplánované spoje</button>
                    <button wire:click="toggleShow('history')"  class="switch-button" id="left">História naplánovaných spojov</button>
            @endswitch
        </div>
        <div class="component-content">
            @switch($showValue)
                @case('history')
                    @livewire('schedule-routes-list-history')
                    @break
                @default
                    @livewire('schedule-routes-list-edit') 
            @endswitch
        </div>
    </div>
</div>