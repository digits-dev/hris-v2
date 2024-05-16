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
            justify-content: space-between;
            align-items: center;
        }


        .search-form {
            border-radius: 8px;
            display: flex;
            gap: 5px;
            border: 1px solid var(--stroke-color);
            width: 500px;
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


        .table {
            width: 100%;
            margin: 30px 0;
            gap: 0;
            /* border: 1px solid black; */
            border-collapse: collapse;
            text-align: left;
        }

        /* Adjust Table Column Text Alignment  */

        /* Time In */
        .table th:nth-child(4) button, .table td:nth-child(4){
            text-align: center;
            margin: auto
        }
        /* Time Out */
        .table th:nth-child(5) button, .table td:nth-child(5){
            text-align: center;
            margin: auto
        }
        /* Date */
        .table th:nth-child(6) button, .table td:nth-child(6){
            text-align: center;
            margin: auto

        }
        /* Duration */
        .table th:nth-child(7) button, .table td:nth-child(7){
            text-align: center;
            margin: auto

        }
      
        /* End of Table Column Text Alignment  */
        
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

        /* Checkbox  */
        .table th:nth-child(1), .table td:nth-child(1){
            width:5%;
        }
    
        /* First Name */
        .table th:nth-child(2), .table td:nth-child(2){
            width:15%;
        }
        /* Last Name */
        .table th:nth-child(3), .table td:nth-child(3){
            width:15%;
        }
        /* Time In */
        .table th:nth-child(4), .table td:nth-child(4){
            width:15%;
        }
        /* Time Out */
        .table th:nth-child(5), .table td:nth-child(5){
            width:15%;
        }
        /*   Date   */
        .table th:nth-child(6), .table td:nth-child(6){
            width:15%;
        }
        /*  Duration  */
        .table th:nth-child(7), .table td:nth-child(7){
            width:10%;
        }
        /*  Action  */
        .table th:nth-child(8), .table td:nth-child(8){
            width:10%;
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
 

    
    </style>
@endsection

<section>

    <div class="header">
          <div  class="search-form">
            <label for="search-input" class="search-form__label ">Search</label>
            <input wire:model.live.debounce.300ms="search" type="text" class="search-form__input " placeholder="Search User" id="search-input">
        </div>
    </div>

    <table class="table">
        <thead>
         <tr>
            <th><input type="checkbox" name="" id=""></th>

            @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
            ['colName'=>'first_name', 'displayName' => 'First Name' ])

            @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
            ['colName'=>'last_name', 'displayName' => 'Last Name' ])

            @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
            ['colName'=>'time_in', 'displayName' => 'Time In' ])

            @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
            ['colName'=>'time_out', 'displayName' => 'Time Out' ])

            @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
            ['colName'=>'created_at', 'displayName' => 'Date' ])

            @include('livewire.component.module-contents.employee-attendance.includes.th-sort', 
            ['colName'=>'time_out', 'displayName' => 'Duration' ])

            <th>Action</th>
         </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>
                        <input id="terms" type="checkbox" value=""  required />
                    </td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->time_in }}</td>
                    <td>{{ $user->time_out }}</td>

                    @php
                        $timeIn = \Carbon\Carbon::parse($user->time_in);
                        $timeOut = \Carbon\Carbon::parse($user->time_out);

                    @endphp     

                    <td>{{ \Carbon\Carbon::parse($user->time_in)->format('Y-m-d') }}</td>
                    <td>{{ sprintf("%02d:%02d", $timeIn->diffInHours($timeOut), $timeIn->diffInMinutes($timeOut) % 60) }}</td>

                    <td>
                       <div class="tbl-btns">
                        <button class="table-btn table-btn--green"><i class="fa-solid fa-pencil"></i></button>
                        <button class="table-btn table-btn--red"><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>


    </table>
    <div class="pagination">
    {{ $users->links() }}
    </div>
</section>
