<div>
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box" colspan="2">Meno trasy</th>
                <th class="list-up-box" colspan="2">Linka</th>
                <th class="list-up-box" colspan="1"></th>
            </tr>
        </thead>
        <tbody class="list-low-body"> 
            @forelse ($routes as $route)

            <!-- Edit Route -->
                @if ($editButton && $editValue === $route['meno_trasy'])
                    <tr class="list-low-row">
                        <td class="list-low-box" colspan="2">
                            <label for="meno_trasy" class="list-low-label">Meno trasy</label>
                            <input wire:model="meno_trasy"  type="text" name="meno_trasy" value="{{ $route['meno_trasy'] }}" class="list-low-input" required>
                        </td>
                        <td class=list-low-box colspan="2">
                            <label for="cislo_linky" class="list-low-label">Linka</label>
                            <select wire:model="cislo_linky" name="cislo_linky" class="list-low-select" required>
                                @foreach ($lines as $line)
                                    <option value="{{ $line->cislo_linky }}"> {{ $line->cislo_linky }} </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="list-low-box-buttons" colspan="1">
                            <button wire:click="routeSave('{{ $route['meno_trasy'] }}')" class="list-low-button">Uložiť</button>
                            <button wire:click="routeEdit('{{ $route['meno_trasy'] }}')" class="list-low-button">Naspäť</button>
                        </td>
                    </tr>

                    <!-- Sub-List-Edit-Route -->
                    <tr class="list-sub-low-row">
                        <td class="list-sub-low-box-bold" colspan="5"></td>
                    </tr>
                    <tr class="list-sub-low-row">
                        <td class="list-sub-low-box-bold"></td>
                        <td class="list-sub-low-box-bold">[Zastávka]</td>
                        <td class="list-sub-low-box-bold">[Dĺžka úseku] (km)</td>
                        <td class="list-sub-low-box-bold">[Čas úseku] (min)</td>
                        <td class="list-sub-low-box-bold"></td>
                    </tr>
                    @forelse ($sectionStop as $key => $stop)
                        <tr class="list-sub-low-row">
                            <td class="list-sub-low-box-bold"></td>
                            <td class="list-sub-low-box">
                                <select wire:model="sectionStop.{{ $key }}" type="text" name="zastavka" class="list-low-input" required>
                                    @foreach ($stops as $stopOption)
                                        <option value="{{ $stopOption->meno_zastavky }}">{{ $stopOption->meno_zastavky }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="list-sub-low-box">
                                <input wire:model="sectionLength.{{ $key }}" type="text" name="length" class="list-low-input" required>
                            </td>
                            <td class="list-sub-low-box">
                                <input wire:model="sectionTime.{{ $key }}" type="text" name="time" class="list-low-input" required>
                            </td>
                            <td class="list-sub-low-box">
                                <button type="text" wire:click="routeEditDelete({{ $key }})" class="list-low-button">Vymazať</button>
                            </td>
                            <td class="list-sub-low-box-bold"></td>
                        </tr>

                        @php    $maxKey = max(array_keys($sectionStop));    @endphp     <!-- Get max key from array -->
                        @if ($key == $maxKey)
                            <tr class="list-sub-low-row">
                                <td class="list-low-box-buttons" colspan="5">
                                    <button wire:click="routeEditAdd({{ $key }})" class="list-low-button" type="button">Pridať novú zastávku</button>
                                </td>
                            </tr>
                            <tr class="list-sub-low-row">
                                <td class="list-sub-low-box-bold" colspan="5"></td>
                            </tr>
                        @endif
                    @empty
                        <tr class="list-sub-low-row">
                            <td class="list-sub-low-box-buttons" colspan="5">
                                <button wire:click="routeEditAdd" class="list-low-button" type="button">Pridať novú zastávku</button>
                            </td>
                        </tr>
                    @endforelse
                    


            <!-- Show Route -->
                @else @if($showButton && $showValue === $route['meno_trasy'])
                    <tr class="list-low-row">
                        <td class="list-low-box" colspan="2">{{ $route['meno_trasy'] }}</td> <!-- Text [meno_trasy] -->
                        <td class="list-low-box" colspan="2">{{ $route['cislo_linky'] }}</td> <!-- Text [adresa_trasy] -->
                        <td class="list-low-box-buttons" colspan="1">
                            <button wire:click="routeShow('{{ $route['meno_trasy']}}')" class="list-low-button">Minimalizovať</button>
                        </td>
                    </tr>
                    <!-- Sub-List-Show-Route -->
                    <tr class="list-sub-low-row">
                        <td class="list-sub-low-box-bold"></td>
                        <td class="list-sub-low-box-bold">[Zastávka]</td>
                        <td class="list-sub-low-box-bold">[Dĺžka úseku]</td>
                        <td class="list-sub-low-box-bold">[Čas úseku]</td>
                        <td class="list-sub-low-box-bold"></td>
                    </tr>
                    @forelse ($route['zastavky'] as $stop)
                    <tr class="list-sub-low-row">
                        <td class="list-sub-low-box"></td>
                        <td class="list-sub-low-box">{{ $stop[0] }}</td>    <!-- Text [stop/stand] -->
                        <td class="list-sub-low-box">{{ $stop[1] }} km</td>    <!-- Text [stop/stand] -->
                        <td class="list-sub-low-box">{{ $stop[2] }} min.</td>    <!-- Text [stop/stand] -->
                        <td class="list-sub-low-box"></td>
                    </tr>
                    @empty
                        <tr class="list-sub-low-row">
                            <td class="list-sub-low-box">Žiadne zastávky neboli nájdené</td>
                        </tr>
                    @endforelse


            <!-- Default List Route -->
                @else
                    <tr class="list-low-row"> <!-- Show User -->
                        <td class="list-low-box" colspan="1">{{ $route['meno_trasy'] }}</td> <!-- Text [meno_trasy] -->
                        <td class="list-low-box" colspan="2">{{ $route['cislo_linky'] }}</td> <!-- Text [adresa_trasy] -->
                        <td class="list-low-box-buttons" colspan="2">
                            <button wire:click="routeShow('{{ $route['meno_trasy']}}')" class="list-low-button">Zobraziť</button>
                            <button wire:click="routeEdit('{{ $route['meno_trasy'] }}')" class="list-low-button">Upraviť</button>
                            <button wire:click="routeDelete('{{ $route['meno_trasy'] }}')" class="list-low-button">Vymazať</button>
                        </td>
                    </tr>

                @endif @endif
            @empty
                <tr class="list-low-row"> <!-- No User -->
                    <td class="list-low-box" colspan="4">V databáze nie sú žiadne spoje</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>