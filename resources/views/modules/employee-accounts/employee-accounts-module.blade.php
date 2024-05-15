@extends('layout')



@section('content')


    @switch($routeName)
        @case('index')
<p style="margin: 1rem 2.5rem;" class="header-title">{{ ucwords(str_replace('-', ' ', Request::segment(1))) }}</p>
        @livewire('component.module-contents.employee-accounts.employee-accounts-content')
            
            @break
        @case('create')
<p style="margin: 1rem 2.5rem;" class="header-title">Add User</p>

        @livewire('component.module-contents.employee-accounts.create')
            
            @break
        @default
    @endswitch
@endsection