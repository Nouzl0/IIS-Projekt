<!-- navigation-header -->
<div>
    <!-- navigation-header -->
    <div class="navigation-header">

        <!-- Account information -->
        <div class='acount-information'>
            <button wire:click="re_home" class="icon-button">
                <img src="{{ asset('images/icon-home.svg') }}" alt="home button">
            </button>
            <section class='account-name'>
                <span>{{ session('userFirstName', 'guest') }} {{ session('userLastName', 'guest')}}</span>    <!-- should take name from database -->
            </section>
            <section class='account-role'>
                <span>({{ session('userRole', 'guest') }})</span>    <!-- should take role from database -->
            </section>
        </div>

        <!-- Navigation panel -->
        <div class="navigation-header-nav">

            <!-- Link buttons -->
            <button wire:click="re_assignVehicles" class="nav-button">Priradiť vozidlá</button>

            <!-- Logout button -->
            <button wire:click="logout" type="button" class="icon-button">
                <img src="{{ asset('images/icon-logout.svg') }}" alt="logout icon">
            </button>
        </div>
    </div>
    
</div>