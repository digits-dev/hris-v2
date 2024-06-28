
@section('css')

    <link rel="stylesheet" href="{{ asset('css/section/table-section.css') }}">

    <style>

    /* Table Column Widths  */

    /* 1st Col  */
    .table th:nth-child(1), .table td:nth-child(1){
        width: 20%;
        /* width: auto; */
    }

    /* 2nd Col */
    .table th:nth-child(2), .table td:nth-child(2){
        width: 10%;
        /* width: auto; */
    }
    /* 3rd Col */
    .table th:nth-child(3), .table td:nth-child(3){
        width: 10%;
        /* width: auto; */
    }

    /* End of Table Column Widths  */

    .table{
        text-align: center;
    }

    .modal-container{
        position: fixed;
        inset: 0;
        z-index: 50;
    }

    .modal-backdrop {
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
        padding: 0;
        z-index: 10000;
        width: 500px;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .modal-body {
        padding: 15px;
    }


    .modal-footer {
        padding: 15px;
        display: flex;
        gap:10px;
        justify-content: flex-end;
    }

    .modal-footer button {
        margin-left: 10px;
    }

    .form-control{
        border: 1px solid var(--stroke-color);
        outline: none;
        padding: 6px 12px;
        border-radius: 5px;

    }

      /* import  */

      .import-modal-content {
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

        .import-modal-header {
            font-size: 18px;
            color: #113437;
            font-family: "Inter", sans-serif;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }

        .import-modal-body {
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
    <div class="main-container" x-data="{  isModalOpen: false, action: null, openImportModal: false}">


        <div class="flex justify-between">
            <div class="flex items-center gap-2">
                <div class="search-form">
                    <label for="search-input" class="search-form__label ">Search</label>
                    <input wire:model.live.debounce.300ms="search" type="text" class="search-form__input" placeholder="Search Department Name" id="search-input">
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
            </div>

            <div class="section-header__right-container">
                @if(App\Helpers\CommonHelpers::isCreate('departments'))
                {{-- Add New Department Btn  --}}
                <button type="button" class="primary-btn" x-on:click="isModalOpen = true; action = 'create'; $wire.department_name = null">Add New Department</a>

                {{-- Import Btn  --}}
                <button class="primary-btn" x-on:click="openImportModal = true">Import</button>
                @endif
            
                {{-- IMPORT MODAL --}}
                <div x-show="openImportModal" x-cloak  x-transition class="modal-container" >
                    <!-- Modal backdrop -->
                    <div class="modal-backdrop" x-on:click="openImportModal = false">
                    </div>
                    <!-- Modal content -->
                    <div class="import-modal-content">
                        <div class="import-modal-header">
                            <p>Import</p>
                            <button type="button" wire:click="downloadTemplate" ><span class="underline underline-offset-2 text-sm font-normal">Download Template</span></button>

                        </div>
                        <form wire:submit.prevent="import">
                            <input type='hidden' wire:model='_token' value="{{ csrf_token()}}">
                            <div class="import-modal-body">
                                <div class="  flex w-full items-center gap-2">
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

        </div>


           {{-- FORM MODAL --}}
           <div x-show="isModalOpen" x-cloak  x-transition class="modal-container" >

            <!-- Modal backdrop -->
            <div class="modal-backdrop" x-on:click="isModalOpen = false">
            </div>

            <!-- Modal content -->
            <div class="modal-content">

                {{-- Create Form  --}}
                <div x-show="action === 'create'">

                    <div class="modal-header">
                        <h1 class="font-semibold">Create Department</h1>
                    </div>

                    <form  wire:submit.prevent="save">
                        <div class="modal-body">
                            <!-- Modal content goes here -->
                            <div class="flex flex-col justify-start gap-3">

                                <label for="department_name" class="text-base">Department Name:</label>
                                <input type="text" wire:model="department_name" class="form-control flex-1">
                                @error('department_name')
                                <em>
                                    <p class="error-text">{{ $message }}</p>
                                </em>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="primary-btn">Confirm</button>
                            <button type="button" class="secondary-btn" x-on:click="isModalOpen = false">Cancel</button>
                        </div>
                    </form>
                </div>

                {{-- Edit Form  --}}
                <div x-show="action === 'edit'">
                    <div class="modal-header">
                        <h1 class="font-semibold">Edit Department</h1>
                    </div>

                    <form  wire:submit.prevent="update">
                        <div class="modal-body">
                            <!-- Modal content goes here -->
                            <div class="flex flex-col justify-start gap-3">

                                <label for="department_name" class="text-base">Department Name:</label>
                                <input type="text" wire:model="department_name" class="form-control flex-1">
                                @error('department_name')
                                <em>
                                    <p class="error-text">{{ $message }}</p>
                                </em>
                                @enderror
                            </div>

                            <div class="flex flex-col justify-start gap-3 mt-3">

                                <label for="status" class="text-base">Status</label>
                                <select wire:model="status" class="form-control">
                                    <option>ACTIVE</option>
                                    <option>INACTIVE</option>
                                </select>
                                @error('status')
                                <em>
                                    <p class="error-text">{{ $message }}</p>
                                </em>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="primary-btn">Confirm</button>
                            <button type="button" class="secondary-btn" x-on:click="isModalOpen = false">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if (count($departments) == 0)

            <div class="no-data-container">
                <p>No data available in table</p>
            </div>

        @else

            <table class="table" wire:loading.class="hidden">
                <thead>
                <tr>
                    <x-sortable-table-header colName="department_name" displayName="Department Name" mxAuto />

                    <x-sortable-table-header colName="status" displayName="Status" mxAuto />

                    @if(App\Helpers\CommonHelpers::isUpdate('departments'))
                        <th>Action</th>
                    @endif
                </tr>
                </thead>

                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->department_name }}</td>
                            <td>

                            <span class="status"
                                @style([$department->status == "ACTIVE" ? 'background: var(--active-color)' : 'background: var(--inactive-color)'])>
                                {{ $department->status == "ACTIVE" ? 'Active' : 'Inactive'}}
                            </span>

                            </td>

                            @if(App\Helpers\CommonHelpers::isUpdate('departments'))
                                <td><a role="button" class="table-btn table-btn--green mx-auto" x-on:click="$wire.editForm({{$department->id}}); isModalOpen = true; action = 'edit'"><i class="fa-solid fa-pencil"></i></a></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>

            </table>

            {{-- TABLE LOADING ------------------------------------------------------------------------- --}}
            <div class="table-container" wire:loading>
                @php
                    $dummyBody = array_fill(0, 5, 'loading');
                    $dummyHead = array_fill(0, 2, 'heading');
                @endphp

                <table class="table">
                    <thead>
                        <tr>
                            @foreach ($dummyHead as $header)
                                <th>&nbsp;</th>
                            @endforeach

                            @if(App\Helpers\CommonHelpers::isUpdate('departments'))

                            <th>&nbsp;</th>
        
                            @endif
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($dummyBody as $index => $loading)

                        <tr wire:key="{{$index}}">
                            <td>
                                <div class="animate-pulse h-3 w-1/2 bg-slate-700 rounded mx-auto"></div>
                            </td>

                            <td> 
                                <div class="animate-pulse h-7 w-20 bg-slate-700 rounded-full mx-auto"></div>
                            </td>

                            @if(App\Helpers\CommonHelpers::isUpdate('departments'))
                                <td >                                         
                                    <div class="  animate-pulse rounded-sm bg-slate-700 h-5 w-5 mx-auto"></div>
                                </td>

                            @endif
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            {{-- END OF TABLE LOADING ------------------------------------------------------------------------- --}}

        @endif

     
    </div>


    <div class="pagination">
        {{ $departments->links() }}
    </div>

</section>
