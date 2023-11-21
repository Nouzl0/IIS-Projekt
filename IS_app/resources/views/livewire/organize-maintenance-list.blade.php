<div>
    <div class="component-box">
        <div class="component-switch"> <!-- Corrected typo: "compoenent-switch" to "component-switch" -->
            @switch($showValue)
                @case('Requests')
                    <button wire:click="toggleShow('Requests')" class="switch-button-active" id="right">Nahlásené závady</button>
                    <button wire:click="toggleShow('Active')"   class="switch-button">Aktívne údržby</button>
                    <button wire:click="toggleShow('History')"  class="switch-button" id="left">História údržieb</button>
                @break
                @case('History')
                    <button wire:click="toggleShow('Requests')" class="switch-button" id="right">Nahlásené závady</button>
                    <button wire:click="toggleShow('Active')"   class="switch-button">Aktívne údržby</button>
                    <button wire:click="toggleShow('History')"  class="switch-button-active" id="left">História údržieb</button>
                @break
                @default
                    <button wire:click="toggleShow('Requests')" class="switch-button" id="right">Nahlásené závady</button>
                    <button wire:click="toggleShow('Active')"   class="switch-button-active">Aktívne údržby</button>
                    <button wire:click="toggleShow('History')"  class="switch-button" id="left">História údržieb</button>
            @endswitch
        </div>
        <div class="component-content">
            @switch($showValue)
                @case('Requests')
                    @livewire('organize-maintenance-list-requests')
                    @break
                @case('History')
                    @livewire('organize-maintenance-list-history')
                    @break
                @default
                    @livewire('organize-maintenance-list-active')
            @endswitch
        </div>
    </div>
</div>