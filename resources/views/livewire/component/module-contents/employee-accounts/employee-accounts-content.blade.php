@section('css')
    <style>
        :root {
            --primary-color: #1F6268;
            --stroke-color: #599297;
            --secondary-color: #cbfaff;
            --primary-text: #113437;
            --primary-hover: #DDFAFD;
            --tertiary-color: #27C1CE;
            --active-color: #20921e;
            --inactive-color: #e13333;
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

        .pagination {
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
            width:2000px;
            margin: 30px 0;
            border-collapse: collapse;
            text-align: left;
        }

        /* checkbox */

        .table th:nth-child(1),
        .table td:nth-child(1) {
            text-align: center;
        }


        .table th:nth-child(10) button,
        .table td:nth-child(10) {
            text-align: center;
            margin:auto;
        }
      

        .table th:nth-child(11) button,
        .table td:nth-child(11) {
            text-align: center;
            margin:auto;
        }

 
        .table th:nth-child(12) button,
        .table td:nth-child(12) {
            text-align: center;
            margin: auto;
        }

        .table thead {
            background: var(--secondary-color);

        }

        .table th {
            color: var(--primary-text);
            font-weight: bold;
            font-family: "Inter", sans-serif;
            padding: 12px 10px;
            font-size: 13px;
            box-sizing: border-box;
        }

        .table thead tr {
            border-bottom: unset;
            border-radius: 10px;
        }

        .table tr {
            color: var(--primary-text);
            font-weight: 600;
            font-family: "Inter", sans-serif;
            border-bottom: 0.1px solid var(--stroke-color);
        }

        .table tbody tr:hover {
            background-color: var(--primary-hover);
        }

        .table td {
            color: var(--primary-text);
            font-weight: 500;
            font-family: "Inter", sans-serif;
            padding: 10px;
            font-size: 12px;
            box-sizing: border-box;
        }

        /* Table Column Widths  */

        /* checkbox  */
        .table th:nth-child(1),
        .table td:nth-child(1) {
            width:50px;
            width:auto;
        }

        /* image  */
        .table th:nth-child(2),
        .table td:nth-child(2) {
            width:60px;
            width:auto;
        }

        /* first name */
        .table th:nth-child(3),
        .table td:nth-child(3) {
            width:130px;
            width:auto;
        }

        /* middle name */
        .table th:nth-child(4),
        .table td:nth-child(4) {
            width:140px;
            width:auto;
        }

        /* last name */
        .table th:nth-child(5),
        .table td:nth-child(5) {
            width:130px;
            width:auto;
        }

        /* employee id */
        .table th:nth-child(6),
        .table td:nth-child(6) {
            width:150px;
            width:auto;
        }

        /* email address */
        .table th:nth-child(7),
        .table td:nth-child(7) {
            width:120px;
            width:auto;
        }

        /* company */
        .table th:nth-child(8),
        .table td:nth-child(8) {
            width:150px;
            width:auto;
        }

        /* hire location */
        .table th:nth-child(9),
        .table td:nth-child(9) {
            width:150px;
            width:auto;
        }

        /* hire date */
        .table th:nth-child(10),
        .table td:nth-child(10) {
            width:100px;
            width:auto;
        }
        /* position */
        .table th:nth-child(11),
        .table td:nth-child(11) {
            width:100px;
            width:auto;
        }

        /* status */
        .table th:nth-child(12),
        .table td:nth-child(12) {
            width:100px;
            width:auto;
        }

        /* action */
        .table th:nth-child(13),
        .table td:nth-child(13) {
            width:100px;
            width:auto;
        }

        /* End of Table Column Widths  */

        .table input {
            display: inline-block;
        }

        ::placeholder {
            color: var(--primary-color);
            font-weight: 500;
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

        input[type="checkbox"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: white;
            appearance: none;
            margin-top: 5px;
            width: 15px;
            height: 15px;
            border: 2px solid var(--stroke-color);
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;
        }

        /* Custom checkbox when checked */
        input[type="checkbox"]:checked {
            background-color: var(--primary-color);
            padding: 5px;

        }

        /* Custom checkbox when checked - checkmark */
        input[type="checkbox"]:checked::after {
            content: "\2714";
            color: white;
            font-size: 8px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            visibility: hidden;
        }

        input[type="checkbox"]:checked::after {
            visibility: visible;
        }

        .tbl-btns {
            display: flex;
        }

        .table-btn {
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

        .table-btn--green {
            background: #0F901B;
        }

        .user-img {
            display: block;
            width: 30px;
            height: 30px;
            margin: auto;
            border-radius: 100%;
            overflow: hidden;
            object-fit: cover;
            display: grid;
            place-content: center;
        }

        .role {
            background: var(--primary-color);
            color: white;
            padding: 5px 20px;
            border-radius: 15px;
            border: 2px solid var(--stroke-color);
        }

        .status{
            color:white;
            padding: 5px 15px;
            border-radius: 20px;
            border: 2px solid rgba(0,0,0,0.3);
        }

        .th-sort {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .bulk-popup {
            display: flex;
            flex-direction: column;
            position: absolute;
            width: 200px;
            background-color: white;
            top: 0;
            right: 0;
            border-radius: 8px;
            margin-top: 60px;
            margin-right: 10px;
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

        .export-modal-header p {
            font-size: 18px;
            color: #113437;
            font-family: "Inter", sans-serif;
            font-weight: bold;
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
    <div class="header ">
        <div class="header__left-container">
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
                                            <select wire:model="position">
                                                <option value="">Select Position</option>
                                                @foreach ($positions as $position)
                                                <option value="{{$position->id}}">{{$position->position_name}}</option>
                                                @endforeach
                                            </select>
                                            <img src="/images/table/asc.png" class="filter-modal-arrow-icon" alt="dropdown icon">
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
                                <!-- Additional buttons or actions -->
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <div class="flex items-center gap-2 relative " x-data="{ isBulkOpen: false, openBulkModal: false, status: null }">
                @if(App\Helpers\CommonHelpers::isCreate())
                
                    <a href="{{ route('employee.create') }}" class="primary-btn">Add User</a>

                @endif

                @if(App\Helpers\CommonHelpers::isUpdate())

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
                                <button type="button" class="primary-btn" x-on:click="status == 'active' ? $wire.setToActive() : $wire.setToInactive(); openBulkModal = false">Confirm</button>
                                <button type="button" class="secondary-btn"x-on:click="openBulkModal = false">Cancel</button>
                            </div>
                        </div>
                    </div>

                @endif
     


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
                                <div class="  flex w-full items-center gap-2">
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
                        @if(App\Helpers\CommonHelpers::isUpdate())
                            <th><input wire:model.live="selectedAll" type="checkbox" name="" id=""></th>
                        @endif

                        <th></th>

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'first_name',
                            'displayName' => 'First Name'
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'middle_name',
                            'displayName' => 'Middle Name'
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'last_name',
                            'displayName' => 'Last Name'
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'employee_id',
                            'displayName' => 'Employee Id'
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'email',
                            'displayName' => 'Email Address'
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'company',
                            'displayName' => 'Company'
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'hire_location',
                            'displayName' => 'Hire Location'
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'hire_date',
                            'displayName' => 'Hire Date'
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'position',
                            'displayName' => 'Position',
                            'addClass' => 'mx-auto'
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'status',
                            'displayName' => 'Status',
                            'addClass' => 'mx-auto'
                        ])

                        @if(App\Helpers\CommonHelpers::isRead() || App\Helpers\CommonHelpers::isUpdate())
                        
                        <th>Action</th>

                        @endif
                    </tr>
                </thead>


                <tbody wire:loading.class="opacity-50">
                    @foreach ($users as $user)
                        <tr wire:key="{{ $user->id }}">

                            @if(App\Helpers\CommonHelpers::isUpdate())
                                @if ($selectedAll)
                                    <td>
                                        <input type="checkbox" value="{{ $user->id }}" checked>
                                    </td>
                                @else
                                    <td>
                                        <input type="checkbox" wire:model="userIds" value="{{ $user->id }}">
                                    </td>
                                @endif
                            @endif

                            <td><img class="user-img" src="{{$user->image ? asset('storage/' . $user->image) : asset('/images/navigation/user.png')}}" width="30"
                                    alt="{{ $user->last_name }} picture"></td>
                                    
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->middle_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->employee_id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->company }}</td>
                            <td>{{ $user->hire_location }}</td>
                            <td>{{ $user->hire_date }}</td>
                            <td><span class="role">{{ $user->position }}</span></td>
                            {{-- <td><span class="role">Employee</span></td> --}}

                            <td><span class="status"
                                    @style([$user->status ? 'background: var(--active-color)' : 'background: var(--inactive-color)'])>{{ $user->status ? 'Active' : 'Inactive' }}</span>
                            </td>

                     

                            @if(App\Helpers\CommonHelpers::isRead() || App\Helpers\CommonHelpers::isUpdate())

                            <td>
                             
                                    <div class="tbl-btns">
                                        @if(App\Helpers\CommonHelpers::isRead())
                                            <a role="button" href="{{ route('employee.show', $user->id) }}"
                                                class="table-btn table-btn--blue"><i class="fa-solid fa-eye"></i></a>
                                        @endif

                                        @if(App\Helpers\CommonHelpers::isUpdate())
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
        </div>
    @endif


    <div class="pagination">
        {{ $users->links() }}

    </div>

</section>
