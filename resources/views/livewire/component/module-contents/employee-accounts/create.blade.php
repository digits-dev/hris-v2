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
            display: grid;
            grid-template-columns: 1fr;
            column-gap: 40px;
            row-gap: 10px;
            min-width: 80%;
            max-width: 700px;
        }

        .personal-content-inputs label {
            font-weight: 500;
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
                grid-template-columns: 4fr 4fr 2fr;
                gap: 40px;
            }
        }


        .account-content input,
        .account-content select {
            border: 1px solid var(--stroke-color);
            border-radius: 8px;
            padding: 5px 10px;
            outline: none;
            margin-top: 5px;
            font-weight: 400;
            padding: 8px 16px;

        }

        .account-content label {
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

        .table-btn:hover {
            opacity: 0.9;
        }

        .error-text {
            color: rgb(250, 48, 48);
        }
    </style>
@endsection


<section>

    <form action="" class="space-y-10" wire:submit.prevent="save">

        {{-- Personal  Information  --}}
        <fieldset>
            <legend class="legend">Personal Information</legend>

            <div class="personal-content">
                <div class="custom-upload-div">
                    <div class="custom-upload" x-data="{ openFileInput: function() { document.getElementById('fileInput').click(); } }">
                        <!-- Original file input -->
                        <input type="file" wire:model="profileImage" id="fileInput" style="display: none;"
                            accept="image/*">

                        <!-- Custom image or button to trigger file input -->
                        <button @click.prevent="openFileInput">
                            @if ($profileImage && strpos($profileImage->getMimeType(), 'image/') === 0)
                                <img src="{{ $profileImage->temporaryUrl() }}" @style(['height:180px' => $isLandscape, 'max-width: unset' => $isLandscape]) alt="profile-picture">
                            @else
                                <img src="/images/table/file-upload.png" height="auto" class="object-contain"
                                    alt="Upload Image">
                            @endif
                        </button>
                    </div>

                    @if (!$profileImage)
                        <label for="" class="cursor-pointer font-medium block mt-2 text-center">
                            Add Photo
                        </label>
                    @endif

                    @error('profileImage')
                        <em>
                            <p class="error-text text-center">{{ $message }}</p>
                        </em>
                    @enderror

                </div>

                <div class="personal-content-inputs">
                    <div>
                        <label for="first-name">First Name
                            <input type="text" id="first-name" wire:model.blur="first_name">
                        </label>
                        @error('first_name')
                            <em>
                                <p class="error-text">{{ $message }}</p>
                            </em>
                        @enderror
                    </div>

                    <div>
                        <label for="middle-name">Middle Name
                            <input type="text" id="middle-name" wire:model.blur="middle_name">
                        </label>
                        @error('middle_name')
                            <em>
                                <p class="error-text">{{ $message }}</p>
                            </em>
                        @enderror
                    </div>

                    <div>
                        <label for="last-name">Last Name
                            <input type="text" id="last-name" wire:model.blur="last_name">
                        </label>
                        @error('last_name')
                            <em>
                                <p class="error-text">{{ $message }}</p>
                            </em>
                        @enderror
                    </div>
                </div>
            </div>
        </fieldset>

        {{-- Account Information  --}}
        <fieldset>
            <legend class="legend">Account Information</legend>
            <div class="account-content">

                <div class="flex flex-col">
                    <label for="employeeId">Employee Id
                        <input type="text" id="employeeId" wire:model.blur="employee_id">
                    </label>
                    @error('employee_id')
                        <em>
                            <p class="error-text">{{ $message }}</p>
                        </em>
                    @enderror

                    <label for="location" class="flex flex-col mt-2">Location
                        <select wire:model.blur="location" id="location" class="text-primary-text">
                            <option value="" selected>Select Company</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                            @endforeach
                        </select>
                    </label>
                    @error('location')
                        <em>
                            <p class="error-text">{{ $message }}</p>
                        </em>
                    @enderror

                    <label for="email" class="block mt-3">
                        Email Address
                        <input type="email" id="email" wire:model.blur="email">
                    </label>
                    @error('email')
                        <em>
                            <p class="error-text">{{ $message }}</p>
                        </em>
                    @enderror

                </div>

                <div class="flex flex-col">
                    <label for="company" class="flex flex-col">Company
                        <select id="company" wire:model.blur="company_id" class="text-primary-text">
                            <option value="" selected>Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                    </label>
                    @error('company_id')
                        <em>
                            <p class="error-text">{{ $message }}</p>
                        </em>
                    @enderror

                    <label for="position" class="flex flex-col mt-2">Position
                        <select id="position" wire:model.blur="position_id" class="text-primary-text">
                            <option value="" selected>Select Position</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->position_name }}</option>
                            @endforeach
                        </select>
                    </label>
                    @error('position')
                        <em>
                            <p class="error-text">{{ $message }}</p>
                        </em>
                    @enderror


                    <label for="privilege" class="flex flex-col mt-3">System Privilege
                        <select id="privilege" wire:model.blur="privilege_id" class="text-primary-text">
                            <option value="" selected>Select System Privilege</option>
                            @foreach ($privileges as $privilege)
                                <option value="{{ $privilege->id }}">{{ $privilege->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    @error('privilege_id')
                        <em>
                            <p class="error-text">{{ $message }}</p>
                        </em>
                    @enderror

                </div>

                <div>
                    <label for="hire_date" class="flex flex-col">Hire Date
                        <input type="date" id="hire_date" wire:model.blur="hire_date">
                    </label>
                    @error('hire_date')
                        <em>
                            <p class="error-text">{{ $message }}</p>
                        </em>
                    @enderror
                </div>

            </div>
        </fieldset>

        <div class="flex w-full justify-between">
            <a role="button" href="/employee-accounts" class="table-btn">Cancel</a>
            <input type="submit" value="Submit" class="table-btn">
        </div>
    </form>
</section>
