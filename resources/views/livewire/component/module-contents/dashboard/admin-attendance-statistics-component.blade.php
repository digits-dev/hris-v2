@section('css')
<style>
    :root{
        --primary-color: #1A4448;
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

    .employee-attendance-container{
        margin-top: 1rem;
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

</style>
@endsection
<div class="main-container relative">
    <div 
        class="max-w-96 w-full fixed bg-white mt-2" 
        x-data="statisticsFilter" 
    >
        <button type="button" class="select-button" style="height: 55px;"
            @click="selected !== 1 ? selected = 1 :selected = null"
        >
            <div class="flex items-center justify-between">
                <span class="select-placeholder" x-text="truncateText(filterTitle)"></span>
                <span class="menu-arrow-icon" x-html="selected === 1 ? `<img src='{{ asset('images/table/asc.png') }}' style='width: 10px;'>` : `<img src='{{ asset('images/table/desc.png') }}' style='width: 10px;'>`"></span>
            </div>
        </button>
        <div class="relative overflow-hidden transition-all max-h-0 duration-700" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: 200px' : ''">
            <div style="overflow: auto; max-height: 200px; z-index: 10;">
                <div class="p-3 border" >
                    <button style="width: 100%; text-align:start" @click="selected !== 1 ? selected = 1 :selected = null, filterTitle='All Companies'">
                        <p>All Companies</p>
                    </button>
                </div>
                @foreach($companies as $company)
                    <div class="p-3 border" >
                        <button style="width: 100%; text-align:start" @click="selected !== 1 ? selected = 1 :selected = null, filterTitle='{{$company->company_name}}'"> 
                            {{$company->company_name}}
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="employee-attendance-container mt-20">
        <div class="statistics-content shadow-md shadow-slate-200">
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
                        <p class="clocked-in-value">1234</p>
                    </div>
                </div>
                {{-- NOT CLOCKED IN --}}
                <div class="content-title-container">
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/not-clocked-in-icon.png')}}" width="67">
                        <p class="item-title"> Not Clocked In</p>
                        <p class="not-clocked-in-value">250</p>
                    </div>
                </div>
                {{-- CLOCKED OUT --}}
                <div class="content-title-container">
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/clocked-out-icon.png')}}" width="67">
                        <p class="item-title"> Clocked Out</p>
                        <p class="clocked-out-value">2346</p>
                    </div>
                </div>
                {{-- ON VACATION LEAVE --}}
                <div class="content-title-container">
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/on-vacation-leave-icon.png')}}" width="67">
                        <p class="item-title"> On Vacation Leave</p>
                        <p class="on-vacation-leave-value">21</p>
                    </div>
                </div>
                {{-- ON SICK LEAVE --}}
                <div class="content-title-container">
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/on-sick-leave-icon.png')}}" width="67">
                        <p class="item-title"> On Sick Leave</p>
                        <p class="on-sick-leave-value">25</p>
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
                     data: [1234, 250, 2346, 212, 252],
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
     
         var date = new Date();
         var formattedDate = date.toLocaleDateString('en-US', { month: 'long', day: '2-digit', year: 'numeric' });
         var fullDate = 'Today: ' + formattedDate;
         document.getElementById('Date').innerText = fullDate;

    })

    function statisticsFilter(){

        return {
            selected:null,
            filterTitle:'Select Company',
            
            truncateText(text) {
                const maxLength = 40;
        
                if (text.length > maxLength) {
                    return text.substring(0, maxLength) + '...';
                }
        
                // If the length of the text is within the limit, return the original text
                return text;
            }
        }
    }
    
  </script>
@endsection
