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
            width: 1500px;
            margin: 30px 0;
            border-collapse: collapse;
        }

        /* table column alignment */

        /* time in */

        .table th:nth-child(6) button,
        .table td:nth-child(6) {
            text-align: center;
            margin: auto;

        }

        /* time out */

        .table th:nth-child(7) button,
        .table td:nth-child(7) {
            text-align: center;
            margin: auto;

        }

        /* date */
        .table th:nth-child(8) button,
        .table td:nth-child(8) {
            text-align: center;
            margin: auto;
        }

        /* bio duration */
        .table th:nth-child(9) button,
        .table td:nth-child(9) {
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
        /* location  */
        .table th:nth-child(4), .table td:nth-child(4){
            width: 180px;
        }
        /* current location  */
        .table th:nth-child(5), .table td:nth-child(5){
            width: 180px;
        }
        /* time in  */
        .table th:nth-child(6), .table td:nth-child(6){
            width: 180px;
        }
        /* time out  */
        .table th:nth-child(7), .table td:nth-child(7){
            width: 180px;
        }
        /* date  */
        .table th:nth-child(8), .table td:nth-child(8){
            width: 150px;
        }
        /* bio duration  */
        .table th:nth-child(9), .table td:nth-child(8){
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

        .table-btn--red{
            background: #FF6174;
        }
        .table-btn--green{
            background: #0F901B;
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
            <button class="primary-btn" wire:click="openFilterModal">Filters</button>

        </div>

        <div class="flex items-center gap-2 relative ">
            <button class="primary-btn">Export</button>
        </div>
    </div>

    {{-- FILTER MODAL --}}
    <div>
        @if ($isFilterModalOpen)
            <div>
                <!-- Modal backdrop -->
                <div class="modal-backdrop"></div>

                <!-- Modal content -->
                <div class="filter-modal-content">
                    <div class="filter-modal-header">
                       <p>Filters</p>
                    </div>
                    <div class="filter-modal-body">
                        <div class="modal-body-container1">
                            <div class="filter-modal-select-container">
                                <p>Hire Location</p>
                                <div class="filter-modal-select">
                                    <select>
                                        <option>Select Location</option>
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
                                    <input type="date">
                                </div>
                                <div class="hire-date-container">
                                    <span>To</span>
                                    <input type="date">
                                </div>
                               
                            </div>
                        </div>
                        <div class="modal-body-container2">
                            <div class="filter-modal-select-container">
                                <p>Current Location</p>
                                <div class="filter-modal-select">
                                    <select>
                                        <option>Select Location</option>
                                        @foreach ($locations as $location)
                                        <option value="{{$location->location_name}}">{{$location->location_name}}</option>
                                        @endforeach
                                    </select>
                                    <img src="/images/table/asc.png" class="filter-modal-arrow-icon" alt="dropdown icon">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter-modal-footer">
                        <button type="button" class="secondary-btn" wire:click="closeFilterModal">Cancel</button>
                        <button type="button" class="primary-btn" wire:click="closeFilterModal">Search</button>  
                        <!-- Additional buttons or actions -->
                    </div>
                </div>
            </div>
        @endif
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
        
                    @include('livewire.component.module-contents.employee-logs.includes.th-sort', 
                    ['colName'=>'first_name', 'displayName' => 'First Name' ])
        
                    @include('livewire.component.module-contents.employee-logs.includes.th-sort', 
                    ['colName'=>'middle_name', 'displayName' => 'Middle Name' ])
        
                    @include('livewire.component.module-contents.employee-logs.includes.th-sort', 
                    ['colName'=>'last_name', 'displayName' => 'Last Name' ])
        
                    @include('livewire.component.module-contents.employee-logs.includes.th-sort', 
                    ['colName'=>'hire_location_id', 'displayName' => 'Location' ])
        
                    @include('livewire.component.module-contents.employee-logs.includes.th-sort', 
                    ['colName'=>'current_location_id', 'displayName' => 'Current Location' ])
        
                    @include('livewire.component.module-contents.employee-logs.includes.th-sort', 
                    ['colName'=>'time_in', 'displayName' => 'Time In' ])
        
                    @include('livewire.component.module-contents.employee-logs.includes.th-sort', 
                    ['colName'=>'time_out', 'displayName' => 'Time Out' ])
        
                    @include('livewire.component.module-contents.employee-logs.includes.th-sort', 
                    ['colName'=>'created_at', 'displayName' => 'Date' ])
        
                    @include('livewire.component.module-contents.employee-logs.includes.th-sort', 
                    ['colName'=>'time_out', 'displayName' => 'Bio Duration' ])
        
                 </tr>
                </thead>
        
                <tbody wire:loading.class="opacity-50">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->middle_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->hireLocation->location_name ?? '' }}</td>
                            <td>{{ $user->currentLocation->location_name ?? '' }}</td>
                            <td>{{ $user->time_in }}</td>
                            <td>{{ $user->time_out }}</td>
        
                            @php
                                $timeIn = \Carbon\Carbon::parse($user->time_in);
                                $timeOut = \Carbon\Carbon::parse($user->time_out);
        
                            @endphp     
        
                            <td>{{ \Carbon\Carbon::parse($user->time_in)->format('Y-m-d') }}</td>
                            <td>{{ sprintf("%02d:%02d", $timeIn->diffInHours($timeOut), $timeIn->diffInMinutes($timeOut) % 60) }}</td>
        
                        </tr>
                    @endforeach
                </tbody>
        
        
            </table>
        </div>
    @endif
    <div class="pagination">
    {{ $users->links() }}
    </div>
</section>
