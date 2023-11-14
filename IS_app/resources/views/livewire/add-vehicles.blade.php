<div>
    {{-- The best athlete wants his opponent at his best. --}}
    {{-- TODO --}}
    {{--    vyriesit chybne zadany input --}}
    {{-- --------------------------------- --}}

    <form wire:submit.prevent="submit" class="add_box">
        <label class="add-label" for="id_vozidlo">ŠPZ</label>
        <input class="add-input" type="text" name="id_vozidlo" wire:model="id_vozidlo"> <br>
        <label class="add-label" for="nazov">Názov vozidla</label>
        <input class="add-input" type="text" name="nazov" wire:model="nazov"> <br>
        <label class="add-label" for="druh_vozidla">Druh vozidla</label>
        <input class="add-input" type="text" name="druh_vozidla" wire:model='druh_vozidla'> <br>
        <label class="add-label" for="znacka_vozidla">Značka vozidla</label>
        <input class="add-input" type="text" name="znacka_vozidla" wire:model="znacka_vozidla"> <br>
        <button type="submit" value="Pridať vozidlo" class="add_button">Uloz</button>
    </form>

</div>
@livewireScripts
