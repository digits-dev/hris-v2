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
            font-size: 20px;
            font-weight: bold;
            font-family: "Inter", sans-serif;

        }

        .pagination{
            margin-top: auto;
        }

        .inter {
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: bold;
            font-style: normal;
            font-variation-settings:
                "slnt" 0;
        }

        .header {
            display: flex;
            flex-direction: column;
            gap: 20px;
            justify-content: space-between;
            align-items: center;
        }

        @media screen and (min-width: 1100px) {
            .header {
                flex-direction: row;
                align-items: flex-start;
            }
        }

        .header__left-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            width: 100%;
            max-width: 550px;
        }

        .search-form {
            border-radius: 8px;
            display: flex;
            gap: 5px;
            border: 1px solid var(--stroke-color);
            width: 100%;
            overflow: hidden;
        }

        .search-form__label {
            background: var(--primary-color);
            color: white;
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 3px;
            border-top-right-radius: unset;
            border-bottom-right-radius: unset;
            border: 1px solid var(--stroke-color);
            border-right: 2px solid var(--stroke-color);
            font-weight: 500;
            font-family: "Inter", sans-serif;
            display: grid;
            place-content: center;

        }

        .search-form__input {
            padding: 10px;
            outline: none;
            border: none;
            font-weight: normal;
            font-size: 14px;
            flex: 1;
        }

        .custom-select {
            position: relative;
            width: 65px;
            min-width: 65px;
            height: 40px;
        }

        .custom-select select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding: 9px;
            font-size: 14px;
            outline: none;
            font-family: "Inter", sans-serif;
            border: 1px solid var(--stroke-color);
            color: var(--primary-color);
            border-radius: 8px;
            background-color: #fff;
            width: 100%;
            cursor: pointer;
        }

        .arrow-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-20%);
            width: 10px;
            height: 10px;
            pointer-events: none;
        }


        .table-container {
            width:100%;
            max-width: 1500px;
            overflow-y: hidden;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            margin-bottom: 30px;
        }

        .table {
            width: 2000px;
            margin: 30px 0;
            border-collapse: collapse;
        }

        /* table column alignment */

        /* time in */

        .table th:nth-child(7) button,
        .table td:nth-child(7) {
            text-align: center;
            margin: auto;

        }

        /* time out */

        .table th:nth-child(8) button,
        .table td:nth-child(8) {
            text-align: center;
            margin: auto;

        }

        /* date */
        .table th:nth-child(9) button,
        .table td:nth-child(9) {
            text-align: center;
            margin: auto;
        }

        /* bio duration */
        .table th:nth-child(10) button,
        .table td:nth-child(10) {
            text-align: center;
            margin: auto;
        }
        /* filo duration */
        .table th:nth-child(11) button,
        .table td:nth-child(11) {
            text-align: center;
            margin: auto;
        }
        /* bio duration */
        .table th:nth-child(12) button,
        .table td:nth-child(12) {
            text-align: center;
            margin: auto;
        }

        /* end of table column alignment */

        .table thead {
            background: var(--secondary-color);
        }

        .table th {
            color: var(--primary-text);
            font-weight: bold;
            font-family: "Inter", sans-serif;
            padding: 12px 10px;
            font-size:13px;
        }

        .table thead tr{
            border-bottom: unset;
            border-radius: 10px;
        }

        .table tr{
            color: var(--primary-text);
            font-weight: 600;
            font-family: "Inter", sans-serif;
            border-bottom: 0.1px solid var(--stroke-color);
        }
        .table tbody tr:hover{
            background-color: var(--primary-hover);
        }

        .table td{
            color: var(--primary-text);
            font-weight: 500;
            font-family: "Inter", sans-serif;
            padding: 10px;
            font-size: 12px;
        }

        /* Table Column Widths  */

        /* first name  */
        .table th:nth-child(1), .table td:nth-child(1){
           width: 150px;
        }
    
        /* middle name  */
        .table th:nth-child(2), .table td:nth-child(2){
            width: 150px;
        }
        /* last name  */
        .table th:nth-child(3), .table td:nth-child(3){
            width: 150px;
        }
        /* company  */
        .table th:nth-child(4), .table td:nth-child(4){
            width: 180px;
        }
        /* hire location  */
        .table th:nth-child(5), .table td:nth-child(5){
            width: 180px;
        }
        /* time in locations  */
        .table th:nth-child(6), .table td:nth-child(6){
            width: 180px;
        }
        /* first time in  */
        .table th:nth-child(7), .table td:nth-child(7){
            width: 180px;
        }
        /* last time out  */
        .table th:nth-child(8), .table td:nth-child(8){
            width: 150px;
        }
        /* date  */
        .table th:nth-child(9), .table td:nth-child(9){
            width: 120px;
        }
        /* bio duration  */
        .table th:nth-child(10), .table td:nth-child(10){
            width: 120px;
        }
        /* filo duration  */
        .table th:nth-child(11), .table td:nth-child(11){
            width: 120px;
        }
        /* action  */
        .table th:nth-child(12), .table td:nth-child(12){
            width: 120px;
        }

        /* End of Table Column Widths  */
        
        .table input {
            display: inline-block;
        }

        ::placeholder {
            color: var(--primary-color);
            font-weight: 500;
        }

        input[type="checkbox"] {
            -webkit-appearance: none; /* Remove default appearance */
            -moz-appearance: none;
            background-color: white; /* Background color when checked */
            appearance: none;
            margin-top: 5px;
            width: 15px;
            height: 15px;
            border: 2px solid var(--stroke-color); /* Default border color */
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;
        }
        /* Custom checkbox when checked */
        input[type="checkbox"]:checked {
            background-color:var(--primary-color); /* Background color when checked */
            padding: 5px;

        }
        /* Custom checkbox when checked - checkmark */
        input[type="checkbox"]:checked::after {
            content: "\2714"; /* Checkmark symbol */
            color: white; /* Color of the checkmark */
            font-size: 8px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .tbl-btns{
            display: flex;
            justify-content: center;
        }
        .table-btn{
            height: 25px;
            width: 25px;
            border-radius: 5px;
            display: grid;
            place-content: center;
            font-size: 10px;
            color: white;
            border: 2px solid var(--secondary-color);
        }


        .table-btn--blue {
            background: #2196F3;
        }


        .user-img{
            display: inline-block;
            width: 30px;
            height: 30px;
            margin: auto;
        }

        .role{
            background: var(--primary-color);
            color:white;
            padding: 5px 20px;
            border-radius: 15px;
            border: 2px solid var(--stroke-color);
        }

        .status{
            background: var(--tertiary-color);
            color:white;
            padding: 5px 20px;
            border-radius: 15px;
            border: 2px solid var(--stroke-color);
        }

    .th-sort{
     display: flex; 
     align-items: center;
     justify-content: center;
     gap:10px;
    }
 
    .no-data-container {
            width: 100%;
            padding: 50px 0;
            text-align: center;
            margin-top: 40px;
            background-color: rgb(243 244 246);
            font-weight: 600;
            border-radius: 5px;
            color: var(--primary-color);
            font-family: "Inter", sans-serif;
    }

    .primary-btn {
        background-color: var(--primary-color);
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
            color: var(--primary-color);
            font-weight: 600;
            border-radius: 8px;
            font-size: 12px;
            border: 1px solid var(--stroke-color);
            padding: 10px 20px;
            cursor: pointer;
        }

    .secondary-btn:hover {
        background: var(--primary-hover);
        opacity: 0.9;
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
            justify-content: flex-start; 
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
        

        .filter-modal-select select {
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

        .filter-modal-arrow-icon {
            position: absolute;
            top: 60%;
            right: 15px;
            transform: translateY(-50%);
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

    
    </style>
@endsection

<section>
    <div class="header ">
        <div class="header__left-container">
            <div class="search-form">
                <label for="search-input" class="search-form__label ">Search</label>
                <input wire:model.live.debounce.300ms="search" type="text" class="search-form__input "
                    placeholder="Search User" id="search-input">
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
            <button class="primary-btn" @click="$dispatch('toggle-filter-modal', true)">Filters</button>

        </div>

        <div class="flex items-center gap-2 relative ">
            <button class="primary-btn" @click="$dispatch('toggle-filter-export-modal', true)">Export</button>
        </div>
    </div>

    {{-- FILTER MODAL --}}
    <div x-data="{ isFilterModalOpen: false }" x-on:toggle-filter-modal.window="isFilterModalOpen = $event.detail">
        <div x-show="isFilterModalOpen" x-cloak>
            <!-- Modal backdrop -->
            <div class="modal-backdrop"></div>

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
                                        <option>Select Company</option>
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
                                    <select wire:model="hire_location">
                                        <option>Select Location</option>
                                        @foreach ($locations as $location)
                                            <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                                        @endforeach
                                    </select>
                                    <img src="/images/table/asc.png" class="filter-modal-arrow-icon" alt="dropdown icon">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body-container2">
                            <div class="filter-modal-select-container">
                                <p>Time in Location/s</p>
                                <div class="filter-modal-select">
                                    <select wire:model="time_in_location">
                                        <option>Select Time in Location/s</option>
                                        @foreach ($locations as $location)
                                            <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                                        @endforeach
                                    </select>
                                    <img src="/images/table/asc.png" class="filter-modal-arrow-icon" alt="dropdown icon">
                                </div>
                            </div>

                            <div class="filter-modal-select-container">
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
                        <button type="button" class="secondary-btn" @click="$dispatch('toggle-filter-modal', false)">Cancel</button>
                        <button type="submit" class="primary-btn" @click="$dispatch('toggle-filter-modal', false)">Search</button>  
                        <!-- Additional buttons or actions -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Export Modal --}}
     <div x-data="{ isFilterExportModalOpen: false }" x-on:toggle-filter-export-modal.window="isFilterExportModalOpen = $event.detail">
        <div x-show="isFilterExportModalOpen" x-cloak>
            <div class="modal-backdrop"></div>
            <!-- Modal content -->
            <div class="filter-modal-content">
                <div class="filter-modal-header">
                    <p>Export</p>
                </div>
                <form wire:submit="exportFilter">
                    <input type='hidden' wire:model='_token' value="{{ csrf_token()}}">
                    @if($isFilter == 1)
                        <input type="text" wire:model="company_id" value="{{$company_id}}" />
                        <input type="text" wire:model="hire_location" value="{{$hire_location}}" />
                    @endif
                    <div class="filter-modal-body">
                        <div class="modal-body-container1">
                            <div class="filter-modal-select-container">
                                <div class="filter-modal-select">
                                    <label>File Name</label>
                                    <input type="text" wire:model="filename" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="filter-modal-footer">
                        <button type="button" class="secondary-btn" @click="$dispatch('toggle-filter-export-modal', false)">Cancel</button>
                        <button type="submit" class="secondary-btn" @click="$dispatch('toggle-filter-export-modal', false)">Export</button>
                        <!-- Additional buttons or actions -->
                    </div>
                </form>
            </div>
        </div>
     </div>

    @if (count($employeeLogs) == 0)
        <div class="no-data-container">
            <p>No data available in table</p>
        </div>
    @else
        <div class="table-container">
            <table class="table">
                <thead>
                 <tr>
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'first_name', 'displayName' => 'First Name' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'middle_name', 'displayName' => 'Middle Name' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'last_name', 'displayName' => 'Last Name' ])

                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'company', 'displayName' => 'Company' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'hire_location', 'displayName' => 'Hire Location' ])
        
                    {{-- @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'current_location_id', 'displayName' => 'Time in Location/s' ]) --}}

                    <th class="text-left">Time in Location/s</th>
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'first_clock_in', 'displayName' => 'First Time In' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'last_clock_out', 'displayName' => 'Last Time Out' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'date', 'displayName' => 'Date' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'total_time_bio_diff', 'displayName' => 'Bio Duration' ])

                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'total_time_filo_diff', 'displayName' => 'FILO Duration' ])

                    <th>Action</th>
        
                 </tr>
                </thead>
        
                <tbody wire:loading.class="opacity-50">
                    @foreach ($employeeLogs as $employeeLog)
                        <tr>
                            <td>{{ $employeeLog->first_name }}</td>
                            <td>{{ $employeeLog->middle_name }}</td>
                            <td>{{ $employeeLog->last_name }}</td>
                            <td>{{ $employeeLog->company ?? '' }}</td>
                            <td>{{ $employeeLog->hire_location ?? '' }}</td>

                            {{-- Time in Location  --}}
                            <td>
                                @php
                                    $currentLocationIdsIn = explode(",", $employeeLog->combined_terminal_in_ids);
                                    $currentLocationIdsOut = explode(",", $employeeLog->combined_terminal_out_ids);
                                    $allLocations = array_merge($currentLocationIdsIn, $currentLocationIdsOut);
                                @endphp
                                
                                @foreach ($locations as $location)
                                    @if (in_array($location->id, $currentLocationIdsIn))
                                        @if ($loop->last)
                                        {{ $location->location_name }}
                                        @else
                                        {{ $location->location_name }}, 
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                            {{-- Time out Location  --}}
                            {{-- <td>
                                @php
                                    $currentLocationIdsOut = explode(",", $employeeLog->combined_terminal_out_ids);
                                @endphp
                                
                                @foreach ($locations as $location)
                                    @if (in_array($location->id, $currentLocationIdsOut))
                                        @if ($loop->last)
                                        {{ $location->location_name }}
                                        @else
                                        {{ $location->location_name }}, 
                                        @endif
                                    @endif
                                @endforeach
                            </td> --}}


                            <td>{{ $employeeLog->first_clock_in }}</td>
                            <td>{{ $employeeLog->last_clock_out }}</td>
                            <td>{{ $employeeLog->date }}</td>
                            <td>{{ $employeeLog->total_time_bio_diff }}</td>
                            <td>{{ $employeeLog->total_time_filo_diff }}</td>
                            <td>
                                <div class="tbl-btns">
                                    <a role="button" href="{{ route('employee-attendance.show', $employeeLog->employee_id) }}"
                                        class="table-btn table-btn--blue"><i class="fa-solid fa-eye"></i></a>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
        
        
            </table>
        </div>
    @endif
    <div class="pagination">
    {{ $employeeLogs->links() }}
    </div>
</section>
