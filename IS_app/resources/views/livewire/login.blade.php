<div class="login-container">
            <h2>Login</h2>
            <form wire:submit.prevent="login">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" wire:model="username" id="username" name="username" placeholder="Enter your username" required>                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" wire:model="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>

            @if (session()->has('message'))
                <p>{{ session('message') }}</p>
            @endif
</div>