<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <table>
        <thead>
            <tr>
                <th>ŠPZ</th>
                <th>Názov</th>
                <th>Typ</th>
                <th>Výrobca</th>
                <th>Šofér</th>
                <th>Stav</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            
            <tr>
                @if($isEdit)
                <td>4A23000</td>
                <td>Škodat 13T</td>
                <td>Električka</td>
                <td>Škoda</td>
                <td>Janko</td>
                <td>Pojazdné</td>
                <td id="td_button"> <button wire:click="ToggleContentSwitch" class="button_edit" >Upraviť</button> </td>

                @else
                    <td> <input type="text" name="spz" value="4A23000"  class="input_edit_form"> </td>
                    <td> <input type="text" name="vehicle_name" value="Škodat 13T" class="input_edit_form"></td>
                    <td> <input type="text" name="vehicle_type" value="Elektricka" class="input_edit_form"></td>
                    <td><input type="text" name="vehicle_brand" value="Škoda" class="input_edit_form"></td>
                    <td><input type="text" name="driver" value="Janko" class="input_edit_form"></td>
                    <td><input type="text" name="vehicle_condition" value="Pojazdné" class="input_edit_form"></td>
                    <td> 
                        <button wire:click="ToggleContentSwitch" class="button_edit" >Ulož</button> 
                        <button class="button_delete">Vymaž</button>
                    </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
