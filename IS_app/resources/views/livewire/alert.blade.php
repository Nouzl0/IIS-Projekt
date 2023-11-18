<div>
    <!-- Success message -->
    @if ($success == true)
        <div class="alert-success">
            {{ $successMessage }}
        </div>
    
    <!-- Error message -->
    @else 
        @if ($error == true)
            <div class="alert-error">
                {{ $errorMessage }}
            </div>   

    <!-- Empty window -->
    @else 
    
        @endif
    @endif
</div>
