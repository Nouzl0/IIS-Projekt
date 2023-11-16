<div>
    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">Začiatok trasy</th>
                <th class="list-up-box">Meno trasy</th>
                <th class="list-up-box">Vozidlo</th>
                <th class="list-up-box">Priradil</th>
            </tr>
        </thead>
        <tbody class="list-low-body"> <!-- Table Body -->
            @forelse ($plans as $plan)
                <tr class="list-low-row"> <!-- Show User -->
                    <td class="list-low-box">{{ $plan['beginning'] }}</td> <!-- Text [firstName] -->
                    <td class="list-low-box">{{ $plan['rout'] }}</td> <!-- Text [lastName] -->
                    <td class="list-low-box">{{ $plan['vehicle'] }}</td> <!-- Text [Email] -->
                    <td class="list-low-box">{{ $plan['assigned'] }}</td> <!-- Text [Password] -->
                </tr>
            @empty
                <tr class="list-low-row"> <!-- No User -->
                    <td class="list-low-box">Máš volno kolega</td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                    <td class="list-low-box"></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    

