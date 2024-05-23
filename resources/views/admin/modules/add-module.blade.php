@extends('layout')
    <script src="{{ asset('plugins/sweetalert.js') }}"></script>
    @section('css')
    <link rel="stylesheet" href="{{ asset ('css/bootstrap-utilities/utilities.css') }}">
    @endsection
@section('content')
<section class="content">
    <div class='panel panel-default'>
        <div class='panel-heading'>
           Edit Menus
        </div>
        <div class='panel-body'>
            <form method='post' action='{{ route("save-module") }}' id="submitForm">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="form-groups">
                        <label for="first-name">{{trans('ad_default.privileges_module_list_mod_names')}} 
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="name" id="name">
                        </label>
                    </div>
                    <div class="form-groups">
                        <label for="last-name">{{trans('ad_lang.form-header.path')}} 
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="path" id="path">
                        </label>
                    </div>
                    <div class="form-groups">
                        <label for="last-name">{{trans('ad_lang.form-header.icon')}} 
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="icon" id="icon">
                        </label>
                    </div>
                    <div class="form-groups">
                        <label for="last-name">{{trans('ad_lang.form-header.route_type')}}</label><br>
                            <select selected data-placeholder="Choose" name='route_type' class='form-control' id="route_type" required style="width: 50%">
                                <option value=''></option>
                                <?php
                                $skins = array(
                                    'URL',
                                    'Route'
                                ); ?>
                                @foreach($skins as $skin)
                                <option value='{{$skin}}'>{{$skin}}</option>
                                @endforeach;
                            </select>
                    </div>
                    <div class="form-groups route_div">
                        <label for="last-name">{{trans('ad_lang.form-header.controller')}} 
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" name="controller" id="controller">
                        </label>
                    </div>
                    <div class="form-groups route_div">
                        <label for="last-name">{{trans('ad_lang.form-header.type')}}</label><br>
                            <select selected data-placeholder="Choose" name='type' class='form-control' id="controller_type" required style="width: 50%">
                                <option value=''></option>
                                <?php
                                $skins = array(
                                    'Admin Controller',
                                    'Controller',
                                    'Livewire',
                                ); ?>
                                @foreach($skins as $skin)
                                <option value='{{$skin}}'>{{$skin}}</option>
                                @endforeach;
                            </select>
                    </div>
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
        $('#controller_type, #route_type').select2();

        $("#route_type").change(function() {
            const data = $(this).val();
            console.log(data);
            if(data === 'URL'){
                $(".route_div").hide();
                $("#controller").removeAttr('required');
                $("#controller_type").removeAttr('required');
            }else{
                $(".route_div").show();
            }
        });

        $('#btnSubmit').on('click', function(event) {
            event.preventDefault();
            if($('#name').val() === ''){
                Swal.fire({
                    type: 'error',
                    title: 'Module Name Required!',
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