<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HRIS</title>
    <link rel="stylesheet" href="{{ asset('css/navigation/layout.css') }}">
</head>
<body>
    @livewire('component.navigation.sidebar')
    <div class="body-content" style="display: flex; flex-direction: column; flex: 1;">
        @livewire('component.navigation.navbar')
        <p style="margin: 1rem 2.5rem;" class="header-title">{{ ucwords(str_replace('-', ' ', Request::segment(1))) }}</p>
        @yield('content')
    </div>

    @livewireScripts
</body>
</html>