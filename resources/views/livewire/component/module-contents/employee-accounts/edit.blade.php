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
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
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
          <div class="custom-upload" x-data="{ editFileInput: function() { document.getElementById('fileInput').click(); } }">
            <!-- Original file input -->
            <input accept="image/*" id="fileInput" style="display: none;" type="file"
              wire:model="form.profileImage">

            @php
              $fileExists = file_exists(public_path('storage/' . $this->form->image));
              $uploadImage = $this->form->profileImage;
              $isLandscape = false;

              if ($uploadImage && strpos($uploadImage->getMimeType(), 'image/') === 0) {
                  [$width, $height] = getimagesize($uploadImage->temporaryUrl());
                  $isLandscape = $width > $height;
              } elseif ($this->form->image && $fileExists) {
                  $profileImagePath = public_path('storage/' . $this->form->image);
                  [$width, $height] = getimagesize($profileImagePath);
                  $isLandscape = $width > $height;
              } else {
                  $profileImagePath = null;
              }
            @endphp

            <button @click.prevent="editFileInput">
              @if ($uploadImage && strpos($uploadImage->getMimeType(), 'image/') === 0)
                <img @style(['height:180px' => $isLandscape, 'max-width: unset' => $isLandscape]) alt="profile-picture"
                  src="{{ $uploadImage->temporaryUrl() }}">
              @elseif ($profileImagePath || !$fileExists)
                <img @style(['height:180px' => $isLandscape, 'max-width: unset' => $isLandscape]) alt="profile-picture"
                  src="{{ asset('storage/' . $this->form->image) }}">
              @else
                <img alt="Upload Image" class="object-contain" height="auto"
                  src="/images/table/file-upload.png">
              @endif
            </button>

          </div>
          {{-- Show add photo label if user image is null --}}
          @if (!$this->form->image)
            <label class="cursor-pointer font-medium block mt-2 text-center" for="">
              Add Photo
            </label>
          @endif

          @error('form.profileImage')
            <em>
              <p class="error-text text-center">{{ $message }}</p>
            </em>
          @enderror
        </div>

        <div class="personal-content-inputs">
          <div>
            <label for="first-name">First Name
              <input id="first-name" type="text" wire:model.blur="form.first_name">
            </label>
            @error('form.first_name')
              <em>
                <p class="error-text">{{ $message }}</p>
              </em>
            @enderror
          </div>

          <div>
            <label for="middle-name">Middle Name
              <input id="middle-name" type="text" wire:model.blur="form.middle_name">
            </label>
            @error('form.middle_name')
              <em>
                <p class="error-text">{{ $message }}</p>
              </em>
            @enderror
          </div>

          <div>
            <label for="last-name">Last Name
              <input id="last-name" type="text" wire:model.blur="form.last_name">
            </label>
            @error('form.last_name')
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
            <input id="employeeId" type="text" wire:model.blur="form.employee_id">
          </label>
          @error('form.employee_id')
            <em>
              <p class="error-text">{{ $message }}</p>
            </em>
          @enderror

          <label class="flex flex-col mt-2" for="location">Location
            <select class="text-primary-text" id="location"
              wire:model.blur="form.hire_location_id">
              <option disabled value="">Select Location</option>
              @foreach ($locations as $location)
                <option @if ($location->id == $this->form->hire_location_id) selected @endif
                  value="{{ $location->id }}">
                  {{ $location->location_name }}
                </option>
              @endforeach
            </select>
          </label>
          @error('form.hire_location_id')
            <em>
              <p class="error-text">{{ $message }}</p>
            </em>
          @enderror

          <label class="block mt-3" for="email">
            Email Address
            <input id="email" type="email" wire:model.blur="form.email">
          </label>
          @error('form.email')
            <em>
              <p class="error-text">{{ $message }}</p>
            </em>
          @enderror
        </div>

        <div class="flex flex-col">
          <label class="flex flex-col" for="company">Company
            <select class="text-primary-text" id="company" wire:model.blur="form.company_id">
              <option disabled value="">Select Company</option>
              @foreach ($companies as $company)
                <option @if ($company->id == $this->form->company_id) selected @endif
                  value="{{ $company->id }}">
                  {{ $company->company_name }}
                </option>
              @endforeach
            </select>
          </label>
          @error('form.company_id')
            <em>
              <p class="error-text">{{ $message }}</p>
            </em>
          @enderror

          <label class="flex flex-col mt-2" for="position">Position
            <select class="text-primary-text" id="position" wire:model.blur="form.position_id">
              <option selected value="">Select Position</option>
              @foreach ($positions as $position)
                <option value="{{ $position->id }}">{{ $position->position_name }}</option>
              @endforeach
            </select>
          </label>

          @error('form.position')
            <em>
              <p class="error-text">{{ $message }}</p>
            </em>
          @enderror

          <label class="flex flex-col mt-3" for="privilege">System Privilege
            <select class="text-primary-text" id="privilege"
              wire:model.blur="form.id_ad_privileges">
              <option disabled value="">Select System Privilege</option>
              @foreach ($privileges as $privilege)
                <option @if ($privilege->id == $this->form->id_ad_privileges) selected @endif
                  value="{{ $privilege->id }}">
                  {{ $privilege->name }}
                </option>
              @endforeach
            </select>
          </label>
          @error('form.id_ad_privileges')
            <em>
              <p class="error-text">{{ $message }}</p>
            </em>
          @enderror
        </div>

        <div class="flex flex-col">
          <div>
            <label class="flex flex-col" for="hire_date">Hire Date
              <input id="hire_date" type="date" wire:model.blur="form.hire_date">
            </label>
            @error('form.hire_date')
              <em>
                <p class="error-text">{{ $message }}</p>
              </em>
            @enderror
          </div>

          <label class="flex flex-col mt-2" for="">Status
            <select class="text-primary-text" id="" name="">
              <option disabled value="">Select Status</option>
              <option selected value="">{{ $this->form->status ? 'Active' : 'Inactive' }}
              </option>
              <option value="{{ !$this->form->status ? 1 : 0 }}">
                {{ !$this->form->status ? 'Active' : 'Inactive' }}
              </option>
            </select>
          </label>
        </div>

      </div>
    </fieldset>

    <div class="flex w-full justify-between">
      <a class="table-btn" href="/employee-accounts" role="button">Cancel</a>
      <input class="table-btn" type="submit" value="Save">
    </div>
  </form>
</section>
