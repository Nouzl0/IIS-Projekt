<div>
    <!-- navigation-header -->
    <div class="navigation-header">

        <!-- Account information -->
        <div class='acount-information'>
            <button wire:click="re_home" class="icon-button">
                <img src="{{ asset('images/icon-home.svg') }}" alt="home button">
            </button>
            <section class='account-name'>
                <span>{{ session('userFirstName', 'guest') }}</span>    <!-- should take name from database -->
            </section>
            <section class='account-role'>
                <span>({{ session('userRole', 'guest') }})</span>    <!-- should take role from database -->
            </section>
        </div>

        <!-- Navigation panel -->
        <div class="navigation-header-nav">

            <!-- Link buttons -->
            <button wire:click="re_manageUsers" class="nav-button">Spravovať užívateľov</button>
            <button wire:click="toggleContent" class="nav-button">Ostatné možnosti</button>

            <!-- Logout button -->
            <button wire:click="logout" type="button" class="icon-button">
                <img src="{{ asset('images/icon-logout.svg') }}" alt="logout icon">
            </button>
        </div>
    </div>
    
    <!-- more-navigation -->
    @if($showMoreNav)
        <div class="more-navigation">
            <button wire:click="re_assignedPlan" class="nav-button">Priradený plán (vodič)</button>
            <button wire:click="re_reportIssue" class="nav-button">Nahlásiť závadu (vodič)</button>
            <button wire:click="re_assignVehicles" class="nav-button">Priradiť vozidlá (dispečer)</button>
            <button wire:click='re_recordMaintenance' class="nav-button">Vytvoriť záznam o údržbe (technik)</button>
            <button wire:click="re_manageLinks" class="nav-button">Spravovať spoje (správca)</button>
            <button wire:click="re_scheduleRoutes" class="nav-button">Vytvoriť plánovaný spoj (správca)</button>
            <button wire:click="re_manageVehicles" class="nav-button">Spravovať vozidlá (správca)</button>
            <button wire:click='re_organizeMaintenance' class="nav-button">Organizovať údržbu (správca)</button>
        </div>
    @endif 
</div>