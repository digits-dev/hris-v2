<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/navigation/hris-logo.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style>
      *{
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
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
            width: 100%;
            max-width: 1150px;
            border-radius: 10px;
            background-color: white;
            display: flex;
            margin: auto;
            overflow: hidden;
        }

        .container1{
            width: 45%;
            height: 100%;
            padding: 20px;

            img{
                width: 100%;
                max-width: 500px;
            }
            
            a{
                text-decoration: none;
                color: #429DA6;
                font-weight: 500;
                font-size: 14px;
            }
        }

        .container2{
            width: 55%;
            height: 100%;
            padding: 20px 50px;

            .contact-us-text{
                font-weight: 800;
                font-size: 18px;
                color: #429DA6;
                margin-top: 70px;
            }

            .text-1{
                color: #5A5454;
                font-weight: 700;
                font-size: 15px;
            }

            .text-2{
                color: #5A5454;
                font-weight: 700;
                font-size: 14px;
            }

            .text-3{
                color: #5A5454;
                font-weight: 500;
                font-size: 14px;
            }
        }

        @media only screen and (max-width: 750px) {

            body{
                overflow-y: auto;
                scrollbar-width: none;
            }
            .container1  {
                display: none;
            }

            .main-container{
                justify-content: center;
                margin: auto;
            }

            .container2{
                border-radius: 10px;
                padding: 20px 15px;

                .contact-us-text{
                    margin-top: 20px;
                }
            }

            
        }
</style>
<body>
  <div class="main-container">
    <div class="container1">
        <a href="{{route('login_page')}}">Back to Login</a>
        <img src="{{asset('images/login/contact-us-icon.png')}}">
    </div>
    <div class="container2">
        <p class="contact-us-text">Contact Us</p>
        <p class="text-1">Have a question or need assistance? We're here to help! Feel free to get in touch using the contact details below.</p>
        <p class="text-2">Email: hr@digits.ph</p>
        <p class="text-3">Whether you have inquiries about our services or just want to say hello, we'd love to know who we're talking to. Please provide your name so we can address you personally.</p>
        <p class="text-3">If you prefer email communication, drop us a message at the provided email address. We'll make sure to respond promptly to any questions or concerns you may have.</p>
        <p class="text-3">For a more direct and immediate response, you can reach us via mobile. Feel free to give us a call or send a text, and we'll assist you with any assistance you require.</p>
    </div>
  </div>
</body>
</html>