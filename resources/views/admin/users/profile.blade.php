@extends('layout')
    <script src="{{ asset('plugins/sweetalert.js') }}"></script>
    @section('css')
    <link rel="stylesheet" href="{{ asset ('css/bootstrap-utilities/utilities.css') }}">
    <style>


        :root {
            --primary-color: #1F6268;
            --stroke-color: #599297;
            --secondary-color: #cbfaff;
            --primary-text: #113437;
            --primary-hover: #DDFAFD;
            --tertiary-color: #27C1CE;
        }

        section{
            background: #eee;
            margin-bottom: 10px;
            padding: 20px;
        }

        .row {
            .header {
                border: 1px solid var(--stroke-color);
                background: var(--stroke-color);
                color: white;
                font-family: "Inter", sans-serif;
                font-size: 14px;
                font-weight: 500;
                padding: 10px;
                margin-bottom: 5px;
                cursor: pointer;
                border-radius:5px;
            }
        }

        .content {
            background: #eee;
            margin-bottom: 10px;
            padding: 10px;
            border:0.5px solid rgba(0,0,0,0.1);
            display: none;

        }

        /* Basic Information */

        .content-data-container{
            padding:20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap:20px;
        }

        .content-data-container-content{
            width: 100%;
            display: grid;
            flex: 1;
            grid-template-columns: 1fr;

        }


        .profile-img-container {
            border-radius: 100%;
            overflow: hidden;
            height: 180px;
            width: 180px;
            display: grid;
            place-content: center;
            border: 5px solid var(--stroke-color);


        }

        @media screen and (min-width: 900px) {

            .content-data-container {
                flex-direction: row;
            }

            .content-data-container-content {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .form-group{
            display: flex;
            flex-direction: column;
            gap: 2px;
            padding:10px 20px;
        }

        .form-group label{
            font-weight: 500;
        }

        .form-group .form-control{
            border: 1px solid var(--stroke-color);
            border-radius: 8px;
            padding: 8px 16px;
            outline: none;
            margin-top: 5px;
            font-weight: 400;
            width: 100%;
            max-width: 100%;
        }


    </style>
    @endsection
@section('content')
<section>

    {{-- Basic Information  --}}
      <div class='row'>
        <h3 class='header' id="header-bi"><i class="fa fa-user mr-1"></i> Basic Information</h3>
        <div class='content' id="content-bi">

            <div class="content-data-container">
                <div class="profile-img-container">

                     @if (auth()->user()->image)
                        @php
                            if (file_exists(auth()->user()->image)) {
                                $profileImagePath = public_path('storage/' . auth()->user()->image);
                                [$width, $height] = getimagesize($profileImagePath);
                                $isLandscape = $width > $height;
                            }
                        @endphp

                        <img @style(['height:180px' => $isLandscape, 'max-width: unset' => $isLandscape]) alt="profile-picture"
                            src="{{ asset('storage/' . auth()->user()->image) }}">
                    @else
                        <img alt="default profile image" class="object-contain" height="auto"
                            src="/images/navigation/user.png">
                    @endif

                </div>

                <div class="content-data-container-content">
                    <div class="form-group">
                        <label for="first-name">First Name</label>
                        <input type="text" name="" id="" value="{{auth()->user()->first_name}}" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="last-name">Middle Name</label>
                        <input type="text" name="" id="" value="{{auth()->user()->middle_name}}" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" name="" id="" value="{{auth()->user()->last_name}}" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="employee_id">Employee ID</label>
                        <input type="text" name="" id="" value="{{auth()->user()->employee_id}}" class="form-control" disabled>
                    </div>

                </div>
            </div>

        </div>
      </div>

      {{-- Work Information  --}}

      <div class='row'>
        <h3 class='header' id="header-wi"><i class="fa-solid fa-briefcase mr-1"></i> Work Information</h3>
            <div class="content">
                <div class="content-data-container">

                    <div class="content-data-container-content">
                        <div class="form-group">
                            <label for="">Company</label>
                            <input type="text" name="" id="" value="{{auth()->user()->company->company_name}}" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label for="">Hire Location</label>
                            <input type="text" name="" id="" value="{{auth()->user()->hireLocation->location_name}}" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label for="">Hire Date</label>
                            <input type="text" name="" id="" value="{{auth()->user()->hire_date}}" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label for="">Position</label>
                            <input type="text" name="" id="" value="{{auth()->user()->position->position_name}}" class="form-control" disabled>
                        </div>

                    </div>
                </div>
            </div>
      </div>

      {{-- Work Schedule  --}}

      <div class='row'>
        <h3 class='header' id="header-wi"><i class="fa fa-calendar mr-1"></i> Work Schedule</h3>
        <p class='content' id="content-wi"></p>
      </div>
</section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.row .content').hide();
            $('#header-bi, #header-wi').click(function() {
                $(this).siblings('.content').slideToggle(500);
                $('.row .content').not($(this).siblings('.content')).slideUp(500);
            });
        });
    </script>
@endsection
