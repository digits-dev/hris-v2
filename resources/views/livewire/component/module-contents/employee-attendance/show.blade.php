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
            font-size: 12px;
            font-weight: bold;
            font-family: "Inter", sans-serif;
        }


        fieldset {
            border: 1px solid var(--stroke-color);
            border-radius: 8px;
            margin: 10px 0;
            position: relative;
            overflow: hidden;
        }

        .legend {
            color: white;
            background: var(--stroke-color);
            width: 100%;
            text-align: center;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            font-weight: bold;
            padding: 10px;
            position: absolute;

            top: 0;
        }

    

        form input {
            width: 100%;
        }

        .personal-content {
            display: grid;
            grid-template-columns: 1fr;
            margin-top: 40px;
            padding: 30px;
            gap: 40px;
        }

        
        .personal-content-inputs{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }



        .personal-content input[type="text"] {
            border: 1px solid var(--stroke-color);
            border-radius: 8px;
            padding: 8px 16px;
            outline: none;
            margin-top: 5px;
            font-weight: 400;
        }

        label {
            font-size: 14px;
            width: 100%;
            font-weight: 500;
        }

        @media screen and (min-width: 900px) {

            .personal-content {
                grid-template-columns: 5fr 5fr 2fr;
            }
        }


        .back-btn {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            border-radius: 8px;
            font-size: 12px;
            border: 2px solid var(--stroke-color);
            padding: 10px 20px;
            cursor: pointer;
            width: 100px;
            margin-top: 20px;
            display: block;
            margin-left: auto;
            text-align: center
        }

        .back-btn:hover {
            opacity: 0.9;
        }
    </style>
@endsection


<section>

    <form action="" class="space-y-10">

        {{-- Personal  Information  --}}
        <fieldset>
            <legend class="legend">Employee Attendance Summary Details</legend>

            <div class="personal-content">
            
                <div class="personal-content-inputs ">
                    <label for="first-name">First Name
                        <input type="text" id="first-name" value="{{ $employee->user->first_name }}" disabled>
                    </label>

                    <label for="middle-name">Middle Name
                        <input type="text" id="middle-name" value="{{ $employee->user->middle_name }}" disabled>
                    </label>

                    <label for="last-name">Last Name
                        <input type="text" id="last-name" value="{{ $employee->user->last_name }}" disabled>
                    </label>

                    <label for="company">Company
                        <input type="text" id="company" value="{{ $employee->company->company_name }}" disabled>
                    </label>

                    <label for="hire-location">Hire Location
                        <input type="text" id="hire-location" value="{{ $employee->hireLocation->location_name }}" disabled>
                    </label>
                    
                    <label for="time-in-location">Time in Location/s
                        <input type="text" id="time-in-location" value="{{ $employee->currentLocation->location_name  }}" disabled>
                    </label>
                </div>

                <div class="personal-content-inputs ">
                    <label for="first-time-in">First Time in
                        <input type="text" id="first-time-in" value="{{ $employee->date_clocked_in }}" disabled>
                    </label>

                    <label for="last-time-out">Last Time out
                        <input type="text" id="last-time-out" value="{{ $employee->date_clocked_out }}" disabled>
                    </label>

                    @php
                        $timeIn = \Carbon\Carbon::parse($employee->date_clocked_in);
                        $timeOut = \Carbon\Carbon::parse($employee->date_clocked_out);
                    @endphp     

                    <label for="date">Date
                        <input type="text" id="date" value="{{ \Carbon\Carbon::parse($employee->date_clocked_in)->format('Y-m-d') }}" disabled>
                    </label>

                    <div class="flex gap-5">
                        <label for="bio-duration">Bio Duration
                            <input type="text" id="bio-duration" value="{{ sprintf("%02d:%02d", $timeIn->diffInHours($timeOut), $timeIn->diffInMinutes($timeOut) % 60) }}" disabled>
                        </label>

                        <label for="filo-duration">FILO Duration
                            <input type="text" id="filo-duration" value="{{ sprintf("%02d:%02d", $timeIn->diffInHours($timeOut), $timeIn->diffInMinutes($timeOut) % 60) }}" disabled>
                        </label>
                    </div>

                </div>
            </div>
        </fieldset>


    </form>

    <a role="button" href="/employee-attendance" class="back-btn" wire:navigate>Go back</a>
</section>
