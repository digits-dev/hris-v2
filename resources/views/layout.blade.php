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
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }
        .modal-session {
            -webkit-user-select: none; /* Safari */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* IE 10+ */
            user-select: none; /* Standard syntax */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 60px;
            z-index: 10000;
        }

        .session-modal-content{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 15px;
        }

        .modal-image{
            object-fit: contain;
            width: 100%;
            max-width: 150px;
            pointer-events: none;
            margin-bottom: 10px;
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
                <div class="session-modal-content">
                    <img src="{{asset('images/others/session-expire-logo.png')}}" alt="" class="modal-image">
                    <p class="mb-5">You have been inactive for a while</p>
                    <p>You will be logged out in <span id="countdown" class="font-semibold">10</span> <span class="font-semibold">seconds</span> if there is no activity.</p>
                </div>
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
                time = setTimeout(showModal, 1000 * 60 * 15); // 15 minutes
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