@extends('layout')
    <script src="{{ asset('plugins/sweetalert.js') }}"></script>
    @section('css')
    <link rel="stylesheet" href="{{ asset ('css/bootstrap-utilities/utilities.css') }}">
    @endsection
@section('content')
<section class="content">
    <div class='panel panel-default'>
        <div class='panel-heading'>
           Add Users
        </div>
        <div class='panel-body'>
            <form method='post' action='{{ @$user->u_id ? route("save-edit-user") : route("save-user") }}' id="submitForm">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="user_id" value="{{ @$user->u_id }}">
                <div class="row">
                    <div class="form-groups route_div">
                        <label for="email">{{trans('ad_lang.form-header.email')}} 
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="email" id="email" value='{{ @$user->email }}'>
                            @error('email')
                                <span style="color:red">{{$message}}</span>
                            @enderror
                        </label>
                    </div>
                    <div class="form-groups">
                        <label for="first-name">{{trans('ad_lang.user-info.first_name')}} 
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="first_name" id="first_name" value='{{ @$user->first_name }}'>
                            @error('first_name')
                                <span style="color:red">{{$message}}</span>
                            @enderror
                        </label>
                    </div>
                    <div class="form-groups">
                        <label for="middle-name">{{trans('ad_lang.user-info.middle_name')}} 
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="middle_name" id="middle_name" value='{{ @$user->midle_name }}'>
                            
                        </label>
                    </div>
                    <div class="form-groups">
                        <label for="last-name">{{trans('ad_lang.user-info.last_name')}} 
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="last_name" id="last_name" value='{{ @$user->last_name }}'>
                        </label>
                    </div>
                    <div class="form-groups">
                        <label for="employee-id">{{trans('ad_lang.user-info.employee_id')}} 
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="employee_id" id="employee_id" value='{{ @$user->employee_id }}'>
                        </label>
                    </div>
                    <div class="form-groups">
                        <label for="department">{{trans('ad_lang.user-info.department')}}</label><br>
                            <select selected data-placeholder="Choose Department" name='department' class='form-control select2' id="department" required style="width: 50%">
                                <option value=''></option>
                                @foreach($departments as $dept)
                                    <option {{ @$user->department_id == $dept->id ? 'selected' : '' }} value='{{$dept->id}}'>{{$dept->department_name}}</option>
                                @endforeach
                            </select>
                        @error('department')
                            <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-groups">
                        <label for="hire-date">{{trans('ad_lang.user-info.hire_date')}} 
                            <input type="date" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="hire_date" id="hire_date" value='{{ @$user->hire_date }}'>
                            @error('hire_date')
                            <span style="color:red">{{$message}}</span>
                        @enderror
                        </label>
                    </div>

                    <div class="form-groups">
                        <label for="position">{{trans('ad_lang.user-info.position')}} 
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="position" id="position" value='{{ @$user->position }}'>
                            @error('position')
                                <span style="color:red">{{$message}}</span>
                            @enderror
                        </label>
                    </div>
                 
                    <div class="form-groups">
                        <label for="last-name">{{trans('ad_default.Privileges')}}</label><br>
                            <select selected data-placeholder="Choose Privilege" name='privilege' class='form-control select2' id="privilege" required style="width: 50%">
                                <option value=''></option>
                                @foreach($privileges as $priv)
                                <option {{ @$user->id_ad_privileges == $priv->id ? 'selected' : '' }} value='{{$priv->id}}'>{{$priv->name}}</option>
                                @endforeach;
                            </select>
                            @error('privilege')
                                <span style="color:red">{{$message}}</span>
                            @enderror
                    </div>

                    <div class="form-groups">
                        <label for="last-name">{{trans('ad_lang.user-info.company')}}</label><br>
                            <select selected data-placeholder="Choose Company" name='company' class='form-control select2' id="company" required style="width: 50%">
                                <option value=''></option>
                                @foreach($companies as $comp)
                                <option {{ @$user->company_id == $comp->id ? 'selected' : '' }} value='{{$comp->id}}'>{{$comp->company_name}}</option>
                                @endforeach;
                            </select>
                            @error('company')
                                <span style="color:red">{{$message}}</span>
                            @enderror
                    </div>

                    <div class="form-groups">
                        <label for="last-name">{{trans('ad_lang.user-info.location')}}</label><br>
                            <select selected data-placeholder="Choose Location" name='location' class='form-control select2' id="location" required style="width: 50%">
                                <option value=''></option>
                                @foreach($locations as $loc)
                                    <option {{ @$user->hire_location_id == $loc->id ? 'selected' : '' }} value='{{$loc->id}}'>{{$loc->location_name}}</option>
                                @endforeach;
                            </select>
                            @error('location')
                                <span style="color:red">{{$message}}</span>
                            @enderror
                    </div>
                    @if(@$user->u_id)
                        <div class="form-groups">
                            <label for="status">{{trans('ad_lang.form-header.status')}}</label><br>
                                <select selected data-placeholder="Choose Location" name='status' class='form-control select2' id="status" required style="width: 50%">
                                    <option value=''></option>
                                    <option {{ @$user->status == 1 ? 'selected' : '' }} value='1'>Active</option>
                                    <option {{ @$user->status == 0 ? 'selected' : '' }} value='0'>Inactive</option>
                                </select>
                        </div>
                    @endif

                </div>
                <br>
                <div class='panel-footer'>
                    <button type='button' onclick="location.href='{{App\Helpers\CommonHelpers::mainpath()}}'"
                                    class='btn btn-default'>{{trans('ad_default.button_cancel')}}</button>
                    <button type='button' class='btn btn-primary' id="btnSubmit"><i class='fa fa-save'></i> {{trans('ad_default.button_save')}}</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        $('.select2').select2();

        $('#btnSubmit').on('click', function(event) {
            event.preventDefault();
            if($('#positions').val() === ''){
                Swal.fire({
                    type: 'error',
                    title: 'Position Required!',
                    icon: 'error',
                    confirmButtonColor: '#3c8dbc',
                });
                event.preventDefault();
                return false;
            }else if($('#path').val() === ''){
                Swal.fire({
                    type: 'error',
                    title: 'Path Required!',
                    icon: 'error',
                    confirmButtonColor: '#3c8dbc',
                });
                event.preventDefault();
                return false;
            }else if($('#icon').val() === ''){
                Swal.fire({
                    type: 'error',
                    title: 'Icon Required!',
                    icon: 'error',
                    confirmButtonColor: '#3c8dbc',
                });
                event.preventDefault();
                return false;
            }else if($('#route_type').val() === ''){
                Swal.fire({
                    type: 'error',
                    title: 'Route Type Required!',
                    icon: 'error',
                    confirmButtonColor: '#3c8dbc',
                });
                event.preventDefault();
                return false;
            }
            Swal.fire({
                title: 'Are you sure ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save',
                returnFocus: false,
                reverseButtons: true,
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#submitForm').submit();
                }
            });
            
        });
    </script>
@endsection