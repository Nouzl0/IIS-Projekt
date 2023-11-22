<div>
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">Linka</th>
                <th class="list-up-box">Názov trasy</th>
                <th class="list-up-box" colspan="2">Začiatok trasy</th>
                <th class="list-up-box">Opakovanie</th>
                <th class="list-up-box">Platné do</th>
                <th class="list-up-box">Priradený vodič</th>
                <th class="list-up-box"></th>
            </tr>
        </thead>
        <tbody class="list_low_body">
            @forelse ($scheduledRoutes as $scheduledRoute)
                @if ($editButton && ($editValue == $scheduledRoute['id']))
                    <tr class="list-low-row">
                        <td class=list-low-box colspan="2"> <!-- Input Link & Route -->
                            <select wire:model="scheduledRoute" class="add-select" id="scheduledRoute" name="scheduledRoute" required>
                                <option value=""></option>
                                @foreach ($linkRoutes as $linkRoute)
                                    <option value="{{ $linkRoute['routeId'] }}">{{ $linkRoute['linkName'] }} - {{ $linkRoute['routeName'] }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class=list-low-box> <!-- Input [scheduledDate] -->
                            <input wire:model="scheduledDate"  type="date" name="scheduledDate" class="list-low-input" required>
                        </td>
                        <td class=list-low-box> <!-- Input [scheduledTime] -->
                            <input wire:model="scheduledTime"  type="time" name="scheduledTime" class="list-low-input" required>
                        </td>
                        <td class="list-low-box"> <!-- Input [scheduledRepeat] -->
                            <select wire:model="scheduledRepeat" class="add-select" id="scheduledRepeat" name="scheduledRepeat" required>
                                <option value=""></option>
                                @foreach ($repeatTypes as $repeatType)
                                    <option value="{{ $repeatType }}">{{ $repeatType }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="list-low-box"> <!-- Input [scheduledValidUntil] -->
                            <input wire:model="scheduledValidUntil" type="date" name="scheduledValidUntil" class="list-low-input" required>
                        </td>
                        <!-- Display [technician] -->
                        <td class="list-low-box"> {{ $scheduledRoute['driver'] }} </td>         
                        <td class="list-low-box-buttons"> <!-- Button [Save] -->
                            <button wire:click="scheduleSave('{{ $scheduledRoute['id'] }}')" class="list-low-button">Uložiť</button>
                        </td>
                    </tr>
                @else
                    <tr class="list-low-row">
                        <td class="list-low-box"> {{ $scheduledRoute['link'] }} </td>
                        <td class="list-low-box"> {{ $scheduledRoute['name'] }} </td>
                        <td class="list-low-box" colspan="2"> {{ $scheduledRoute['start'] }} </td>
                        <td class="list-low-box"> {{ $scheduledRoute['repeat'] }} </td>
                        <td class="list-low-box"> {{ $scheduledRoute['validUntil'] }} </td>
                        <td class="list-low-box"> {{ $scheduledRoute['driver'] }} </td>

                        <td class="list-low-box-buttons"> <!-- Button [Edit] & [Delete] -->
                            <button wire:click="scheduleEdit('{{ $scheduledRoute['id'] }}')" class="list-low-button">Upraviť</button>
                            <button wire:click="scheduleDelete('{{ $scheduledRoute['id'] }}')" class="list-low-button">Vymazať</button>
                        </td>
                    </tr>
                @endif
            @empty
            <tr class="list-low-row">   <!-- No Schedules -->
                <td class="list-low-box">V databáze nie je žiaden naplánovaný spoj</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
