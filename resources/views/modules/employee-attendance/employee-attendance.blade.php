@extends("layout")
@section("content")


    @switch($routeName)
    @case('index')
        <p style="margin: 1rem 2.5rem;" class="header-title">{{ ucwords(str_replace('-', ' ', Request::segment(1))) }} - Summary</p>
        @livewire('component.module-contents.employee-attendance.employee-attendance-content')
    @break

    @case('show')
<<<<<<< HEAD
        <p style="margin: 1rem 2.5rem;" class="header-title">{{ ucwords(str_replace('-', ' ', Request::segment(1))) }} - Summary</p>
        @livewire('component.module-contents.employee-attendance.show', ['employeeId' => $employeeId])
=======
    <p style="margin: 1rem 2.5rem;" class="header-title">{{ ucwords(str_replace('-', ' ', Request::segment(1))) }} - Summary</p>
    @livewire('component.module-contents.employee-attendance.show', ['employeeId' => $employeeId, 'dateClockedIn'=>$dateClockedIn])
>>>>>>> 002e0652f4c3ae604d9752d5568c05571c2f9bfe
    @break

    @default
@endswitch
@endsection