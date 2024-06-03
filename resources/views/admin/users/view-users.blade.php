@extends('layout')
<link rel="stylesheet" href="{{ asset('css/section/table-section.css') }}">
@section('content')
    <section>
        <div class="main-container">
            <div class="date-container">
                <span class="font-bold">{{trans('ad_default.Users_Management')}}</span>
                <a href="{{ route('add-user') }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-1 dark:bg-green-700 dark:hover:bg-green-700 dark:focus:ring-green-800"> <i class="fa fa-circle-plus"></i> {{trans('ad_default.add_user')}}</a>
                <p class="date" id="Date"></p>
            </div>
        </div>

        <table class="table">
            <thead>
             <tr>
                <th>{{trans('ad_lang.form-header.name')}}</th>
                <th>{{trans('ad_lang.form-header.email')}}</th>
                <th>{{trans('ad_lang.form-header.privilege_name')}}</th>
                <th>{{trans('ad_lang.form-header.department')}}</th>
                <th class="text-center">{{trans('ad_lang.form-header.status')}}</th>
                <th class="text-center">{{trans('ad_default.action_label')}}</th>

             </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->privilege_name }}</td>
                        <td>{{ $user->department_name }}</td>
                        <td class="text-center">
                            <span class="status"
                            @style([$user->u_status ? 'background: var(--active-color)' : 'background: var(--inactive-color)'])>
                            {{ $user->u_status ? 'Active' : 'Inactive'}}
                            </span>
                        </td>

                        @if(App\Helpers\CommonHelpers::isUpdate())
                            <td ><a role="button" class="table-btn table-btn--green mx-auto" x-on:click="{{url(config('ad_url.ADMIN_PATH').'/users/edit-users')."/$user->id"}}"><i class="fa-solid fa-pencil"></i></a></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
    
    
        </table>
    </section>
@endsection