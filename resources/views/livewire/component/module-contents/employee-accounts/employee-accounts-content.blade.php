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

        /* position */

        .table th:nth-child(11),
        .table td:nth-child(11) {
            text-align: center;
        }

        /* status */
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
        }

        /* image  */
        .table th:nth-child(2),
        .table td:nth-child(2) {
            width:60px;
        }

        /* first name */
        .table th:nth-child(3),
        .table td:nth-child(3) {
            width:130px;
        }

        /* middle name */
        .table th:nth-child(4),
        .table td:nth-child(4) {
            width:140px;
        }

        /* last name */
        .table th:nth-child(5),
        .table td:nth-child(5) {
            width:130px;
        }

        /* employee id */
        .table th:nth-child(6),
        .table td:nth-child(6) {
            width:150px;
        }

        /* email address */
        .table th:nth-child(7),
        .table td:nth-child(7) {
            width:120px;
        }

        /* company */
        .table th:nth-child(8),
        .table td:nth-child(8) {
            width:150px;
        }

        /* hire location */
        .table th:nth-child(9),
        .table td:nth-child(9) {
            width:150px;
        }

        /* hire date */
        .table th:nth-child(10),
        .table td:nth-child(10) {
            width:150px;
        }
        /* position */
        .table th:nth-child(11),
        .table td:nth-child(11) {
            width:100px;
        }

        /* status */
        .table th:nth-child(12),
        .table td:nth-child(12) {
            width:100px;
        }

        /* action */
        .table th:nth-child(13),
        .table td:nth-child(13) {
            width:100px;
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
        }

        .role {
            background: var(--primary-color);
            color: white;
            padding: 5px 20px;
            border-radius: 15px;
            border: 2px solid var(--stroke-color);
        }

        .status {
            color: white;
            padding: 5px 20px;
            border-radius: 15px;
            border: 2px solid var(--stroke-color);
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


        /* Modal Style  */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
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

        .close {
            cursor: pointer;
            margin-left: auto;
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

        <div class="flex items-center gap-2 relative " x-data="{ isBulkOpen: false }">
            <a href="{{ route('employee.create') }}" class="primary-btn" wire:navigate>Add User</a>

            <button @click="isBulkOpen=!isBulkOpen" @click.outside="isBulkOpen=false" class="secondary-btn">Bulk
                Actions</button>
            <div class="bulk-popup z-50" x-show="isBulkOpen" x-transition x-cloak>
                <button class="bulk-content" wire:click="openModal('active')">
                    <i class="fa-solid fa-user-check mx-2"></i>
                    <p>Set to Active </p>
                </button>

                <button class="bulk-content" wire:click="openModal('inactive')">
                    <i class="fa-solid fa-user-xmark mx-2"></i>
                    <p>Set to Inactive </p>
                </button>
            </div>
           
            <button class="primary-btn">Export</button>
        </div>
    </div>


    <div>

        @if ($isModalOpen)
            <div>
                <!-- Modal backdrop -->
                <div class="modal-backdrop" wire:click="closeModal"></div>

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
                        <p>Are you sure that you want to set the selected @if (count($userIds) > 1)
                                users
                            @else
                                user
                            @endif to {{ $setTo }}?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="primary-btn" wire:click="{{ $statusFnc }}">Confirm</button>
                        <button type="button" class="secondary-btn" wire:click="closeModal">Cancel</button>
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
                        <th><input wire:model.live="selectedAll" type="checkbox" name="" id=""></th>
                        <th></th>

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'first_name',
                            'displayName' => 'First Name',
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'middle_name',
                            'displayName' => 'Middle Name',
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'last_name',
                            'displayName' => 'Last Name',
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'employee_id',
                            'displayName' => 'Employee Id',
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'email',
                            'displayName' => 'Email Address',
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'company',
                            'displayName' => 'Company',
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'hire_location',
                            'displayName' => 'Hire Location',
                        ])

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'hire_date',
                            'displayName' => 'Hire Date',
                        ])

                        <th> <Button class="th-sort  mx-auto">Position
                                <img src="/images/table/sort.png" width="10" alt="sorting icons">
                            </Button>
                        </th>

                        @include('livewire.component.module-contents.employee-accounts.includes.th-sort', [
                            'colName' => 'status',
                            'displayName' => 'Status',
                        ])

                        <th>Action</th>
                    </tr>
                </thead>

                <tbody wire:loading.class="opacity-50">
                    @foreach ($users as $user)
                        <tr wire:key="{{ $user->id }}">

                            @if ($selectedAll)
                                <td>
                                    <input type="checkbox" value="{{ $user->id }}" checked>
                                </td>
                            @else
                                <td>
                                    <input type="checkbox" wire:model="userIds" value="{{ $user->id }}">
                                </td>
                            @endif

                            <td><img class="user-img" src="{{ null ?? '/images/navigation/user.png' }}" width="30"
                                    alt="{{ $user->last_name }} picture"></td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->middle_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->employee_id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->company }}</td>
                            <td>{{ $user->hire_location }}</td>
                            <td>{{ $user->hire_date }}</td>
                            <td><span class="role">Employee</span></td>
                            <td><span class="status"
                                    @style([$user->status ? 'background: var(--tertiary-color)' : 'background: #FF6174'])>{{ $user->status ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td>
                                <div class="tbl-btns">
                                    <a role="button" href="{{ route('employee.show', $user->id) }}"
                                        class="table-btn table-btn--blue"><i class="fa-solid fa-eye"></i></a>
                                    <a role="button" href="{{ route('employee.edit', $user->id) }}"
                                        class="table-btn table-btn--green"><i class="fa-solid fa-pencil"></i></a>
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
