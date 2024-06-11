@extends('layout')
<link rel="stylesheet" href="{{ asset('css/section/table-section.css') }}">
@section('content')
    <section>
        <div class="main-container">
        
            <p class="header-title">{{trans('ad_default.Module_Generator')}}</p>

            <a href="{{ route('add-modules') }}" class="primary-btn mt-10 inline-block">{{trans('ad_default.Add_New_Module')}}</a>
    

            <table class="table">
            <thead>
             <tr>
                <th>{{trans('ad_default.action_label')}}</th>
                <th>{{trans('ad_lang.form-header.name')}}</th>
                <th>{{trans('ad_lang.form-header.path')}}</th>
                <th class="text-center">{{trans('ad_lang.form-header.controller')}}</th>
                <th class="text-center">{{trans('ad_lang.form-header.status')}}</th>
             </tr>
            </thead>

            <tbody>
                @foreach ($modules as $module)
                    <tr>
                        <td>{{ $module->name }}</td>
                        <td>{{ $module->path }}</td>
                        <td>{{ $module->controller }}</td>
                        <td class="text-center">
                            <span class="status"
                            @style([$module->is_active ? 'background: var(--active-color)' : 'background: var(--inactive-color)'])>
                            {{ $module->is_active ? 'Active' : 'Inactive'}}
                            </span>
                        </td>

                        @if(App\Helpers\CommonHelpers::isUpdate())
                            <td ><a class="table-btn table-btn--green mx-auto"  href="{{url(config('ad_url.ADMIN_PATH').'/users/edit-users')."/$module->id"}}"><i class="fa-solid fa-pencil"></i></a></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
    
    
            </table>
        </div>

    </section>
@endsection