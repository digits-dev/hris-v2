@extends('layout')
    <script src="{{ asset('plugins/sweetalert.js') }}"></script>
    @section('css')
    <link rel="stylesheet" href="{{ asset ('css/bootstrap-utilities/utilities.css') }}">
    @endsection
@section('content')
<section class="content">
    @include('errors/messages')
    <div class='panel panel-default'>
        <div class='panel-heading'>
           Change Password
        </div>
        <form method="POST" action="{{ route('update_password') }}" id="submitForm">
            <div class='panel-body'>
                @csrf
                <div class="useraccounts_add_header">
                    <div class="change_account_password">Change Account Password?</div>
                    <div class="change_password_pic">
                        <img src="{{ asset('img/change_password.png') }}" alt="">
                    </div>
                    <div class="chang_password_description">If you wish to change the account password, kindly fill in the current password, new password, and re-type new password.</div>
                </div>
                <div class="useraccounts_add_body">
                    <div class="label_input">
                        <input type="password" name="current_password" required style="" placeholder="Current Password">
                    </div>
                    <div class="label_input">
                        <input type="password" name="new_password" required style="" placeholder="New Password">
                    </div>
                    <div class="label_input">
                        <input type="password" name="confirmation_password" required style=""placeholder="Confirm New Password">
                    </div>
                </div>
            </div>
            <div class='panel-footer'>
                <button type='button' onclick="location.href='{{App\Helpers\CommonHelpers::mainpath()}}'"
                                class='btn btn-default'>{{trans('ad_default.button_cancel')}}</button>
                <button type='button' class='btn btn-primary' id="btnSubmit"><i class='fa fa-save'></i> {{trans('ad_default.save_changes')}}</button>
            </div>
        </form>
    </div>
</section>
@endsection

@section('script')
    <script>
        const msg_type = "{{ session('message_type') }}";
        if (msg_type == 'success'){
            setTimeout(function(){
                window.location.href = "{{ route('logout') }}"
            }, 2000);
        }

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