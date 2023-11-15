<div>
    <!-- Success message -->
    @if (session('list-success'))
        <div class="list-success">
            {{ session('list-success') }}
        </div>
    @else  
        <!-- Error message -->
        @if (session('list-error'))
            <div class="list-error">
                {{ session('list-error') }}
            </div>
        @else
        @endif
    @endif

    <!-- Table -->
    <table class="list-table">
        <thead class="list-up-body"> <!-- Table Header -->
            <tr class="list-up-row">
                <th class="list-up-box">Meno</th>
                <th class="list-up-box">Priezvisko</th>
                <th class="list-up-box">E-mail</th>
                <th class="list-up-box">Heslo</th>
                <th class="list-up-box">Roľa</th>
                <th class="list-up-box"></th>
            </tr>
        </thead>
        <tbody class="list-low-body"> <!-- Table Body -->
            @forelse ($users as $user)
                @if($editButton && ($editValue === $user['email']))
                    <tr class="list-low-row"> <!-- Edit User -->
                        <td class="list-low-box"> <!-- Input [FullName] -->
                            <input wire:model="firstName" type="text" name="firstName" value="{{ $user['firstName'] }}" class="list-low-input" required>
                        </td>
                        <td class="list-low-box"> <!-- Input [FullName] -->
                            <input wire:model="lastName" type="text" name="lastName" value="{{ $user['lastName'] }}" class="list-low-input" required>
                        </td>
                        <td class="list-low-box"> <!-- Input [Email] -->
                            <input wire:model="email" type="text" name="email" value="{{ $user['email'] }}" class="list-low-input" required>
                        </td>
                        <td class="list-low-box"> <!-- Input [Password] -->
                            <input wire:model="password" type="text" name="password" value="{{ $user['password'] }}" class="list-low-input" required>
                        </td>
                        <td class="list-low-box"> <!-- Input [Role] -->
                            <select wire:model="role" class="add-select" id="role" name="role" required>
                                <option value="administrátor">administrátor</option>
                                <option value="správca">správca</option>
                                <option value="dispečer">dispečer</option>
                                <option value="vodič">vodič</option>
                                <option value="technik">technik</option>
                            </select>
                        </td>
                        <td class="list-low-box"> <!-- Button [Save] -->
                            <button wire:click="userSave('{{ $user['email'] }}')" class="list-low-button">Uložiť</button>
                        </td>
                    </tr>
                @else
                    <tr class="list-low-row">   <!-- Show User -->
                        <td class="list-low-box">{{ $user['firstName'] }}</td> <!-- Text [firstName] -->
                        <td class="list-low-box">{{ $user['lastName'] }}</td> <!-- Text [lastName] -->
                        <td class="list-low-box">{{ $user['email'] }}</td>  <!-- Text [Email] -->
                        <td class="list-low-box">{{ $user['password'] }}</td> <!-- Text [Password] -->
                        <td class="list-low-box">{{ $user['role'] }}</td> <!-- Text [Role] -->
                        <td class="list-low-box"> <!-- Button [Edit] & Button [Delete] -->
                            <button wire:click="userEdit('{{ $user['email'] }}')" class="list-low-button">Upraviť</button>
                            <button wire:click="userDelete('{{ $user['email'] }}')" class="list-low-button">Vymaž</button>
                        </td>
                    </tr>
                @endif
            @empty
                <tr class="list-low-row">   <!-- No User -->
                    <td class="list-low-box">No existing user</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
