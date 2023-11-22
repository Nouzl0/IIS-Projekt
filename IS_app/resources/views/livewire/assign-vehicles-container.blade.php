<div>
    <div class="component-box">
        <div class="component-switch"> <!-- Corrected typo: "compoenent-switch" to "component-switch" -->
            @switch($showValue)
                @case('assign')
                    <button wire:click="toggleShow('assign')" class="switch-button-active" id="right">Priradiť vozidlá</button>
                    <button wire:click="toggleShow('edit')"   class="switch-button">Priradené plánované spoje</button>
                    <button wire:click="toggleShow('history')"  class="switch-button" id="left">História priradených spojov</button>
                @break
                @case('history')
                    <button wire:click="toggleShow('assign')" class="switch-button" id="right">Priradiť vozidlá</button>
                    <button wire:click="toggleShow('edit')"   class="switch-button">Priradené plánované spoje</button>
                    <button wire:click="toggleShow('history')"  class="switch-button-active" id="left">História priradených spojov</button>
                @break
                @default
                    <button wire:click="toggleShow('assign')" class="switch-button" id="right">Priradiť vozidlá</button>
                    <button wire:click="toggleShow('edit')"   class="switch-button-active">Priradené plánované spoje</button>
                    <button wire:click="toggleShow('history')"  class="switch-button" id="left">História priradených spojov</button>
            @endswitch
        </div>
        <div class="component-content">
            @switch($showValue)
                @case('assign')
                    @livewire('assign-vehicles-list-assign')
                    @break
                @case('history')
                    @livewire('assign-vehicles-list-history')
                    @break
                @default
                    @livewire('assign-vehicles-list-edit') 
            @endswitch
        </div>
    </div>
</div>