<!DOCTYPE html>
<html lang="en">
<head>
    @livewire('plugins.frontend-header-plugins')
    @yield('css')
    @vite(['resources/css/app.css'])
</head>
<body>
    @livewire('component.navigation.sidebar')
    <div class="body-content" style="display: flex; flex-direction: column; flex: 1;">
        @livewire('component.navigation.navbar')
        <p style="margin: 1rem 2.5rem;" class="header-title">{{ ucwords(str_replace('-', ' ', Request::segment(1))) }}</p>
        @yield('content')
    </div>
    @livewire('plugins.frontend-script-plugins')
    @livewireScripts
</body>
</html>