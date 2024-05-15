@section('css')
    <style>
        :root {
            --primary-color: #1F6268;
            --stroke-color: #599297;
            --secondary-color: #cbfaff;
            --primary-text: #113437;
            --primary-hover: #DDFAFD;
            --tertiary-color: #27C1CE;
        }

        section {
            margin: 1rem 2.5rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .module {
            font-size: 12px;
            font-weight: bold;
            font-family: "Inter", sans-serif;
        }

        form {
            /* border: 1px solid black; */
        }

        fieldset {
            border: 1px solid var(--stroke-color);
            border-radius: 8px;
            margin: 10px 0;
            position: relative;
            overflow: hidden;
        }

        .legend {
            color: white;
            background: var(--stroke-color);
            width: 100%;
            text-align: center;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            font-weight: bold;
            padding: 10px;
            position: absolute;
            
            top: 0;
        }
        
        label{
            font-size: 14px;
        }

        form input {
            width: 100%;
        }

        .personal-content {
            display: flex;
            justify-content: flex-start;
            margin-top: 40px;
            margin-left: 30px;
            padding: 30px;

        }

        .personal-content input[type="text"] {
            border: 1px solid var(--stroke-color);
            border-radius: 8px;
            padding: 8px 16px;
            outline: none;
            margin-top: 5px;
            font-weight: 400;
        }


        .personal-content-inputs {
            font-weight: 500;
            margin-left: 40px;
            display: flex;
            gap: 20px;
            flex-direction: column;
            justify-content: center;
            width: 400px;
        }

        .account-content {
            margin-top: 40px;
            margin-left: 30px;
            padding: 20px;
            display: flex;
            gap:40px;
        
        }

        .account-content input, .account-content select  {
            border: 1px solid var(--stroke-color);
            border-radius: 8px;
            padding: 8px 16px;
            outline: none;
            margin-top: 5px;
            font-weight: 400;
        }
        .account-content label{
            font-weight: 500;
            font-size: 14px;
        }

        
        .back-btn {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            border-radius: 8px;
            font-size: 12px;
            border: 2px solid var(--stroke-color);
            padding: 10px 20px;
            cursor: pointer;
            width: 100px;
            margin-top:20px;
            display: block;
            margin-left: auto;
            text-align: center

        }

        .back-btn:hover{
            opacity: 0.9;
        }


    </style>
@endsection


<section>

    <form action="" class="space-y-10">

        {{-- Personal  Information  --}}
        <fieldset>
            <legend class="legend">Personal Information</legend>

            <div class="personal-content">
                {{-- <input type="file" name="" id=""> --}}

                <div x-data="{ openFileInput: function() { document.getElementById('fileInput').click(); } }">
                    <!-- Original file input -->
                    <input type="file" name="file" id="fileInput" style="display: none;" accept="image/*">

                    <!-- Custom image or button to trigger file input -->
                    <img src="/images/navigation/user.png" alt="Upload Image" width="180">
               
                </div>

                <div class="personal-content-inputs">
                    <label for="first-name">First Name
                        <input type="text" name="" id="" value="{{$user->first_name}}" disabled>

                    </label>
                    <label for="last-name">Last Name
                        <input type="text" name="" id="" value="{{$user->last_name}}" disabled>

                    </label>
                </div>
            </div>
        </fieldset>

        {{-- Account Information  --}}
        <fieldset>
            <legend class="legend">Account Information</legend>
            <div class="account-content">
             
                <div class="flex flex-col w-2/6">
                    <label for="">Employee Id
                        <input type="text" name="" id="" value="{{$user->employee_id}}" disabled>
                    </label>
    
                    <label for="" class="flex flex-col mt-2">Location
                        <input type="text" name="" id="" value="{{$user->location}}" disabled>
                    </label>
    
                    <label for="" class="block mt-3">
                        Email Address
                        <input type="email" name="" id="" value="{{$user->email}}" disabled>
                    </label>
    
                </div>

                <label for="" class="flex flex-col w-2/6">Role
                    <input type="email" name="" id="" value="Admin" disabled>
                </label>

            </div>
        </fieldset>

    </form>


    <a role="button" href="{{route('employee-accounts')}}" class="back-btn" wire:navigate>Go back</a>
</section>
