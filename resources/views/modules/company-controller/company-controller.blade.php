@extends('layout')

@section('content')


<p style="margin: 1rem 2.5rem;" class="header-title">{{ ucwords(str_replace('-', ' ', Request::segment(1))) }}</p>
@livewire('component.module-contents.company-controller.company-controller-content')


@endsection