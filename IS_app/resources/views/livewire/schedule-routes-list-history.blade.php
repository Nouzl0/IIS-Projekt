<div>
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">Linka</th>
                <th class="list-up-box">Názov trasy</th>
                <th class="list-up-box">Začiatok trasy</th>
                <th class="list-up-box">Opakovanie</th>
                <th class="list-up-box">Platné do</th>
                <th class="list-up-box">Priradený vodič</th>
                <th class="list-up-box"></th>
            </tr>
        </thead>
        <tbody class="list_low_body">
            @forelse ($scheduledRoutes as $scheduledRoute)
                <tr class="list-low-row">
                    <td class="list-low-box"> {{ $scheduledRoute['link'] }} </td>
                    <td class="list-low-box"> {{ $scheduledRoute['name'] }} </td>
                    <td class="list-low-box"> {{ $scheduledRoute['start'] }} </td>
                    <td class="list-low-box"> {{ $scheduledRoute['repeat'] }} </td>
                    <td class="list-low-box"> {{ $scheduledRoute['validUntil'] }} </td>
                    <td class="list-low-box"> {{ $scheduledRoute['driver'] }} </td>

                    <td class="list-low-box-buttons"> <!-- Button [Delete] -->
                        <button wire:click="scheduledRoutesDeleteExpired('{{ $scheduledRoute['id'] }}')" class="list-low-button">Vymazať</button>
                    </td>
                </tr>
            @empty
            <tr class="list-low-row">   <!-- No Vehicle -->
                <td class="list-low-box">V databáze nie je žiaden dokončený plánovaný spoj</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
