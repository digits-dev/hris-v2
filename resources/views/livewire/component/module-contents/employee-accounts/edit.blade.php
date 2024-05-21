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
            display: grid;
            grid-template-columns: 1fr;
            margin-top: 40px;
            padding: 30px;

        }

        .custom-upload{
            margin:auto;
            margin-bottom: 20px;
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
            display: grid;
            grid-template-columns: 1fr;
            column-gap: 40px;
            row-gap: 10px;
            min-width: 80%;
            max-width: 700px;
        }

        @media screen and (min-width: 900px){

            .personal-content {
                grid-template-columns: 1fr 5fr;
                margin-left: 30px;
            }
            .personal-content-inputs{
                margin-left: 40px;
                grid-template-columns: 1fr 1fr;
            }
        }

        @media screen and (min-width: 1200px){
            .personal-content-inputs{
                row-gap: 0;
            }
        }

        .account-content {
            margin-top: 40px;
            padding: 40px;
            display: grid;
            grid-template-columns: 1fr;
            gap:10px;
        
        }

        @media screen and (min-width: 900px){
            .account-content{
                grid-template-columns: 4fr 4fr 2fr;
                gap:40px;
            }
        }

        .account-content input, .account-content select  {
            border: 1px solid var(--stroke-color);
            border-radius: 8px;
            padding: 5px 10px;
            outline: none;
            margin-top: 5px;
            font-weight: 400;
            padding: 8px 16px;

        }
        .account-content label{
            font-weight: 500;
            font-size: 14px;
        }

            
        .table-btn {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            border-radius: 8px;
            font-size: 12px;
            border: 2px solid var(--stroke-color);
            padding: 10px 20px;
            cursor: pointer;
            width: 100px;
            display: block;
            text-align: center

        }

        .table-btn:hover{
            opacity: 0.9;
        }


    </style>
@endsection


<section>

    <form action="" class="space-y-10" wire:submit.prevent="save">

        {{-- Personal  Information  --}}
        <fieldset>
            <legend class="legend">Personal Information</legend>

            <div class="personal-content">
                {{-- <input type="file" name="" id=""> --}}

                <div class="custom-upload" x-data="{ openFileInput: function() { document.getElementById('fileInput').click(); } }">
                    <!-- Original file input -->
                    <input type="file" name="file" id="fileInput" style="display: none;" accept="image/*">

                    <!-- Custom image or button to trigger file input -->
                    <button @click="openFileInput">
                        <img src="/images/table/file-upload.png" alt="Upload Image" width="180">
                        <label for="" class="cursor-pointer font-medium block mt-2">Add Photo</label>
                    </button>
                </div>

                <div class="personal-content-inputs">
                    <label for="first-name">First Name
                        <input type="text" name="first_name" id="first-name" value="{{$user->first_name}}">
                    </label>
                    <label for="middle-name">Middle Name
                        <input type="text" name="last_name" id="last-name" value="{{$user->middle_name}}">
                    </label>
                    <label for="last-name">Last Name
                        <input type="text" name="last_name" id="last-name" value="{{$user->last_name}}">
                    </label>
                </div>
            </div>
        </fieldset>

        {{-- Account Information  --}}
        <fieldset>
            <legend class="legend">Account Information</legend>
            <div class="account-content">
             
                <div class="flex flex-col">
                    <label for="">Employee Id
                        <input type="text" name="" id="" value="{{$user->employee_id}}">
                    </label>
    
                    <label for="" class="flex flex-col mt-2">Location
                        <select name="" id="" class="text-primary-text">
                            <option value="">Select Location</option>
                            <option value="" selected>{{$user->hire_location}}</option>
                            <option value="">Quezon City </option>
                            <option value="">Manila City </option>
                        </select>
                    </label>
    
                    <label for="" class="block mt-3">
                        Email Address
                        <input type="email" name="" id="" value="{{$user->email}}">
    
                    </label>
    
                </div>


                <div class="flex flex-col">
                    <label for="" class="flex flex-col">Company
                        <select name="" id="" class="text-primary-text">
                            <option value="">Select Company</option>
                            <option value="" selected>{{$user->company}}</option>
                            <option value="">Company 1</option>
                            <option value="">Company 2</option>
                        </select>
                    </label>
    
                    <label for="" class="flex flex-col mt-2">Position
                        <input type="text" name="" id="" value="Employee">
                    </label>
    

                    <label for="" class="flex flex-col mt-3">System Privilege
                        <select name="" id="" class="text-primary-text">
                            <option value="">Select System Privilege</option>
                            <option value="">Admin</option>
                            <option value="">User</option>
                        </select>
                    </label>
    
                </div>

                <div class="flex flex-col">
                    <label for="hire_date" class="flex flex-col">Hire Date
                       <input type="date" name="" id="hire_date" value="{{date('Y-m-d', strtotime($user->hire_date))}}">
                    </label>

                    <label for="" class="flex flex-col mt-2">Status
                        <select name="" id="" class="text-primary-text">
                            <option value="">Select Status</option>
                            <option value="" selected>{{$user->status ? 'Active' : 'Inactive'}}</option>
                            <option value="{{!$user->status ? 1 : 0}}">{{!$user->status ? 'Active' : 'Inactive'}}</option>
                        </select>
                    </label>
                </div>

                

            </div>
        </fieldset>

    <div class="flex w-full justify-between">
        <a role="button" href="/employee-accounts" class="table-btn" wire:navigate>Cancel</a>
        <input  type="submit" value="Save" class="table-btn">
    </div>
    </form>
</section>
