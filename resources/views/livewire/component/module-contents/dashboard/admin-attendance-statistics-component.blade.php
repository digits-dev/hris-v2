@section('css')
<style>
    :root{
        --primary-color: #1A4448;
        --stroke-color: #599297;
        --select-color: #1F6268;
        --stroke-color: #599297;
        --select-color: #1F6268;
        --content-color: #DDFAFD;
        --title-color: #847272;
        --clocked-in-color: #2196F3;
        --not-clocked-in-color: #FF6174;
        --clocked-out-color: #EFE30A;
        --on-vacation-leave-color: #FF6600;
        --on-sick-leave-color: #0F901B;

    }


    .main-container{
        margin:  0 2.5rem;
        height: 100%;
    }

    .date{
        font-family: "Inter", sans-serif;
        font-optical-sizing: auto;
        font-weight: 800;
        color: var(--primary-color);
        font-size: 15px;
        font-size: 15px;
    }

    /* SELECT */

    .select-button{
        padding: 15px;
        width: 100%;
        border: 2px solid var(--stroke-color);
        border-radius: 10px;
        outline: none;

    }

    .select-placeholder{
        font-family: "Inter", sans-serif;
        font-optical-sizing: auto;
        font-weight: 700;
        font-size: 14px;
        color: var(--select-color);

    }

    /* END OF SELECT */

    /* SELECT */

    .select-button{
        padding: 15px;
        width: 100%;
        border: 2px solid var(--stroke-color);
        border-radius: 10px;
        outline: none;

    }

    .select-placeholder{
        font-family: "Inter", sans-serif;
        font-optical-sizing: auto;
        font-weight: 700;
        font-size: 14px;
        color: var(--select-color);

    }

    /* END OF SELECT */

    .employee-attendance-container{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 25px;
    }

    .statistics-content{
        background: var(--content-color);
        padding: 16px;
        border-radius: 10px;
       
    }

    .chart-content{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;

    }
    .chart-container{
        width: 220px;
    }

    @media screen and (max-width: 700px) {
        .statistics-content{
        width: 100%;
       
    }
    }

    .attendance-content{
        background: var(--content-color);
        flex: 1;
        padding: 20px 16px;
        border-radius: 10px;

    
    }
    .content-title {
            margin-bottom: 10px;
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: 700;
            color: rgb(72, 72, 72);
            font-size: 14px;
            padding: 10px
        }

    /* ATTENDANCE */

    .attendance-items-container{
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 25px;
    }

    .attendance-items{
        display: flex;
        height: 200px;
        width: 180px;
        justify-content: center;
        background: white;
        border-radius: 10px;
        flex-direction: column;
        align-items: center;

        .item-title{
            margin-top: 15px;
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: 500;
            color: var(--title-color);
            font-size: 14px;
        }

        /* CLOCKED IN */
        .clocked-in-value{
            color: var(--clocked-in-color);
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-size: 16px;
        }

        /* NOT CLOCKED IN */
        .not-clocked-in-value{
            color: var(--not-clocked-in-color);
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-size: 16px;
        }

        /* CLOCKED OUT */
        .clocked-out-value{
            color: var(--clocked-out-color);
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-size: 16px;
        }

        /* ON VACATION LEAVE */
        .on-vacation-leave-value{
            color: var(--on-vacation-leave-color);
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-size: 16px;
        }

         /* ON SICK LEAVE */
         .on-sick-leave-value{
            color: var(--on-sick-leave-color);
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: 700;
            font-size: 16px;
        }
    }

       /* SELECT */
        
       .filter-modal-select {
            position: relative;
            width: 100%;
            max-width: 400px;
            min-width: 300px;
            height: 40px;
        }

        .filter-modal-select-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
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
            transform: translateY(-50%);
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

        .filter-containers{
            display: flex;
            margin-top: 10px;
            margin-bottom: 10px;
            flex-wrap: wrap;
            gap: 10px;
        }

</style>
@endsection
<div class="main-container relative">
    <div class="filter-containers">
        <div class="filter-modal-select">
            <select wire:model.change="company_id">
                <option disabled>Select Company</option>
                <option value="0">All Employees</option>
                @foreach ($companies as $company)
                    <option value="{{$company->id}}">{{$company->company_name}}</option>
                @endforeach
            </select>
            <img src="/images/table/asc.png" class="filter-modal-arrow-icon" alt="dropdown icon">
        </div>
        <div class="filter-modal-select-container">
            <div class="hire-date-container mb-2">
                <span>Date</span>
                <input type="date" id="dateInput" wire:model.change="date">
            </div>
        </div> 
    </div>
    <div class="employee-attendance-container">
        <div class="statistics-content shadow-md shadow-slate-200" wire:ignore>
            <p class="content-title ">Statistics</p>
            <div class="chart-content">
                <div class="chart-container">
                    <canvas id="statistics-chart" m></canvas>
                </div>
            </div>
        </div>
        <div class="attendance-content shadow-md shadow-slate-200">
            <p class="content-title ">Attendance</p>
            <div class="attendance-items-container">
                {{-- CLOCKED IN --}}
                <div class="content-title-container">
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/clocked-in-icon.png')}}" width="67">
                        <p class="item-title"> Clocked In</p>
                        <p class="clocked-in-value">{{$clocked_in_count}}</p>
                    </div>
                </div>
                {{-- NOT CLOCKED IN --}}
                <div class="content-title-container">
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/not-clocked-in-icon.png')}}" width="67">
                        <p class="item-title"> Not Clocked In</p>
                        <p class="not-clocked-in-value">{{$not_clocked_in_count}}</p>
                    </div>
                </div>
                {{-- CLOCKED OUT --}}
                <div class="content-title-container">
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/clocked-out-icon.png')}}" width="67">
                        <p class="item-title"> Clocked Out</p>
                        <p class="clocked-out-value">{{$clocked_out_count}}</p>
                    </div>
                </div>
                {{-- ON VACATION LEAVE --}}
                <div class="content-title-container">
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/on-vacation-leave-icon.png')}}" width="67">
                        <p class="item-title"> On Vacation Leave</p>
                        <p class="on-vacation-leave-value">-</p>
                    </div>
                </div>
                {{-- ON SICK LEAVE --}}
                <div class="content-title-container">
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/on-sick-leave-icon.png')}}" width="67">
                        <p class="item-title"> On Sick Leave</p>
                        <p class="on-sick-leave-value">-</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

   
</div>

@section('script')
<script >
    document.addEventListener('livewire:navigated', () => {
        const ctx = document.getElementById('statistics-chart');
         new Chart(ctx, {
             type: 'doughnut',
             data: {
                 labels: [
                     'Clocked In',
                     'Not Clocked In',
                     'Clocked Out',
                     'On Vacation Leave',
                     'On Sick Leave'
                 ],
                 datasets: [{
                     label: 'Employees',
                     data: [1, 1, 0, 0, 0],
                     backgroundColor: [
                         '#2196F3',
                         '#FF6174',
                         '#EFE30A',
                         '#FF6600',
                         '#0F901B'
                     ],
                     hoverOffset: 10
                 },]
             },
             options: {
                 responsive: true,
                 maintainAspectRation: false,
                 context: '2d',
                 plugins: {
                     legend: {
                         display: false
                     }
                 }
                 
             }
         });
       

    })

    var date = new Date();
         var formattedDate = date.toLocaleDateString('en-US', { month: 'long', day: '2-digit', year: 'numeric' });
         var fullDate = 'Today: ' + formattedDate;
         document.getElementById('Date').innerText = fullDate;

  </script>
@endsection
