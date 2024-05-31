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
                <th>{{trans('ad_default.action_label')}}</th>
                <th>{{trans('ad_lang.form-header.name')}}</th>
                <th>{{trans('ad_lang.form-header.email')}}</th>
                <th>{{trans('ad_lang.form-header.privilege_name')}}</th>
                <th>{{trans('ad_lang.form-header.department')}}</th>
                <th>{{trans('ad_lang.form-header.status')}}</th>
             </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a class="" href="{{url(config('ad_url.ADMIN_PATH').'/users/edit-users')."/$user->id"}}"> <i class="fa fa-edit"></i> Edit</a></td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->privilege_name }}</td>
                        <td>{{ $user->department_name }}</td>
                        <td>{{ $user->u_status == 1 ? 'Active' : 'Inactive' }}</td>
                    </tr>
                @endforeach
            </tbody>
    
    
        </table>
    </section>
@endsection