@extends('layout')
<link rel="stylesheet" href="{{ asset('css/section/table-section.css') }}">
@section('content')
    <section>
        <div class="main-container">

            <p class="header-title">{{trans('ad_default.Users_Management')}}</p>

            <a href="{{ route('add-user') }}" class="primary-btn mt-10 inline-block">{{trans('ad_default.add_user')}}</a>
    

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
                            <td ><a class="table-btn table-btn--green mx-auto" href="{{url(config('ad_url.ADMIN_PATH').'/users/edit-users')."/$user->id"}}"><i class="fa-solid fa-pencil"></i></a></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
    
    
            </table>
        </div>

    </section>
@endsection