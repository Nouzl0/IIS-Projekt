<div>
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">Začiatok trasy</th>
                <th class="list-up-box">Číslo linky</th>
                <th class="list-up-box">Smer trasy</th>
                <th class="list-up-box">Priradené vozidlo</th>
            </tr>
        </thead>
        <tbody class="list-low-body"> <!-- Table Body -->
            @forelse ($plans as $plan)
                <tr class="list-low-row"> <!-- Show User -->
                    <td class="list-low-box">{{ $plan['zaciatok'] }}</td> <!-- Text [firstName] -->
                    <td class="list-low-box">{{ $plan['cislo_linky'] }}</td> <!-- Text [firstName] -->
                    <td class="list-low-box">{{ $plan['meno_trasy'] }}</td> <!-- Text [lastName] -->
                    <td class="list-low-box">{{ $plan['vozidlo_spz'] }} - {{ $plan['vozidlo_nazov'] }} - {{ $plan['vozidlo_druh_vozidla'] }}</td> <!-- Text [Email] -->
                </tr>
            @empty
                <tr class="list-low-row"> <!-- No User -->
                    <td class="list-low-box">Nemáte priradené žiadne spoje</td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    

