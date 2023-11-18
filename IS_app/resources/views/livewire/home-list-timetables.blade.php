<div>
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">Číslo linky</th>
                <th class="list-up-box">Zastávky</th>
            </tr>
        </thead>
        <tbody class="list-low-body"> <!-- Table Body -->
            @forelse ($formattedTimetables as $lineNumber => $stops)
                <tr class="list-low-row">   <!-- Show Links -->
                    <td class="list-low-box">{{ $lineNumber }}</td> <!-- LineNumber -->
                    <td class="list-low-box">{{ $stops }}</td> <!-- Text Stops -->
                </tr>
            @empty
                <tr class="list-low-row">   <!-- No data -->
                    <td class="list-low-box">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
