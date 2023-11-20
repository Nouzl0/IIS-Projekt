<!-- Don't delete the div !!!! Empty window -->
<div>
</div>

<!-- Javascript containing the inactivity timer -->
@if (session('userRole') !== 'guest')
    <script>
        function startInactivityTimer() {
            let timeout;

            function resetTimer() {
                console.log('Timer was reset'); // debug in browser
                clearTimeout(timeout);      //reset the timer
                timeout = setTimeout(() => { @this.dispatch('logoutUser'); }, 300000); // 300000 ms = 5 minutes, 10000 ms = 10 seconds, set the timeout and when the time runs out dispatch 'logoutUser' event which is handled in Timeout.php
            }

            window.onload = resetTimer;
            document.onmousemove = resetTimer;
            document.onkeypress = resetTimer;
        }
        startInactivityTimer();
    </script>
@endif