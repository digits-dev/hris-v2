@section('css')

    <link rel="stylesheet" href="{{ asset('css/section/table-section.css') }}">

    <style>

        /* Table Column Widths  */

        .first-name-col {
           min-width: 150px;
        }
        .middle-name-col {
            min-width: 150px;
        }
        .last-name-col {
            min-width: 150px;
        }
        .location-col {
            min-width: 180px;
        }
        .current-location-col {
            min-width: 180px;
        }
        .time-in-col {
            min-width: 180px;
            text-align: center;
            button{
                margin: auto;
            }
        }
        .time-out-col {
            min-width: 180px;
            text-align: center;
            button{
                margin: auto;
            }
        }
        .date-col {
            min-width: 120px;
            text-align: center;
            button{
                margin: auto;
            }
        }
        .bio-duration-col {
            min-width: 130px;
            text-align: center;
            button{
                margin: auto;
            }
        }

        /* End of Table Column Widths  */


     /* FOR FILTER MODAL */

     .modal-container{
            position: fixed;
            inset: 0;
            z-index: 50;

        }

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

    <div class="section-header ">
        <div class="section-header__left-container">
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
                                <div class="modal-body-container2">
                                    <div class="filter-modal-select-container">
                                        <p>Current Location</p>
                                        <div class="filter-modal-select">
                                            <select wire:model="current_location_id">
                                                <option value="">Select Location</option>
                                                @foreach ($locations as $location)
                                                <option value="{{$location->id}}">{{$location->location_name}}</option>
                                                @endforeach
                                            </select>
                                            <img src="/images/table/asc.png" class="filter-modal-arrow-icon" alt="dropdown icon">
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

                        <div class="text-center space-x-2">
                            <button type="submit" class="primary-btn" x-on:click="openExportModal = false">Export</button>
                            <button type="button" class="secondary-btn" x-on:click="openExportModal = false">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>


    @if (count($employeeLogs) == 0)
        <div class="no-data-container">
            <p>No data available in table</p>
        </div>
    @else
        <div class="table-container" wire:loading.remove>
            <table class="table">
                <thead>
                 <tr>

                    @foreach ($colHeaders as $header)
                    <x-sortable-table-header
                    :colName="$header['colName']"
                    :displayName="$header['displayName']"
                    class="{{ $header['class'] }}" />
                    @endforeach

                 </tr>
                </thead>

                <tbody >
                    @foreach ($employeeLogs as $employeeLog)
                        <tr>
                            <td class="first-name-col">{{ $employeeLog->first_name }}</td>
                            <td class="middle-name-col">{{trim(strtolower($employeeLog->middle_name)) == 'n/a' ? '' : $employeeLog->middle_name }}</td>
                            <td class="last-name-col">{{ $employeeLog->last_name }}</td>
                            <td class="location-col">{{ $employeeLog->location ?? '' }}</td>
                            <td class="current-location-col">{{ $employeeLog->current_location ?? '' }}</td>
                            <td class="time-in-col">{{ $employeeLog->time_in }}</td>
                            <td class="time-out-col">{{ $employeeLog->time_out }}</td>
                            <td class="date-col">{{ $employeeLog->date }}</td>
                            <td class="bio-duration-col">{{ $employeeLog->bio_duration }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>


        {{-- TABLE LOADING ------------------------------------------------------------------------- --}}

        <div class="table-container" wire:loading>
            @php
                $dummyBody = array_fill(0, 5, 'loading');
                $dummyHead = array_fill(0, 9, 'heading');
            @endphp

            <table class="table">
                <thead>
                    <tr>
                        @foreach ($dummyHead as $header)
                            <th>&nbsp;</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody>

                    @foreach ($dummyBody as $index => $loading)
                        <tr wire:key="{{ $index }} ">

                            <td class="first-name-col"><div class="  animate-pulse h-3 w-3/4 bg-slate-700 rounded"></div></td>
                            <td class="middle-name-col"><div class="  animate-pulse h-3 w-3/4 bg-slate-700 rounded"></div></td>
                            <td class="last-name-col"><div class="  animate-pulse h-3 w-3/4 bg-slate-700 rounded"></div></td>
                            <td class="location-col"><div class="  animate-pulse h-3 w-3/4 bg-slate-700 rounded"></div></td>
                            <td class="current-location-col"><div class="  animate-pulse h-3 w-3/4 bg-slate-700 rounded mx-auto"></div></td>
                            <td class="time-in-col"><div class="  animate-pulse h-3 w-3/4 bg-slate-700 rounded mx-auto"></div></td>
                            <td class="time-out-col"><div class="  animate-pulse h-3 w-3/4 bg-slate-700 rounded mx-auto"></div></td>
                            <td class="date-col"><div class="  animate-pulse h-3 w-3/4 bg-slate-700 rounded mx-auto"></div></td>
                            <td class="bio-duration-col"><div class="  animate-pulse h-3 w-3/4 bg-slate-700 rounded mx-auto"></div></td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        {{-- END OF TABLE LOADING ------------------------------------------------------------------------- --}}

    @endif
    <div class="pagination">
    {{ $employeeLogs->links() }}
    </div>
</section>
