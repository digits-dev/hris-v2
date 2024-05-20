@extends('layout')

@section('content')
    
    <p style="margin: 1rem 2.5rem;" class="header-title">Employee Logs</p>

    @livewire('component.module-contents.employee-attendance.employee-attendance-content')
@endsection