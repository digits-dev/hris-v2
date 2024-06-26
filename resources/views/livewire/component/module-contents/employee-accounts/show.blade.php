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

        label {
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


        .custom-upload-div {
            margin: auto;
            margin-bottom: 20px;

        }

        .custom-upload {
            border-radius: 100%;
            overflow: hidden;
            height: 180px;
            width: 180px;
            display: grid;
            place-content: center;
            border: 5px solid var(--stroke-color);
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

        @media screen and (min-width: 900px) {

            .personal-content {
                grid-template-columns: 1fr 5fr;
                margin-left: 30px;
            }

            .personal-content-inputs {
                margin-left: 40px;
                grid-template-columns: 1fr 1fr;
            }
        }

        @media screen and (min-width: 1200px) {
            .personal-content-inputs {
                row-gap: 0;
            }
        }

        .account-content {
            margin-top: 40px;
            padding: 40px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;

        }

       

        @media screen and (min-width: 900px) {
        .account-content {
            grid-template-columns: 4fr 4fr 3fr;
            column-gap: 40px;
            row-gap: 20px;
        }
        }

        .account-content input,
        .account-content select {
            border: 1px solid var(--stroke-color);
            border-radius: 8px;
            padding: 8px 16px;
            outline: none;
            margin-top: 5px;
            font-weight: 400;
        }

        .account-content label {
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
            margin-top: 20px;
            display: block;
            margin-left: auto;
            text-align: center
        }

        .back-btn:hover {
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
                <div class="custom-upload-div">
                    <div class="custom-upload">
                        @php
                            if ($user->image) {
                                $imagePath = public_path('storage/' . $user->image);

                                if (file_exists($imagePath)) {
                                    [$width, $height] = getimagesize($imagePath);
                                    $isLandscape = $width > $height;
                                } else {
                                    $isLandscape = false;
                                }
                            }
                        @endphp

                        @if ($user->image)
                            <img @style(['height:180px' => $isLandscape, 'max-width: unset' => $isLandscape]) alt="profile-picture"
                                src="{{ asset('storage/' . $user->image) }}">
                        @else
                            <img alt="default profile image" class="object-contain" height="auto"
                                src="/images/navigation/user.png">
                        @endif
                    </div>
                </div>

                <div class="personal-content-inputs">
                    <label for="first-name">First Name
                        <input type="text" name="" id="" value="{{ $user->first_name }}" disabled>
                    </label>
                    <label for="last-name">Middle Name
                        <input type="text" name="" id="" value="{{ $user->middle_name }}" disabled>
                    </label>
                    <label for="last-name">Last Name
                        <input type="text" name="" id="" value="{{ $user->last_name }}" disabled>
                    </label>
                </div>
            </div>
        </fieldset>

        {{-- Account Information  --}}
        <fieldset>
            <legend class="legend">Account Information</legend>
            <div class="account-content">

               
                    <label>Employee Id
                        <input type="text"  value="{{ $user->employee_id }}" disabled>
                    </label>

                    <label class="flex flex-col">Department
                        <input type="text" 
                            value="{{ $user->department->department_name }}" disabled>
                    </label>

                    <label class="flex flex-col ">Hire Date
                        <input type="text" 
                            value="{{ $user->hire_date }}" disabled>
                    </label>
    
                    <label class="block">
                        Email Address
                        <input type="email"  value="{{ $user->email }}" disabled>
                    </label>

                    <label class="flex flex-col">Position
                        <input type="text"  value="{{ $user->position }}" disabled>
                    </label>

                    <label class="block">
                        System Privilege
                        <input type="text"  value="{{ $user->privilege->name }}" disabled>
                    </label>

                    <label>Company
                        <input type="text"  value="{{ $user->company->company_name }}"
                            disabled>
                    </label>

                    <label class="flex flex-col">Hire Location
                        <input type="text" 
                            value="{{ $user->hireLocation->location_name }}" disabled>
                    </label>

                    <label class="flex flex-col">Status
                        <input type="text" 
                            value="{{ $user->status ? 'Active' : 'Inactive' }}" disabled>
                    </label>

            </div>

    
        </fieldset>

    </form>


    <a role="button" href="/employee-accounts" class="back-btn">Go back</a>
</section>
