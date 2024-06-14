@extends('layout')
<script src="{{ asset('plugins/sweetalert.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/section/table-section.css') }}">
<link rel="stylesheet" href="{{ asset ('css/bootstrap-utilities/utilities.css') }}">
@section('css')
    <style>
        .dropbtn {
            color: #333;
            background-color: #fff;
            border-color: #ccc;
            padding: 10px;
            font-size: 13px;
            cursor: pointer;
            border-radius: 5px;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: #f8f6f6;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content span {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown span:hover {background-color: #ddd;}

        .show {display: block;}
    </style>
@endsection
@section('content')
    <section>
        <div class="main-container">
            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
            <p class="header-title">{{trans('ad_default.Users_Management')}}</p>

            <a href="{{ route('add-user') }}" class="primary-btn mt-10 inline-block">{{trans('ad_default.add_user')}}</a>
    
            <div class="dropdown">
                <button onclick="myFunction()" class="btn-default dropbtn"> <i class="fa fa-check-square"></i> Bulk Action</button>
                <div id="myDropdown" class="dropdown-content">
                    <span value="1"> <i class="fa fa-check-circle"></i> Set Active</span>
                    <span value="0"> <i class="fa fa-times-circle"></i> Set Inactive</span>
                </div>
            </div>

            <table class="table">
            <thead>
             <tr>
                <th class="checkbox-col"><input type="checkbox" id="check_all"></th>
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
                        <td><input type="checkbox" name="users_id[]" class="checkboxid" value="{{$user->u_id}}"></td>
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
                            <td ><a class="table-btn table-btn--green mx-auto" href="{{url(config('ad_url.ADMIN_PATH').'/users/edit-user')."/$user->u_id"}}"><i class="fa-solid fa-pencil"></i></a></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
    
    
            </table>
        </div>

    </section>
@endsection

@section('script')
<script type="text/javascript">
    $('#check_all').change(function() {
        if(this.checked) {
            $(".checkboxid").prop("checked", true);
        }
        else{
            $(".checkboxid").prop("checked", false);
        }
    });

    $(document).ready(function(){
        $(window).click(function(event) {
            if (!$(event.target).hasClass('dropbtn')) {
                $('.dropdown-content').removeClass('show');
            }
        });
    });

    $('#myDropdown span').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        var selectedValue = $(this).attr('value');
        var Ids = [];
        $.each($("input[name='users_id[]']:checked"), function(){
            Ids.push($(this).val());
      
        });

        var check = $('input:checkbox:checked').length - 1;
        console.log(check);
        if (check == 0) {
            Swal.fire({
                type: 'error',
                title: 'Nothing selected!',
                icon: 'error',
                confirmButtonColor: '#367fa9',
            }); 
            event.preventDefault(); // cancel default behavior
        }else{
            Swal.fire({
                title: 'Confirm Transaction',
                text: 'Are you sure you want to continue this transaction?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                returnFocus: false,
                reverseButtons: true,
                showLoaderOnConfirm: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("set-status") }}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            'Ids': Ids,
                            'bulk_action_type': selectedValue
                        },
                    success: function (data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    type: data.status,
                                    title: data.msg,
                                    confirmButtonColor: '#3085d6',
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                    Swal.fire({
                                    icon: 'error',
                                    type: data.status,
                                    title: data.msg,
                                    confirmButtonColor: '#3085d6',
                                }).then((result) => {
                                    location.reload();
                                });
                            };
                        }
                        
                    }); 
                    Swal.fire({
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        title: "Please wait while saving...",
                        didOpen: () => Swal.showLoading()
                    });
                }
            });
        }
    });

    function myFunction() {
        $("#myDropdown").toggleClass("show");
    }
</script>
@endsection