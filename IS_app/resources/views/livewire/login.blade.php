<div class="add-form-body">
    <div class="add-form-title">Informačný systém MD</div>
    <form wire:submit.prevent="login" class="add-form-submit">
        <div class="input-form-item">
            <label class="add-form-label" for="username">E-mail</label>
            <input class="add-form-input" type="text" wire:model="email" id="email" name="email" placeholder="Zadajte svoj e-mail" required>                
        </div>
        <div class="add-form-item">
            <label class="add-form-label" for="password">Heslo</label>
            <input class="add-form-input" type="password" wire:model="password" id="password" name="password" placeholder="Zadajte svoje heslo" required>
        </div>
        <div class="add-form-item">
            <button type="submit" class="add-form-button">Prihlásiť sa</button>
        </div>
    </form>
</div>