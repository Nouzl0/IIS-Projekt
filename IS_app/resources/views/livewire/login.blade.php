<div class="login-container">
            <h2>Login</h2>
            <form wire:submit.prevent="login">
                <div class="input-group">
                    <label for="username">E-mail</label>
                    <input type="text" wire:model="email" id="email" name="email" placeholder="Zadajte svoj e-mail" required>                
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" wire:model="password" id="password" name="password" placeholder="Zadajte svoje heslo" required>
                </div>
                <button type="submit" class="login-button">Prihlásiť sa</button>
            </form>

            @if (session()->has('message'))
                <p>{{ session('message') }}</p>
            @endif
</div>