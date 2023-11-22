<div>
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">Priradený vodič</th>
                <th class="list-up-box">Priradené vozidlo</th>
                <th class="list-up-box">Linka</th>
                <th class="list-up-box">Názov trasy</th>
                <th class="list-up-box">Začiatok trasy</th>
                <th class="list-up-box">Opakovanie</th>
                <th class="list-up-box">Platné do</th>
                <th class="list-up-box"></th>
            </tr>
        </thead>
        <tbody class="list_low_body">
            @forelse ($scheduledRoutes as $scheduledRoute)
                @if ($editButton && ($editValue == $scheduledRoute['id']))
                    <tr class="list-low-row">
                        <td class="list-low-box"> <!-- Input [scheduledDriver] -->
                            <select wire:model="scheduledDriver" class="list-low-select" id="scheduledDriver" name="scheduledDriver" required>
                                <option value=""></option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver['id'] }}">{{ $driver['firstName'] }} {{ $driver['lastName'] }} - ({{ $driver['email'] }})</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="list-low-box"> <!-- Input [scheduledVehicle] -->
                            <select wire:model="scheduledVehicle" class="list-low-select" id="scheduledVehicle" name="scheduledVehicle" required>
                                <option value=""></option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle['id'] }}">{{ $vehicle['spz'] }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="list-low-box"> {{ $scheduledRoute['link'] }} </td>
                        <td class="list-low-box"> {{ $scheduledRoute['name'] }} </td>
                        <td class="list-low-box">{{ $scheduledRoute['start'] }} </td>
                        <td class="list-low-box"> {{ $scheduledRoute['repeat'] }} </td>
                        <td class="list-low-box"> {{ $scheduledRoute['validUntil'] }} </td>
                        <td class="list-low-box-buttons"> <!-- Button [Save] -->
                            <button wire:click="assignSave('{{ $scheduledRoute['id'] }}')" class="list-low-button">Uložiť</button>
                        </td>
                    </tr>
                @else
                    <tr class="list-low-row">
                        <td class="list-low-box"> {{ $scheduledRoute['driver'] }} </td>
                        <td class="list-low-box"> {{ $scheduledRoute['vehicle'] }} </td>
                        <td class="list-low-box"> {{ $scheduledRoute['link'] }} </td>
                        <td class="list-low-box"> {{ $scheduledRoute['name'] }} </td>
                        <td class="list-low-box">{{ $scheduledRoute['start'] }} </td>
                        <td class="list-low-box"> {{ $scheduledRoute['repeat'] }} </td>
                        <td class="list-low-box"> {{ $scheduledRoute['validUntil'] }} </td>

                        <td class="list-low-box-buttons"> <!-- Button [Edit] -->
                            <button wire:click="assignEdit('{{ $scheduledRoute['id'] }}')" class="list-low-button">Upraviť</button>
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
