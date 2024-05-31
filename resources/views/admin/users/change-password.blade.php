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
        --disabled-btn-color: #b5c6c7;
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

    .primary-btn:disabled {
        background: var(--button-color);
        opacity: 0.9;
        color: white;
        cursor: not-allowed;
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
                        <input type="password" name="current_password" class="inputs" id="current_password" required placeholder="Current Password">
                    </div>
                    <div class="input-text">New Password</div>
                    <div class="input-field-container confirm-input">
                        <img src="{{asset('images/login/password-icon.png')}}">
                        <input type="password" name="new_password" class="inputs" required id="new_password" placeholder="New Password">
                    </div>
                    <div class="input-text">Confirm New Password</div>
                    <div class="input-field-container confirm-input">
                        <img src="{{asset('images/login/password-icon.png')}}">
                        <input type="password" name="confirmation_password" class="inputs" id="confirmation_password" required placeholder="Confirm New Password">
                    </div>
                    <span id="pass_not_match" class="p-2 mx-10 my-5 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-red-600 dark:text-white" style="display: none">Password not match!</span>
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
         $(document).ready(function() {
       
                const msg_type = "{{ session('message_type') }}";
                if (msg_type == 'success'){
                    setTimeout(function(){
                        window.location.href = "{{ route('logout') }}"
                    }, 2000);
                }

                $(document).on('input', '#current_password, #new_password, #confirmation_password', function() {
                    validateInputs();
                });

                $(document).on('input', '#confirmation_password', function() {
                    confirmPassword();
                });

                $('#btnSubmit').on('click', function(event) {
                    event.preventDefault();
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
                
                function validateInputs(){
                    const inputs = $('.inputs').get();
                    let isDisabled = true;
                    inputs.forEach(input =>{
                        const currentVal = $(input).val(); 
                        if(!currentVal){
                            isDisabled = false;
                        }
                    });
                    $('#btnSubmit').attr('disabled',!isDisabled);
                }

                function confirmPassword(){
             
                    let isDisabled = true;
                    const new_pass = $('#new_password').val();
                    const confirm_pass = $('#confirmation_password').val();
                    console.log(new_pass);
                    if(new_pass != confirm_pass){
                        isDisabled = false;
                        $('.confirm-input').css('border', '2px solid red');
                        $('#pass_not_match').show();
                    }else{
                        $('.confirm-input').css('border', '');
                        $('#pass_not_match').hide();
                    }
                  
                    $('#btnSubmit').attr('disabled',!isDisabled);
                }

                $('#btnSubmit').attr('disabled',true);

            });
    </script>
@endsection