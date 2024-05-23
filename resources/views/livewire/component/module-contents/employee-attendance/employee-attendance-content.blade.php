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
            <button class="primary-btn">Filters</button>

        </div>

        <div class="flex items-center gap-2 relative ">
            <button class="primary-btn">Export</button>
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
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'first_name', 'displayName' => 'First Name' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'middle_name', 'displayName' => 'Middle Name' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'last_name', 'displayName' => 'Last Name' ])

                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'company_id', 'displayName' => 'Company' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'hire_location_id', 'displayName' => 'Hire Location' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'current_location_id', 'displayName' => 'Time in Location/s' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'time_in', 'displayName' => 'First Time In' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'time_out', 'displayName' => 'Last Time Out' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'created_at', 'displayName' => 'Date' ])
        
                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'time_out', 'displayName' => 'Bio Duration' ])

                    @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
                    ['colName'=>'time_out', 'displayName' => 'FILO Duration' ])

                    <th>Action</th>
        
                 </tr>
                </thead>
        
                <tbody wire:loading.class="opacity-50">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->middle_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->company->company_name ?? '' }}</td>
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
                            <td>{{ sprintf("%02d:%02d", $timeIn->diffInHours($timeOut), $timeIn->diffInMinutes($timeOut) % 60) }}</td>
                            <td>
                                <div class="tbl-btns">
                                    <a role="button" href="{{ route('employee-attendance.show', $user->id) }}"
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
    {{ $users->links() }}
    </div>
</section>
