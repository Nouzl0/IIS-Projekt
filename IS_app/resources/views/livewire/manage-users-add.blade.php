<div>
    <!-- Success message -->
    @if (session('add-success'))
        <div class="add-success">
            {{ session('add-success') }}
        </div>
    @else  
        <!-- Error message -->
        @if (session('add-error'))
            <div class="add-error">
                {{ session('add-error') }}
            </div>
        @else
        @endif
    @endif
    
    <!-- Form -->
    <form wire:submit.prevent="userAdd" class="add-form">    <!-- Add User -->

        <div class="add-container">
            <label class="add-label" for="firstName">First Name:</label>    <!-- Input [FirstName] -->
            <input wire:model="firstName" class="add-input" type="text" id="firstName" name="firstName" required>

            <label class="add-label" for="lastName">Last Name:</label>      <!-- Input [LastName] -->
            <input wire:model="lastName" class="add-input" type="text" id="lastName" name="lastName" required>
            
            <label class="add-label" for="email">Email:</label>             <!-- Input [Email] -->
            <input wire:model="email" class="add-input" type="email" id="email" name="email" required>
        </div>

        <div class="add-container">
            <label class="add-label" for="password">Password:</label>       <!-- Input [Password] -->
            <input wire:model="password" class="add-input" type="password" id="password" name="password" required>
        
            <label class="add-label" for="role">Role:</label>               <!-- Input [Role] -->
            <select wire:model="role" class="add-select" id="role" name="role" required>
                <option value="administrátor">administrátor</option>
                <option value="správca">správca</option>
                <option value="dispečer">dispečer</option>
                <option value="vodič">vodič</option>
                <option value="technik">technik</option>
            </select>
        </div>

        <div class="add-container"> <!-- Submit Button -->
            <button wire:click="userAdd" class="add-button" type="submit">Add User</button>
        </div>
    </form>
</div>