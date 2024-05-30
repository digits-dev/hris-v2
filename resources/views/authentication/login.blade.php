<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('images/navigation/hris-logo.png') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <style>
        *{
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        html{
            background-color: #599297;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-user-select: none; /* Safari */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* IE 10+ */
            user-select: none; /* Standard syntax */
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            height: 100%;
            padding: 0;
        }
        .main-container{
            height: 560px;
            width: 100%;
            max-width: 1150px;
            border-radius: 10px;
            background-color: white;
            display: flex;
            margin: auto;
        }

        /* CONTAINER 1 */
        .container1{
            background-color: #D2EBEE;
            width: 100%;
            max-width: 700px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
       
        .title-container{
            padding: 30px 20px 20px 40px;
        }
        .title{
            font-size: 23px;
            color: #429DA6;
            font-weight: 700;
        }
        .image-container{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .image-container img{
            object-fit: contain;
            width: 100%;
            max-width: 550px;
            pointer-events: none;
        }
        .company-logo-container{
            padding: 20px 20px 20px 40px;
        }
        .company-logo-container img {
            height: 30px;
            pointer-events: none;
        }

        /* CONTAINER 2 */
        .container2 {
            background-color: white;
            max-height: 560px;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            padding: 20px 40px;
            flex: 1 0 auto;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .login-text{
            margin-top: 20px;
            font-weight: 700;
            font-size: 25px;
            width: 100%;
            text-align: center;
        }
        .inputs-container{
            height: 100%;
            margin-top: 50px;
        }
        .input-text{
            font-weight: 500;
            font-size: 15px;
            margin-bottom: 10px;
        }
        .input-field-container{
            border: 2px solid #599297;
            border-radius: 10px;
            padding: 10px;
            display: flex;
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
            border: none;
            outline: none;  
        }
        .showpassword-container{
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 5px;
        }
        .showpassword-container p{
            font-size: 13px;
            margin-right: 10px;
            font-weight: 600;
        }
        .showpassword-container input{
            margin-right: 5px;
        }
        .login-button-container{
            width: 100%;
        }
        .login-button-container button{
            border-radius: 10px;
            border: 1px solid #ddd;
            background-color: #1F6268;
            font-weight: bold;
            color: white;
            padding: 15px;
            margin-top: 30px;
            width: 100%;
        }
        .login-button-container button:hover{
            opacity: 70%;
            cursor: pointer;
        }
        .forgot-password-container{
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }
    
        .forgot_text{
            font-size: 14px;
            font-weight: 600;
        }

        /* CHECKBOX */

        .showpassword-container {
            display: flex;
            align-items: center;
        }

        .hidden-checkbox {
             display: none;
        }

        .checkbox-label {
            width: 20px;
            height: 20px;
            border: 1px solid #aaa;
            border-radius: 4px;
            position: relative;
            cursor: pointer;
        }

        .checkbox-label::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 14px;
            height: 14px;
            border-radius: 2px;
            background-color: transparent;
        }

        .hidden-checkbox:checked + .checkbox-label::after  {
            background-color: #599297;
        }

        .hidden-checkbox:checked + .checkbox-label  {
            border: 1px solid #599297;
        }

        .checkbox-text {
            margin-left: 5px;
            font-size: 13px;
            font-weight: 600;
        }

        /* ERROR MESSAGE */
        .text-danger {
            color: red;
            font-weight: bold;
            font-size: 12px;
        }

        .error_message{
            display: flex;
            text-align: center;
            margin-top: 5px;
            justify-content: center;
        }


        @media only screen and (max-width: 750px) {
            .container1  {
                display: none;
            }

            .main-container{
                background-color: transparent;
                justify-content: center;
                margin: auto;
            }

            .container2{
                border-radius: 10px;
            }
        }


    </style>
    <body>
        <div class="main-container">
            <div class="container1">
                <div class="title-container">
                    <p class="title">Human Resource Information System</p>
                </div>
                <div class="image-container">
                    <img src="{{asset('images/login/hrisloginimg.png')}}">
                </div>
                <div class="company-logo-container">
                    <img src="{{asset('images/login/digitslogo.png')}}">
                </div>
            </div>
            <div class="container2">
            <div class="login-text">Login</div>
                <form action="{{ route('login') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="inputs-container">
                        <div class="input-text">Email Address</div>
                        <div class="input-field-container">
                            <img src="{{asset('images/login/email-icon.png')}}">
                            <input class="r_input" type="email" name="email" required placeholder="Email Address">
                        </div>
                        <div class="input-text">Password</div>
                        <div class="input-field-container">
                            <img src="{{asset('images/login/password-icon.png')}}">
                            <input class="r_input" type="password" name="password" required placeholder="Password" id="password-input">
                        </div>
                        <div class="showpassword-container">
                            <input type="checkbox" id="checkbox" class="hidden-checkbox">
                            <label for="checkbox" class="checkbox-label"></label>
                            <span class="checkbox-text">Show Password</span>
                        </div>

                        <div class="login-button-container">
                            <button>Login</button>
                        </div>
                        <div class="error_message">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                            @if ($errors->has('no_priv'))
                                <span class="text-danger">{{ $errors->first('no_priv') }}</span>
                            @endif
                            @if ($errors->has('acc_deact'))
                                <span class="text-danger">{{ $errors->first('acc_deact') }}</span>
                            @endif
                            @if(session('rejected'))
                                <span class="text-danger">
                                    {{ session('rejected') }}
                                </span>
                            @endif
                            @if(session('forApproval'))
                                <span class="text-danger">
                                    {{ session('forApproval') }}
                                </span>
                            @endif
                        </div>
                        <div class="forgot-password-container">
                            <span class="forgot_text">Forgot Password? <a class="register_links" href="{{ url('contact-us') }}" style="color:#429DA6; text-decoration: none; ">Contact HR.</a></span>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
        <script>
            $(document).ready(function(){
                window.onpageshow = function(event) {
                    if (event.persisted) {
                        location.reload();
                    }
                };
                $('#checkbox').change(function(){
                    var isChecked = $(this).is(':checked');
                    if(isChecked){
                        $('#password-input').attr('type', 'text');
                    } else {
                        $('#password-input').attr('type', 'password');
                    }
                });
             });
        </script>
    </body>
</html>