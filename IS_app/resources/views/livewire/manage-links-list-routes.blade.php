<div>
    {{-- The best athlete wants his opponent at his best. --}}

    <table>
        <thead>
            <tr>
                <th>Meno trasy</th>
                <th>Detail</th>
                <th>Linka</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="list-low-body"> <!-- Table Body -->

            @forelse ($routes as $route)
                @if ($editButton && $editValue === $route['meno_trasy'])
                    <tr class="list-low-row">
                        <td class="list-low-box">
                            <input type="text" name="meno_trasy" value="{{ $route['meno_trasy'] }}"
                                wire:model="meno_trasy" class="input_edit_form">
                        </td>
                        <td class="list-low-box">
                            <input type="text" name="info_trasy" value="{{ $route['info_trasy'] }}"
                                wire:model="info_trasy" class="input_edit_form">
                        </td>
                        <td class=list-low-box>

                            <select name="cislo_linky" class="add-input" wire:model="cislo_linky">
                                <option value=""></option>
                                @foreach ($lines as $line)
                                    <option value="{{ $line->cislo_linky }}"> {{ $line->cislo_linky }} </option>
                                @endforeach
                            </select>
                        </td>

                        <td class=list-low-box>
                            <button wire:click="routeEdit('{{ $route['meno_trasy'] }}')"
                                class="list-low-button">Upraviť</button>
                            <button wire:click="routeDelete('{{ $route['meno_trasy'] }}')"
                                class="list-low-button">Vymazať</button>
                        </td>
                    </tr>
                @else
                    <tr class="list-low-row"> <!-- Show User -->
                        <td class="list-low-box">{{ $route['meno_trasy'] }}</td> <!-- Text [meno_trasy] -->
                        <td class="list-low-box">{{ $route['info_trasy'] }}</td> <!-- Text [adresa_trasy] -->
                        <td class="list-low-box">{{ $route['id_linka'] }}</td> <!-- Text [adresa_trasy] -->
                        <td class=list-low-box>
                            <button wire:click="routeEdit('{{ $route['meno_trasy'] }}')"
                                class="list-low-button">Upraviť</button>
                            <button wire:click="routeDelete('{{ $route['meno_trasy'] }}')"
                                class="list-low-button">Vymazať</button>
                            <button wire:click="hide_all_stops()" class="list-low-button">Zastavky</button>
                        </td>
                    </tr>
                    {{-- hide stops if false --}}
                    @if ($all_stops)
                        <thead>
                            <tr>
                                <th></th>
                                <th>Zastávka</th>
                                <th>Dĺžka úseku[km]</th>
                                <th>Čas úseku[min]</th>
                                <th> <button class="list-low-button"
                                        wire:click="stopInRouteEdit('{{ $route['meno_trasy'] }}')">Upravit</button>
                                </th>
                            </tr>
                        </thead>
                        @if ($editButton && $editValue === $route['meno_trasy'])
                            @forelse ($route['zastavky'] as $stop)
                                <tr class="list-sub-low-row">
                                    <td class="list-sub-low-box"></td>
                                    <td class="list-sub-low-box">
                                        <input type="text" name="zastavka" value="{{ $stop[0] }}"
                                            class="input_edit_form">
                                    </td> <!-- Text [stop/stand] -->
                                    <td class="list-sub-low-box">
                                        <input type="text" name="zastavka" value="{{ $stop[1] }}"
                                            class="input_edit_form">
                                    </td> <!-- Text [stop/stand] -->
                                    <td class="list-sub-low-box">
                                        <input type="text" name="zastavka" value="{{ $stop[2] }}"
                                            class="input_edit_form">
                                    </td> <!-- Text [stop/stand] -->
                                    <td class="list-sub-low-box"></td>
                                    <td class="list-sub-low-box"></td>
                                </tr>
                            @empty
                                <tr class="list-sub-low-row">
                                    <td class="list-sub-low-box">Žiadne zastávky neboli nájdené</td>
                                </tr>
                            @endforelse
                        @else
                            @forelse ($route['zastavky'] as $stop)
                                <tr class="list-sub-low-row">
                                    <td class="list-sub-low-box"></td>
                                    <td class="list-sub-low-box">{{ $stop[0] }}</td> <!-- Text [stop/stand] -->
                                    <td class="list-sub-low-box">{{ $stop[1] }}</td> <!-- Text [stop/stand] -->
                                    <td class="list-sub-low-box">{{ $stop[2] }}</td> <!-- Text [stop/stand] -->
                                    <td class="list-sub-low-box"></td>
                                    <td class="list-sub-low-box"></td>
                                </tr>
                            @empty
                                <tr class="list-sub-low-row">
                                    <td class="list-sub-low-box">Žiadne zastávky neboli nájdené</td>
                                </tr>
                            @endforelse
                        @endif
                    @else
                        {{-- hide --}}
                    @endif
                @endif
            @empty
                <tr class="list-low-row"> <!-- No User -->
                    <td class="list-low-box">Neexistuju žiadne trasy</td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
