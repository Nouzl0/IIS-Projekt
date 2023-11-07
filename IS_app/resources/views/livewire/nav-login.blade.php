<div>
    <!-- navigation-header -->
    <div class="navigation-header">

        <!-- Account information -->
        <div class='acount-information'>

            <!-- Home button -->
            <button wire:click="re_home" class="icon-button">
                <img src="{{ asset('images/icon-home.svg') }}" alt="home button">
            </button>

            <!-- Login button -->
            <button wire:click="re_login" class="login-button">
                <img src="{{ asset('images/icon-profile.svg') }}" alt="login icon">
                <span>Prihlásiť sa</span>
            </button>
        </div>
    </div>
</div>