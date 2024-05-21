@extends('layout')
@section('content')
<p style="margin: 1rem 2.5rem;" class="header-title">{{ ucwords(str_replace('-', ' ', Request::segment(1))) }}</p>
<div class="date-container" style="margin: 0 2.5rem">
    <p class="date" id="Date" style="margin-bottom: 5px"></p>
</div>
@livewire('component.module-contents.dashboard.admin-attendance-statistics-component');

@endsection