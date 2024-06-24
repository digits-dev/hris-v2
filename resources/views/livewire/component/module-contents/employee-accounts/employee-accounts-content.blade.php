@section('css')

    <link rel="stylesheet" href="{{ asset('css/section/table-section.css') }}">

    <style>

        /* Table Column Widths  */
        .checkbox-col {
            min-width:50px;
            text-align: center;
        }
        .image-col{
            min-width:60px;
        }

        .first-name-col {
            min-width:130px;
        }

        .middle-name-col {
            min-width:140px;
        }

        .last-name-col {
            min-width:130px;
        }

        .employee-id-col {
            min-width:150px;
        }

        .email-col {
            min-width:120px;
        }

        .company-col {
            min-width:150px;
        }
        .department-col {
            min-width:150px;
        }

        .hire-location-col {
            min-width:150px;
        }

        .hire-date-col {
            min-width:110px;
        }
        .position-col {
            min-width:150px;
            text-align: center;
            button{
                margin:auto;
            }
        }

        .status-col {
            min-width:100px;
            text-align: center;

            button{
                margin:auto;
            }
        }

        .action-col {
            min-width:100px;
        }

        /* End of Table Column Widths  */



        /* modals */

        .bulk-popup {
            display: flex;
            flex-direction: column;
            position: absolute;
            width: 200px;
            background-color: white;
            top: 0;
            right: 0;
            border-radius: 8px;
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            justify-content: space-between;
            overflow: hidden;
        }

        .bulk-content {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 10px;
            width: 100%;
            text-decoration: none;
            color: #1F6268;
        }

        .bulk-content:hover {
            background-color: #cbfaff;
        }

        .bulk-content p {
            font-size: 13px;
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: 500;
        }


        .modal-container{
            position: fixed;
            inset: 0;
            z-index: 50;

        }

        /* Modal Style  */
        .modal-backdrop {
            /* position: fixed;
            top: 0;
            left: 0; */
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px 0;
            z-index: 10000;
            width: 500px;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .modal-body p {
            font-size: 18px;
            font-family: "Inter", sans-serif;
            font-weight: 500;
            width: 90%;
            text-align: center
        }

        .modal-footer {
            text-align: center;
        }

        .modal-footer button {
            margin-left: 10px;
        }


        /* FOR FILTER MODAL */

        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .filter-modal-content {
            -webkit-user-select: none; /* Safari */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* IE 10+ */
            user-select: none; /* Standard syntax */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 25px;
            z-index: 10000;
        }

        .filter-modal-header p {
            font-size: 18px;
            color: #113437;
            font-family: "Inter", sans-serif;
            font-weight: bold;
        }

        .filter-modal-body {
            display: flex;
            justify-content: center; /* Space between for even spacing */
            margin: 10px 0;
            flex-wrap: wrap;
            gap: 15px;
        }

        .filter-modal-footer{
            display: flex;
            justify-content: space-between;
        }

        .modal-body-container1,
        .modal-body-container2 {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }


        /* SELECT */

        .filter-modal-select {
            position: relative;
            width: 300px;
            min-width: 100px;
            height: 40px;
        }

        .filter-modal-select-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .filter-modal-select-container p {
            text-align: start;
            margin-bottom: 5px;
            font-size: 15px;
            font-family: "Inter", sans-serif;
            color: #113437;
            font-weight: bold;
        }


        .filter-modal-select select, .filter-modal-select input[type="text"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding: 10px 15px;
            font-weight: 600;
            font-size: 14px;
            outline: none;
            font-family: "Inter", sans-serif;
            border: 2px solid var(--stroke-color);
            color: var(--primary-color);
            border-radius: 8px;
            background-color: #fff;
            width: 100%;
            cursor: pointer;
        }

        input[type="text"]::placeholder{
            color: var(--primary-color);
            font-size: 14px;
            font-weight: 600;
            font-family: "Inter", sans-serif;
        }

        .filter-modal-arrow-icon {
            position: absolute;
            top: 60%;
            right: 15px;
            transform: translateY(-50%); /* Adjusted for perfect centering */
            width: 10px;
            height: 10px;
            pointer-events: none;
        }

        /* DATE */

        .hire-date-container{
            display: flex;
            justify-content: space-between;
            border: 2px solid var(--stroke-color);
            font-weight: 600;
            font-size: 14px;
            font-family: "Inter", sans-serif;
            border-radius: 8px;
            width: 100%;
            overflow: hidden;
            align-items: center;
            position: relative;
        }

        .hire-date-container span{
            padding: 12px 10px;
            text-align: center;
            width: 60px;
            font-size: 12px;
            color: var(--primary-color);
            border-right: 2px solid var(--stroke-color);
        }

        .hire-date-container input{
            flex: 1;
            padding: 0 20px;
            outline: none;
            color: var(--primary-color);
            -webkit-appearance: none; /* Hide the default calendar icon in Chrome, Safari, and Opera */
            -moz-appearance: textfield; /* Hide the default calendar icon in Firefox */
        }


        /* END OF FOR FILTER MODAL */


        /* Export  */

        .export-modal-content {
            -webkit-user-select: none; /* Safari */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* IE 10+ */
            user-select: none; /* Standard syntax */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 25px;
            z-index: 10000;

        }

        .export-modal-header {
            font-size: 18px;
            color: #113437;
            font-family: "Inter", sans-serif;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }
        

        .export-modal-body {
            display: flex;
            justify-content: center;
            margin: 25px 0;
            flex-wrap: wrap;
            gap: 15px;
            width:480px;
        }


        .filename-input{
            padding: 6px 12px;
            border: 1px solid var(--stroke-color);
            border-radius: 5px;
            outline: none;

        }


    </style>
@endsection

<section>
    <div class="section-header ">
        <div class="section-header__left-container">
            <div class="search-form">
                <label for="search-input" class="search-form__label ">Search</label>
                <input wire:model.live.debounce.300ms="search" type="text" class="search-form__input" placeholder="Search User" id="search-input">
            </div>
            <div class="custom-select">
                <select wire:model.live="perPage" id="per-page">
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <img src="/images/table/asc.png" class="arrow-icon" alt="dropdown icon">
            </div>

            <div x-data="{openFilterModal: false}">
                <button class="primary-btn" x-on:click="openFilterModal = true">Filters</button>
                {{-- FILTER MODAL --}}
                <div x-show="openFilterModal" x-cloak  x-transition class="modal-container" >

                    <!-- Modal backdrop -->
                    <div class="modal-backdrop" x-on:click="openFilterModal = false">
                    </div>

                    <!-- Modal content -->
                    <div class="filter-modal-content">

                        <div class="filter-modal-header">
                           <p>Filters</p>
                        </div>
                        <form wire:submit="filterData">
                            <input type='hidden' wire:model='_token' value="{{ csrf_token()}}">

                            <div class="filter-modal-body">
                                <div class="modal-body-container1">
                                    <div class="filter-modal-select-container">
                                        <p>Company</p>
                                        <div class="filter-modal-select">
                                            <select wire:model="company_id">
                                                <option value="">Select Company</option>
                                                @foreach ($companies as $company)
                                                <option value="{{$company->id}}">{{$company->company_name}}</option>
                                                @endforeach
                                            </select>
                                            <img src="/images/table/asc.png" class="filter-modal-arrow-icon" alt="dropdown icon">
                                        </div>
                                    </div>

                                    <div class="filter-modal-select-container">
                                        <p>Hire Location</p>
                                        <div class="filter-modal-select">
                                            <select wire:model="hire_location_id">
                                                <option value="">Select Location</option>
                                                @foreach ($locations as $location)
                                                <option value="{{$location->id}}">{{$location->location_name}}</option>
                                                @endforeach
                                            </select>
                                            <img src="/images/table/asc.png" class="filter-modal-arrow-icon" alt="dropdown icon">
                                        </div>
                                    </div>

                                    <div class="filter-modal-select-container" >
                                        <p>Status</p>
                                        <div class="filter-modal-select">
                                            <select wire:model="status">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <img src="/images/table/asc.png" class="filter-modal-arrow-icon" alt="dropdown icon">
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-body-container2">
                                    <div class="filter-modal-select-container">
                                        <p>Position</p>
                                        <div class="filter-modal-select">
                                            <input type="text" wire:model="position" placeholder="Search position">
                                        </div>
                                    </div>

                                    <div class="filter-modal-select-container" style="margin-bottom: 7px">
                                        <p>Hire Date</p>
                                        <div class="hire-date-container mb-2">
                                            <span>From</span>
                                            <input type="date" wire:model="date_from">
                                        </div>

                                        <div class="hire-date-container">
                                            <span>To</span>
                                            <input type="date" wire:model="date_to">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="filter-modal-footer">
                                <button type="button" class="secondary-btn"x-on:click="openFilterModal = false">Cancel</button>
                                <button type="submit" class="primary-btn"x-on:click="openFilterModal = false; $wire.resetPage()">Search</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <div class="section-header__right-container" x-data="{ isBulkOpen: false, openBulkModal: false, status: null }">
           
                @if(App\Helpers\CommonHelpers::isCreate('employee-accounts'))
                    <a href="{{ route('employee.create') }}" class="primary-btn" >Add User</a>
                @endif
                
                @if(App\Helpers\CommonHelpers::isUpdate('employee-accounts'))

                    <div class="relative">
                        <button  x-on:click="isBulkOpen=!isBulkOpen"  x-on:click.outside="isBulkOpen=false" class="secondary-btn">Bulk
                            Actions</button>

                        <div class="bulk-popup z-50" x-show="isBulkOpen" x-transition x-cloak>
                            <button class="bulk-content" x-on:click="openBulkModal = true; status = 'active'">
                                <i class="fa-solid fa-user-check mx-2"></i>
                                <p>Set to Active </p>
                            </button>

                            <button class="bulk-content"  x-on:click="openBulkModal = true; status = 'inactive'">
                                <i class="fa-solid fa-user-xmark mx-2"></i>
                                <p>Set to Inactive </p>
                            </button>
                        </div>
                    </div>

                    {{-- BULK ACTIONS MODAL --}}
                    <div x-show="openBulkModal" x-cloak  x-transition class="modal-container" >
                        <!-- Modal backdrop -->
                        <div class="modal-backdrop" x-on:click="openBulkModal = false">
                        </div>
                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                            </div>
                            <div class="modal-body">
                                <!-- Modal content goes here -->
                                <svg class="mx-auto mb-4 w-20 h-20 text-[#319ba5]" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <p>Are you sure that you want to set the selected user to <span x-text="status"></span>?</p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="primary-btn" x-on:click="status == 'active' ? $wire.setStatus('active') : $wire.setStatus('inactive'); openBulkModal = false">Confirm</button>
                                <button type="button" class="secondary-btn"x-on:click="openBulkModal = false">Cancel</button>
                            </div>
                        </div>
                    </div>

                @endif
           

            <div x-data="{openImportModal:false}">
                {{-- Import Btn  --}}
                <button class="primary-btn" x-on:click="openImportModal = true">Import</button>
                {{-- Import MODAL --}}
                <div x-show="openImportModal" x-cloak  x-transition class="modal-container" >
                    <!-- Modal backdrop -->
                    <div class="modal-backdrop" x-on:click="openImportModal = false">
                    </div>
                    <!-- Modal content -->
                    <div  class="export-modal-content">
                        <div class="export-modal-header">
                            <p>Import</p>
                            <button type="button" wire:click="downloadTemplate" ><span class="underline underline-offset-2 text-sm font-normal">Download Template</span></button>

                        </div>
                        <form wire:submit.prevent="import">
                            <input type='hidden' wire:model='_token' value="{{ csrf_token()}}">
                            <div  class="export-modal-body">
                                <div class="flex w-full items-center gap-2">
                                    <label>File Name:</label>
                                    <input type="file" wire:model="file_import" class='filename-input flex-1' required/>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="primary-btn" x-on:click="openImportModal = false">Import</button>
                                <button type="button" class="secondary-btn" x-on:click="openImportModal = false">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div x-data="{openExportModal:false}">
                {{-- Export Btn  --}}
                <button class="primary-btn" x-on:click="openExportModal = true">Export</button>
                {{-- EXPORT MODAL --}}
                <div x-show="openExportModal" x-cloak  x-transition class="modal-container" >
                    <!-- Modal backdrop -->
                    <div class="modal-backdrop" x-on:click="openExportModal = false">
                    </div>
                    <!-- Modal content -->
                    <div class="export-modal-content">
                        <div class="export-modal-header">
                            <p>Export</p>
                        </div>
                        <form wire:submit="export">
                            <input type='hidden' wire:model='_token' value="{{ csrf_token()}}">
                            <div class="export-modal-body">
                                <div class="flex w-full items-center gap-2">
                                    <label>File Name:</label>
                                    <input type="text" wire:model="filename" class='filename-input flex-1' required/>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="primary-btn" x-on:click="openExportModal = false">Export</button>
                                <button type="button" class="secondary-btn" x-on:click="openExportModal = false">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if (count($users) == 0)
        <div class="no-data-container">
            <p>No data available in table</p>
        </div>
    @else
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        @if(App\Helpers\CommonHelpers::isUpdate('employee-accounts'))
                            <th class="checkbox-col"><input wire:model.live="selectedAll" type="checkbox" name="" id=""></th>
                        @endif

                        <th></th>

                         @foreach ($colHeaders as $header)
                            <x-sortable-table-header
                            :colName="$header['colName']"
                            :displayName="$header['displayName']"
                            class="{{ $header['class'] }}" />
                        @endforeach

                        @if(App\Helpers\CommonHelpers::isRead('employee-accounts') || App\Helpers\CommonHelpers::isUpdate('employee-accounts'))
                            <th class="action-col">Action</th>
                        @endif
                    </tr>
                </thead>

                <tbody wire:loading.class="hidden">

                    @foreach ($users as $user)
                        <tr wire:key="{{ $user->id }}">

                            @if(App\Helpers\CommonHelpers::isUpdate('employee-accounts'))
                                @if ($selectedAll)
                                    <td class="checkbox-col">
                                        <input type="checkbox" value="{{ $user->id }}" checked>
                                    </td>
                                @else
                                    <td class="checkbox-col">
                                        <input type="checkbox" wire:model="userIds" value="{{ $user->id }}">
                                    </td>
                                @endif
                            @endif

                            <td class="image-col"><img class="user-img" src="{{$user->image ? asset('storage/' . $user->image) : asset('/images/navigation/user.png')}}" width="30"
                                    alt="{{ $user->last_name }} picture"></td>

                            <td class="first-name-col">{{ $user->first_name }}</td>
                            <td class="middle-name-col">{{ trim(strtolower($user->middle_name)) == 'n/a' ? '' : $user->middle_name }}</td>
                            <td class="last-name-col">{{ $user->last_name }}</td>
                            <td class="employee-id-col">{{ $user->employee_id }}</td>
                            <td class="email-col">{{ $user->email }} </td>
                            <td class="company-col">{{ $user->company }}</td>
                            <td class="department-col">{{ $user->department }}</td>
                            <td class="hire-location-col">{{ $user->hire_location }}</td>
                            <td class="hire-date-col">{{ $user->hire_date }}</td>
                            <td class="position-col">{{ $user->position }}</td>
                            <td class="status-col"><span class="status"
                                    @style([$user->status ? 'background: var(--active-color)' : 'background: var(--inactive-color)'])>{{ $user->status ? 'Active' : 'Inactive' }}</span>
                            </td>



                            @if(App\Helpers\CommonHelpers::isRead('employee-accounts') || App\Helpers\CommonHelpers::isUpdate('employee-accounts'))

                                <td class="action-col">

                                    <div class="table-btns">
                                        @if(App\Helpers\CommonHelpers::isRead('employee-accounts'))
                                            <a role="button" href="{{ route('employee.show', $user->id) }}"
                                                class="table-btn table-btn--blue"><i class="fa-solid fa-eye"></i></a>
                                        @endif

                                        @if(App\Helpers\CommonHelpers::isUpdate('employee-accounts'))
                                            <a role="button" href="{{ route('employee.edit', $user->id) }}"
                                                class="table-btn table-btn--green"><i class="fa-solid fa-pencil"></i></a>
                                        @endif
                                    </div>

                                </td>

                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Loading  --}}
            <div wire:loading class="loading-container">
                <svg class="animate-spin mx-auto" xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#3b5c61" d="M304 48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zm0 416a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM48 304a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm464-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM142.9 437A48 48 0 1 0 75 369.1 48 48 0 1 0 142.9 437zm0-294.2A48 48 0 1 0 75 75a48 48 0 1 0 67.9 67.9zM369.1 437A48 48 0 1 0 437 369.1 48 48 0 1 0 369.1 437z"/></svg>
            </div>
        
        </div>
    @endif


    <div class="pagination">
        {{ $users->links() }}
    </div>

</section>

@section('script')
<script>

</script>
@endsection