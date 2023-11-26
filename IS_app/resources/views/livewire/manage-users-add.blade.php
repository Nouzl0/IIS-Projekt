<div>
    <!-- Form -->
    <form wire:submit.prevent="userAdd" class="add-form">    <!-- Add User -->
        <div class="add-container">
            <div class="add-item">
                <label class="add-label" for="firstName">Meno:</label>    <!-- Input [FirstName] -->
                <input wire:model="firstName" class="add-input" type="text" id="firstName" name="firstName" required>
            </div>
            <div class="add-item">
                <label class="add-label" for="lastName">Priezvisko:</label>      <!-- Input [LastName] -->
                <input wire:model="lastName" class="add-input" type="text" id="lastName" name="lastName" required>
            </div>
        </div>
        <div class="add-container">
            <div class="add-item">
                <label class="add-label" for="email">Email:</label>             <!-- Input [Email] -->
                <input wire:model="email" class="add-input" type="email" id="email" name="email" required>
            </div>
            <div class="add-item">
                <label class="add-label" for="password">Heslo:</label>       <!-- Input [Password] -->
                <input wire:model="password" class="add-input" type="password" id="password" name="password" required>
            </div>
        </div>
        <div class="add-container">
            <div class="add-item">
                <label class="add-label" for="role">Rola:</label>               <!-- Input [Role] -->
                <select wire:model="role" class="add-select" id="role" name="role" required>
                    <option value=""></option>
                    <option value="administrátor">administrátor</option>
                    <option value="správca">správca</option>
                    <option value="dispečer">dispečer</option>
                    <option value="vodič">vodič</option>
                    <option value="technik">technik</option>
                </select>
            </div>
            <div class="add-item">
                <button class="add-button" type="submit">Pridaj uživatela</button>
            </div>
        </div>
    </form>
</div>