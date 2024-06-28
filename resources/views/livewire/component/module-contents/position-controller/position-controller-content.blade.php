
@section('css')

    <link rel="stylesheet" href="{{ asset('css/section/table-section.css') }}">

    <style>

    /* Table Column Widths  */


    /* 1st Col  */
    .table th:nth-child(1), .table td:nth-child(1){
        width: 40%;
        /* width: auto; */
    }

    /* 2nd Col */
    .table th:nth-child(2), .table td:nth-child(2){
        width: 40%;
        /* width: auto; */
    }
    /* 3rd Col */
    .table th:nth-child(3), .table td:nth-child(3){
        width: 20%;
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


    </style>
@endsection

<section>
    <div class="main-container" x-data="{  isModalOpen: false, action: null }">


        <div class="flex justify-between">
            <div class="flex items-center gap-2">
                <div class="search-form">
                    <label for="search-input" class="search-form__label ">Search</label>
                    <input wire:model.live.debounce.300ms="search" type="text" class="search-form__input" placeholder="Search Position Name" id="search-input">
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

            @if(App\Helpers\CommonHelpers::isCreate('positions'))
                <button type="button" class="primary-btn" x-on:click="isModalOpen = true; action = 'create'; $wire.position_name = null">Add New Position</a>
            @endif
        </div>

        @if (count($positions) == 0)

            <div class="no-data-container">
                <p>No data available in table</p>
            </div>

        @else

            <table class="table" wire:loading.class="hidden">
                <thead>
                <tr>
                    <x-sortable-table-header colName="position_name" displayName="Position Name" mxAuto />

                    <x-sortable-table-header colName="status" displayName="Status" mxAuto />

                    @if(App\Helpers\CommonHelpers::isUpdate('positions'))
                        <th>Action</th>
                    @endif
                </tr>
                </thead>

                <tbody >
                    @foreach ($positions as $position)
                        <tr >
                            <td>{{ $position->position_name }}</td>
                            <td>
                            <span class="status"
                                @style([$position->status == "ACTIVE" ? 'background: var(--active-color)' : 'background: var(--inactive-color)'])>
                                {{ $position->status == "ACTIVE" ? 'Active' : 'Inactive'}}
                            </span>

                            </td>

                            @if(App\Helpers\CommonHelpers::isUpdate('positions'))
                                <td><a role="button" class="table-btn table-btn--green mx-auto" x-on:click="$wire.editForm({{$position->id}}); isModalOpen = true; action = 'edit'"><i class="fa-solid fa-pencil"></i></a></td>
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

                            @if(App\Helpers\CommonHelpers::isUpdate('positions'))

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

                            @if(App\Helpers\CommonHelpers::isUpdate('positions'))
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
                        <h1 class="font-semibold">Create Position</h1>
                    </div>

                    <form  wire:submit.prevent="save">
                        <div class="modal-body">
                            <!-- Modal content goes here -->
                            <div class="flex flex-col justify-start gap-3">

                                <label for="position_name" class="text-base">Position Name:</label>
                                <input type="text" wire:model="position_name" class="form-control flex-1">
                                @error('position_name')
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
                        <h1 class="font-semibold">Edit Position</h1>
                    </div>

                    <form  wire:submit.prevent="update">
                        <div class="modal-body">
                            <!-- Modal content goes here -->
                            <div class="flex flex-col justify-start gap-3">

                                <label for="position_name" class="text-base">Position Name:</label>
                                <input type="text" wire:model="position_name" class="form-control flex-1">
                                    @error('position_name')
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
    </div>

    <div class="pagination">
        {{ $positions->links() }}
    </div>
</section>
