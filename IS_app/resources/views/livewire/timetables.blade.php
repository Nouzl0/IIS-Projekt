<div>
    <h3>Cestovné poriadky</h3>

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Číslo linky</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Zastávky</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($formattedTimetables as $lineNumber => $stops)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{ $lineNumber }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">{{ $stops }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 8px; text-align: center;">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
