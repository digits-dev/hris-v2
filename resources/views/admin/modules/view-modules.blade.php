@extends('layout')
<link rel="stylesheet" href="{{ asset('css/navigation/section.css') }}">
@section('content')
    <section>
        <div class="main-container">
            <div class="date-container">
                <span class="font-bold">{{trans('ad_default.Module_Generator')}}</span>
                <a href="{{ route('add-modules') }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-1 dark:bg-green-700 dark:hover:bg-green-700 dark:focus:ring-green-800"> <i class="fa fa-circle-plus"></i> {{trans('ad_default.Add_New_Module')}}</a>
                <p class="date" id="Date"></p>
            </div>
        </div>

        <table class="table">
            <thead>
             <tr>
                <th>{{trans('ad_default.action_label')}}</th>
                <th>{{trans('ad_lang.form-header.name')}}</th>
                <th>{{trans('ad_lang.form-header.path')}}</th>
                <th>{{trans('ad_lang.form-header.controller')}}</th>
                <th>{{trans('ad_lang.form-header.status')}}</th>
             </tr>
            </thead>

            <tbody>
                @foreach ($modules as $module)
                    <tr>
                        <td><a class="" href="{{url(config('ad_url.ADMIN_PATH').'/users/edit-users')."/$module->id"}}"> <i class="fa fa-edit"></i> Edit</a></td>
                        <td>{{ $module->name }}</td>
                        <td>{{ $module->path }}</td>
                        <td>{{ $module->controller }}</td>
                        <td>{{ $module->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                    </tr>
                @endforeach
            </tbody>
    
    
        </table>
    </section>
@endsection