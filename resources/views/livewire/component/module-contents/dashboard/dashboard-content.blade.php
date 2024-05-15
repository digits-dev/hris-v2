@section('css')
<style>
    :root{
        --primary-color: #1A4448;
        --content-color: #DDFAFD;
        --title-color: #847272;
        --clocked-in-color: #2196F3;
        --not-clocked-in-color: #FF6174;
        --clocked-out-color: #D114EB;
        --on-vacation-leave-color: #FF6600;
        --on-sick-leave-color: #0F901B;

    }
    .main-container{
        margin:  1rem 2.5rem;
        height: 100%;
    }

    .date{
        font-family: "Inter", sans-serif;
        font-optical-sizing: auto;
        font-weight: 800;
        color: var(--primary-color);
        font-size: 16px;
    }

    .employee-attendance-container{
        margin-top: 1rem;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 25px;
    }

    .statistics-content{
        background: var(--content-color);
        height: 230px;
        width: 200px;
        padding: 16px;
        border-radius: 10px;

    }

    .attendance-content{
        background: var(--content-color);
        flex: 1;
        padding: 16px;
        border-radius: 10px;

        .content-title {
            margin-bottom: 10px;
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: 800;
            color: black;
            font-size: 14px;
        }
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
<div class="main-container">
    <div class="date-container">
        <p class="date">Today: May 05, 2024</p>
    </div>
    <div class="employee-attendance-container">
        <div class="statistics-content">
            <p>Statistics</p>
        </div>
        <div class="attendance-content shadow-md shadow-slate-200">
            <div class="attendance-items-container">
                {{-- CLOCKED IN --}}
                <div class="content-title-container">
                    <p class="content-title">Attendance</p>
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/clocked-in-icon.png')}}" width="67">
                        <p class="item-title"> Clocked In</p>
                        <p class="clocked-in-value">1234</p>
                    </div>
                </div>
                {{-- NOT CLOCKED IN --}}
                <div class="content-title-container">
                    <p class="content-title" style="visibility: hidden">Hidden</p>
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/not-clocked-in-icon.png')}}" width="67">
                        <p class="item-title"> Not Clocked In</p>
                        <p class="not-clocked-in-value">250</p>
                    </div>
                </div>
                {{-- CLOCKED OUT --}}
                <div class="content-title-container">
                    <p class="content-title" style="visibility: hidden">Hidden</p>
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/clocked-out-icon.png')}}" width="67">
                        <p class="item-title"> Clocked Out</p>
                        <p class="clocked-out-value">2346</p>
                    </div>
                </div>
                {{-- ON VACATION LEAVE --}}
                <div class="content-title-container">
                    <p class="content-title" style="visibility: hidden">Hidden</p>
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/on-vacation-leave-icon.png')}}" width="67">
                        <p class="item-title"> On Vacation Leave</p>
                        <p class="on-vacation-leave-value">21</p>
                    </div>
                </div>
                {{-- ON SICK LEAVE --}}
                <div class="content-title-container">
                    <p class="content-title" style="visibility: hidden">Hidden</p>
                    <div class="attendance-items">
                        <img src="{{asset('images/dashboard/on-sick-leave-icon.png')}}" width="67">
                        <p class="item-title"> On Sick Leave</p>
                        <p class="on-sick-leave-value">25</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
