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
                                wire:model="meno_trasy" class="list-low-input">
                        </td>
                        <td class="list-low-box">
                            <input type="text" name="info_trasy" value="{{ $route['info_trasy'] }}"
                                wire:model="info_trasy" class="list-low-input">
                        </td>
                        <td class=list-low-box>

                            <select name="cislo_linky" wire:model="cislo_linky" class="list-low-input">
                                <option value=""></option>
                                @foreach ($lines as $line)
                                    <option value="{{ $line->cislo_linky }}"> {{ $line->cislo_linky }} </option>
                                @endforeach
                            </select>
                        </td>

                        <td class=list-low-box>
                            <button wire:click="routeSave('{{ $route['meno_trasy'] }}')"
                                class="list-low-button">Uložiť</button>


                            <button wire:click="routeDelete('{{ $route['meno_trasy'] }}')"
                                class="list-low-button">Vymazať</button>
                        </td>
                    </tr>

                    <thead>
                        <tr>
                            <th></th>
                            <th>Zastávka</th>
                            <th>Dĺžka úseku[km]</th>
                            <th>Čas úseku[min]</th>
                        </tr>
                    </thead>

                    @forelse ($route['zastavky'] as $stop)
                        <tr class="list-sub-low-row">
                            <td class="list-sub-low-box"></td>
                            <td class="list-sub-low-box">
                                <input wire:model="sectionStop.{{ $stop[3] }}" type="text" name="zastavka"
                                    class="list-low-input">
                                {{-- <div>
                                    <label for="sectionStop.{{ $stop[3] }}" class="add-label">Meno zastávky</label>
                                    <select wire:model="sectionStop.{{ $stop[3] }}" class="add-input"
                                        name="sectionStop.{{ $stop[3] }}" >
                                        @foreach ($stops as $stop)
                                            <option value="{{ $stop->meno_zastavky }}">{{ $stop->meno_zastavky }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}

                            </td> <!-- Text [stop/stand] -->
                            <td class="list-sub-low-box">
                                <div>
                                    <label for="sectionLength.{{ $stop[3] }}" class="add-label">Dĺžka
                                        úseku[km]</label>
                                    <select wire:model="sectionLength.{{ $stop[3] }}"
                                        id="sectionLength.{{ $stop[3] }}" class="add-input">
                                        @foreach ($numRange as $number)
                                            <option value="{{ $number }}">{{ $number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <input wire:model="sectionLength.{{ $stop[3] }}" type="text" name="zastavka"
                                    class="input_edit_form"> --}}
                            </td> <!-- Text [stop/stand] -->
                            <td class="list-sub-low-box">
                                <div>
                                    <label for="sectionTime.{{ $stop[3] }}" class="add-label">Čas
                                        úseku[min]</label>
                                    <select wire:model="sectionTime.{{ $stop[3] }}"
                                        id="sectionTime.{{ $stop[3] }}" class="add-input">
                                        @foreach ($numRange as $number)
                                            <option value="{{ $number }}">{{ $number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <input wire:model="sectionTime.{{ $stop[3] }}" type="text" name="zastavka"
                                    class="input_edit_form"> --}}
                            </td> <!-- Text [stop/stand] -->
                            <td class="list-sub-low-box">
                            </td>
                            <td class="list-sub-low-box"></td>

                        </tr>

                    @empty
                        <tr class="list-sub-low-row">
                            <td class="list-sub-low-box">Žiadne zastávky neboli nájdené</td>
                        </tr>
                    @endforelse


                    <div>
                        <tr>

                            <td></td>
                            {{-- <input type="text" wire:model="zastavka.0" placeholder="Zastavka"> --}}
                            <td>
                                <div>
                                    <label for="zastavka.0" class="add-label">Meno zastávky</label>
                                    <select wire:model="zastavka.0" id="zastavka.0" class="add-input" name="zastavka.0" required>
                                        <option value=""></option>
                                        @foreach ($stops as $stop)
                                            <option value="{{ $stop->meno_zastavky }}">{{ $stop->meno_zastavky }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </select>
                            </td>
                            <td>
                                <div>
                                    <label for="dlzka.0" class="add-label">Dĺžka úseku[km]</label>
                                    <select wire:model="dlzka.0" id="dlzka.0" class="add-input">
                                        @foreach ($numRange as $number)
                                            <option value="{{ $number }}">{{ $number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <label for="cas.0" class="add-label">Čas úseku[min]</label>
                                    <select wire:model="cas.0" id="cas.0" class="add-input">
                                        @foreach ($numRange as $number)
                                            <option value="{{ $number }}">{{ $number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <button type="text" wire:click="add({{ $i }})" class="list-low-button">Pridať zástavku</button>
                            </td>
                        </tr>
                    </div>

                    {{-- ass stop --}}



                    @foreach ($inputs as $key => $value)
                        <div>
                            <tr>
                                <td></td>
                                <td>
                                    <div>
                                        <label for="zastavka.{{ $value }}" class="add-label">Meno zastávky</label>
                                        <select wire:model="zastavka.{{ $value }}" id="zastavka.{{ $value }}"
                                            class="add-input" name="zastavka.{{ $value }}" required>
                                            <option value=""></option>
                                            @foreach ($stops as $stop)
                                                <option value="{{ $stop->meno_zastavky }}">{{ $stop->meno_zastavky }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <label for="dlzka.{{ $value }}" class="add-label">Dĺžka úseku[km]</label>
                                        <select wire:model="dlzka.{{ $value }}" id="dlzka.{{ $value }}"
                                            class="add-input">
                                            @foreach ($numRange as $number)
                                                <option value="{{ $number }}">{{ $number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <label for="cas.{{ $value }}" class="add-label">Čas úseku[min]</label>
                                        <select wire:model="cas.{{ $value }}" id="cas.{{ $value }}" class="add-input">
                                            @foreach ($numRange as $number)
                                                <option value="{{ $number }}">{{ $number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <button type="text" wire:click="remove({{ $key }}" class="list-low-button">Vymaž</button>
                                </td>
                            </tr>
                        </div>
                    @endforeach
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
                                {{-- <th> <button class="list-low-button"
                                            wire:click="stopInRouteEdit('{{ $route['meno_trasy'] }}')">Upravit</button>
                                    </th> --}}
                            </tr>
                        </thead>
                        @if ($editButton && $editValue === $route['meno_trasy'])
                            @forelse ($route['zastavky'] as $values)
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
                                    <td class="list-sub-low-box">{{ $stop[0] }}</td>
                                    <!-- Text [stop/stand] -->
                                    <td class="list-sub-low-box">{{ $stop[1] }}</td>
                                    <!-- Text [stop/stand] -->
                                    <td class="list-sub-low-box">{{ $stop[2] }}</td>
                                    <!-- Text [stop/stand] -->
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
