<!DOCTYPE html>
<html lang="en">
<head>
    @livewire('plugins.frontend-header-plugins')
    @livewireStyles
    @yield('css')
    @vite(['resources/css/app.css'])
</head>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-session {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
<body>
    @livewire('component.navigation.sidebar')
    <div class="body-content" style="display: flex; flex-direction: column; flex: 1; overflow-x:hidden;">
        @livewire('component.navigation.navbar')
        @yield('content')
        <!-- resources/views/components/inactivity-modal.blade.php -->
        <div id="inactivityModal" class="modal" style="display:none; z-index:999999999">
            <div class="modal-session">
                {{-- <span class="close">&times;</span> --}}
                <p>You have been inactive for a while. You will be logged out in <span id="countdown">10</span> seconds if there is no activity.</p>
            </div>
        </div>
    </div>
    @livewire('plugins.frontend-script-plugins')
    @livewireScripts
    @yield('script')
    <!-- Add your scripts at the end of the body -->
    <script>
        let inactivityTime = function () {
            let time;
            const modal = $('#inactivityModal'); // Modal element
            const closeBtn = $('.close'); // Close button of the modal
            const countdownElement = $('#countdown');
    
            // Reset the timer on page load and user interactions
            $(window).on('load', resetTimer);
            $(document).on('mousemove', resetTimer);
            $(document).on('keypress', resetTimer);
    
            // Function to show the modal
            function showModal() {
                modal.show();
                let counter = 10; // 10 seconds countdown
                countdownElement.text(counter);
                countdown = setInterval(() => {
                    counter--;
                    countdownElement.text(counter);
                    if (counter <= 0) {
                        clearInterval(countdown);
                        logout();
                    }
                }, 1000);
            }
    
            // Function to hide the modal
            function hideModal() {
                modal.hide();
                clearInterval(countdown);
            }
    
            // Function to logout the user
            function logout() {
                window.location.href = '{{ route("logout") }}';
            }
    
            // Function to reset the timer
            function resetTimer() {
                hideModal();
                clearTimeout(time);
                time = setTimeout(showModal, 900000); // 5 minutes (300000 ms)
            }
    
            // Close modal on close button click
            closeBtn.on('click', function() {
                hideModal();
            });
    
            // Close modal when clicking outside of it
            $(window).on('click', function(event) {
                if ($(event.target).is(modal)) {
                    hideModal();
                }
            });
        };
    
        inactivityTime();

        function logout() {
            fetch('{{ route('logout') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
            }).then(response => {
                if (response.ok) {
                    window.location.href = '/login';
                }
            });
        }
    </script>
</body>
</html>