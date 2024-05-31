@extends('layout')
    <script src="{{ asset('plugins/sweetalert.js') }}"></script>
    @section('css')
    <link rel="stylesheet" href="{{ asset ('css/bootstrap-utilities/utilities.css') }}">
    @endsection
@section('content')
<style>
    :root{
        --primary-color: #599297;
        --button-color: #1F6268;
    }
    *{
        font-family: "Inter", sans-serif;
        font-size: 15px;
    }
    section{
        background: white;
        flex: 1;
    }
    .change-password-container{
        margin: 1rem 2.5rem;
        border: 2px solid var(--primary-color);
        border-radius: 10px;
        overflow: hidden;
    }

    .changepass-main-container{
        display: flex;
        padding: 2rem;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 90px;
    }

    .changepass-icon-img{
        width: 100%;
        height: 100%;
        max-width: 300px;
        max-height: 300px;
    }

    .change_account_password{
        background: var(--primary-color);
        padding: 10px;
        text-align: center;
        color: white;
        font-weight: 600;
        overflow: hidden;
    }

    .change-password-description{
        font-weight: 500;
        max-width: 450px;
    }

    .buttons-container{
        max-width: 450px;
        display: flex;
        justify-content: space-between;
    
    }
    

    .input-text{
        font-weight: 500;
        font-size: 0.875rem;
        margin-bottom: 5px;
    }
    .input-field-container{
        border: 2px solid #599297;
        border-radius: 10px;
        padding: 10px;
        display: flex;
        max-width: 450px;
        margin-bottom: 10px;
    }
    .input-field-container img{
        width: 24px;
        height: 24px;
        margin-left: 5px;
        margin-right: 10px;
    }
    .input-field-container input{
        width: 100%;
        font-size: 0.875rem;
        border: none;
        outline: none;  
    }


    .primary-btn {
        background-color: var(--button-color);
        color: white;
        font-weight: 600;
        border-radius: 8px;
        font-size: 12px;
        border: 2px solid var(--stroke-color);
        padding: 10px 20px;
        cursor: pointer;
    }

    .primary-btn:hover {
        opacity: 0.9;
    }

    .secondary-btn {
            background-color: white;
            color: var(--button-color);
            font-weight: 600;
            border-radius: 8px;
            font-size: 12px;
            border: 1px solid var(--button-color);
            padding: 10px 20px;
            cursor: pointer;
    }

    .secondary-btn:hover {
        background: var(--button-color);
        opacity: 0.9;
        color: white;
    }

</style>
<section>
    <p style="margin: 1rem 2.5rem;" class="header-title">Change Password</p>
    {{-- <div style="margin: 1rem 2.5rem;">@include('errors/messages')</div> --}}
    <form method="POST" action="{{ route('update_password') }}" id="submitForm">
        <div class="change-password-container">
            <div class="change_account_password">Change Account Password?</div>
            @csrf
            <div class="changepass-main-container">
                <div class="changepass-container1">
                    <img src="{{ asset('images/others/change-password-icon.png') }}" alt="" class="changepass-icon-img">
                </div>
                <div class="changepass-container2">
                    <div class="change-password-description mb-3">If you wish to change the account password, kindly fill in the current password, new password, and re-type new password.</div>
                    <div class="input-text">Current Password</div>
                    <div class="input-field-container">
                        <img src="{{asset('images/login/password-icon.png')}}">
                        <input type="password" name="current_password" required style="" placeholder="Current Password">
                    </div>
                    <div class="input-text">New Password</div>
                    <div class="input-field-container">
                        <img src="{{asset('images/login/password-icon.png')}}">
                        <input type="password" name="new_password" required style="" placeholder="New Password">
                    </div>
                    <div class="input-text">Confirm New Password</div>
                    <div class="input-field-container">
                        <img src="{{asset('images/login/password-icon.png')}}">
                        <input type="password" name="confirmation_password" required style=""placeholder="Confirm New Password">
                    </div>
                    <div class="buttons-container mt-5">
                        <button type='button' onclick="location.href='{{App\Helpers\CommonHelpers::mainpath()}}'" class='secondary-btn'>{{trans('ad_default.button_cancel')}}</button>
                        <button class="primary-btn" type='button' class='btn btn-primary' id="btnSubmit"> {{trans('ad_default.save_changes')}}</button>
                    </div>
                </div>
            </div>
        </div>
    
    </form>
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
                confirmButtonColor: '#1F6268',
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