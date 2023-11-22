<div>
    <div class="component-box">
        <div class="component-switch"> <!-- Corrected typo: "compoenent-switch" to "component-switch" -->
            @switch($showValue)
                @case('add')
                    <button wire:click="toggleShow('add')" class="switch-button-active" id="right">Vytvoriť plánovaný spoj</button>
                    <button wire:click="toggleShow('edit')"   class="switch-button">Naplánované spoje</button>
                    <button wire:click="toggleShow('history')"  class="switch-button" id="left">História naplánovaných spojov</button>
                @break
                @case('history')
                    <button wire:click="toggleShow('add')" class="switch-button" id="right">Vytvoriť plánovaný spoj</button>
                    <button wire:click="toggleShow('edit')"   class="switch-button">Naplánované spoje</button>
                    <button wire:click="toggleShow('history')"  class="switch-button-active" id="left">História naplánovaných spojov</button>
                @break
                @default
                    <button wire:click="toggleShow('add')" class="switch-button" id="right">Vytvoriť plánovaný spoj</button>
                    <button wire:click="toggleShow('edit')"   class="switch-button-active">Naplánované spoje</button>
                    <button wire:click="toggleShow('history')"  class="switch-button" id="left">História naplánovaných spojov</button>
            @endswitch
        </div>
        <div class="component-content">
            @switch($showValue)
                @case('add')
                    @livewire('schedule-routes-add-new-schedule')
                    @livewire('schedule-routes-list-new-schedule')
                    @break
                @case('history')
                    @livewire('schedule-routes-list-history')
                    @break
                @default
                    @livewire('schedule-routes-list-edit') 
            @endswitch
        </div>
    </div>
</div>