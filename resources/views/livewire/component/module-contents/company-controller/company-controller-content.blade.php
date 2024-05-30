
@section('css')

    <link rel="stylesheet" href="{{ asset('css/navigation/section.css') }}">

    <style>
     
    /* Table Column Widths  */

    /* 1st Col  */
    .table th:nth-child(1), .table td:nth-child(1){
        width: 20%;
    }

    /* 2nd Col */
    .table th:nth-child(2), .table td:nth-child(2){
        width: 10%;
    }
    /* 3rd Col */
    .table th:nth-child(3), .table td:nth-child(3){
        width: 10%;
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
    @include('errors/messages')
    <div class="main-container" x-data="{  isModalOpen: false, action: null }">


        <div class="flex justify-between">
            <div class="flex items-center gap-2">
                <div class="search-form">
                    <label for="search-input" class="search-form__label ">Search</label>
                    <input wire:model.live.debounce.300ms="search" type="text" class="search-form__input" placeholder="Search Company Name" id="search-input">
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

            <button type="button" class="primary-btn" x-on:click="isModalOpen = true; action = 'create'; $wire.company_name = null">Add New Company</a>
        
        </div>

        @if (count($companies) == 0)

            <div class="no-data-container">
                <p>No data available in table</p>
            </div>

        @else

            <table class="table">
                <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
        
                <tbody wire:loading.class="opacity-50">
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{ $company->company_name }}</td>
                            <td>
                            <span class="status"
                                @style([$company->status == "ACTIVE" ? 'background: var(--tertiary-color)' : 'background: #FF6174'])>
                                {{ $company->status }}
                            </span>

                            </td>
                            <td><a role="button" class="table-btn table-btn--green" x-on:click="$wire.editForm({{$company->id}}); isModalOpen = true; action = 'edit'"><i class="fa-solid fa-pencil"></i></a></td>
            
                        </tr>
                    @endforeach
                </tbody>

            </table>

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
                        <h1 class="font-semibold">Create Company</h1>
                    </div>

                    <form  wire:submit.prevent="save">
                        <div class="modal-body">
                            <!-- Modal content goes here -->
                            <div class="flex flex-col justify-start gap-3">
                            
                                <label for="company_name" class="text-base">Company Name:</label>
                                <input type="text" wire:model="company_name" class="form-control flex-1">
                                @error('company_name')
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
                        <h1 class="font-semibold">Edit Company</h1>
                    </div>

                    <form  wire:submit.prevent="update">
                        <div class="modal-body">
                            <!-- Modal content goes here -->
                            <div class="flex flex-col justify-start gap-3">
                            
                                <label for="company_name" class="text-base">Company Name:</label>
                                <input type="text" wire:model="company_name" class="form-control flex-1">
                                @error('company_name')
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
        {{ $companies->links() }}
    </div>

</section>