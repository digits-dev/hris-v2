@extends("layout")
@section("content")
    <p style="margin: 1rem 2.5rem;" class="header-title">{{ ucwords(str_replace('-', ' ', Request::segment(1))) }} - Summary</p>

    @livewire('component.module-contents.employee-attendance.employee-attendance-content')
@endsection