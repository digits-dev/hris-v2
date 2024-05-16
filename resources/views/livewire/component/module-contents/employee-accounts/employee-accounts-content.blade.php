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
        /* role */
        
        .table th:nth-child(8), .table td:nth-child(8){
            text-align: center;
        }
        /* status */
        .table th:nth-child(9), .table td:nth-child(9){
            text-align: center;

        }

        
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

        /* checkbox  */
        .table th:nth-child(1), .table td:nth-child(1){
            width:1%;
        }
        /* image  */
        .table th:nth-child(2), .table td:nth-child(2){
            width:4%;
        }
        /* name */
        .table th:nth-child(3), .table td:nth-child(3){
            width:10%;
        }
        /* employee id */
        .table th:nth-child(4), .table td:nth-child(4){
            width:10%;
        }
        /* email address */
        .table th:nth-child(5), .table td:nth-child(5){
            width:15%;
        }
        /* location */
        .table th:nth-child(6), .table td:nth-child(6){
            width:10%;
        }
        .table th:nth-child(7), .table td:nth-child(7){
            width:15%;
        }
        /* role */
        .table th:nth-child(8), .table td:nth-child(8){
            width:10%;
        }
        /* status */
        .table th:nth-child(9), .table td:nth-child(9){
            width:10%;
        }
        /* action */
        .table th:nth-child(10), .table td:nth-child(10){
            width:4%;
        }

        /* End of Table Column Widths  */
        
        .table input {
            display: inline-block;
        }

        ::placeholder {
            color: var(--primary-color);
            font-weight: 500;
        }

        .add-btn {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            border-radius: 8px;
            font-size: 12px;
            border: 2px solid var(--stroke-color);
            padding: 10px 20px;
            cursor: pointer;
        }

        
        .add-btn:hover{
            opacity: 0.9;
        }

        .bulk-btn {
            background-color:white;
            color: var(--primary-color);
            font-weight: 600;
            border-radius: 8px;
            font-size: 12px;
            border: 1px solid var(--stroke-color);
            padding: 10px 20px;
            cursor: pointer;
        }

        .bulk-btn:hover{
            background: var(--primary-hover);
            opacity: 0.9;
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

        .table-btn--blue{
            background: #2196F3;
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
    {{-- <h1 class="module inter">User Management</h1> --}}

    <div class="header">
        <div  class="search-form">
            <label for="search-input" class="search-form__label ">Search</label>
            <input wire:model.live.debounce.300ms="search" type="text" class="search-form__input " placeholder="Search User" id="search-input">
        </div>


        <div class="flex gap-2 ">
        <a href="{{route('employee.create')}}" class="add-btn" wire:navigate>Add User</a>
        <button  class="bulk-btn" >Bulk Actions</button>

        </div>
    </div>

    <table class="table">
        <thead>
         <tr>
            <th><input type="checkbox" name="" id=""></th>
            <th></th>

            @include('livewire.component.module-contents.employee-accounts.includes.th-sort', 
            ['colName'=>'full_name', 'displayName' => 'Name' ])

            @include('livewire.component.module-contents.employee-accounts.includes.th-sort', 
            ['colName'=>'employee_id', 'displayName' => 'Employee Id' ])

            @include('livewire.component.module-contents.employee-accounts.includes.th-sort', 
            ['colName'=>'email', 'displayName' => 'Email' ])

            @include('livewire.component.module-contents.employee-accounts.includes.th-sort', 
            ['colName'=>'location', 'displayName' => 'Location' ])

            @include('livewire.component.module-contents.employee-accounts.includes.th-sort', 
            ['colName'=>'company', 'displayName' => 'Company' ])

            <th > <Button class="th-sort  mx-auto">Role
                   <img src="/images/table/sort.png" width="10" alt="sorting icons">
                </Button> 
            </th>
            <th > <Button class="th-sort mx-auto">Status
                   <img src="/images/table/sort.png" width="10" alt="sorting icons">
                </Button> 
            </th>
            <th>Action</th>
         </tr>
        </thead>

      
        
        <tbody>
            @foreach ($users as $user)
                <tr wire:key="{{$user->id}}">
                    <td>
                        <input id="terms" type="checkbox" value=""  required />
                    </td>
                    <td><img class="user-img" src="/images/navigation/user.png" width="40" alt="{{$user->last_name}} picture"></td>
                    <td>{{ $user->full_name}}</td>
                    <td>{{ $user->employee_id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->location }}</td>
                    <td>{{ $user->company }}</td>
                    <td><span class="role">Employee</span></td>
                    <td><span class="status">Active</span></td>
                    <td>
                       <div class="tbl-btns">
                        <a role="button" href="{{route('employee.show', $user->id)}}" class="table-btn table-btn--blue"><i class="fa-solid fa-eye"></i></a>
                        <a role="button" href="{{route('employee.edit', $user->id)}}" class="table-btn table-btn--green"><i class="fa-solid fa-pencil"></i></a>
                       </div>

                    </td>

                </tr>
            @endforeach
        </tbody>


    </table>

    <div class="pagination">
    {{ $users->links() }}

    </div>
</section>
