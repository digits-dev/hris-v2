@extends('layout')
    <script src="{{ asset('plugins/sweetalert.js') }}"></script>
    @section('css')
    <link rel="stylesheet" href="{{ asset ('css/bootstrap-utilities/utilities.css') }}">
    <style>
       body {
            font-family: "Roboto", sans-serif;
            background: #f7f7f7;
        }

        .row {
            .header {
            border: 1px solid #16acff;
            padding: 10px;
            background: #f0f0f0;
            margin-bottom: 2px;
            cursor: pointer;

        }

        .content {
            background: #ddd;
            padding: 10px;
            margin: 0
        }
        }
    </style>
    @endsection
@section('content')
<section class="content">
      <div class='row'>
        <h3 class='header' id="header-bi"><i class="fa fa-user"></i> Basic Information</h3>
        <p class='content' id="content-bi">
           <img src="" alt="">
        </p>
      </div>
      
      <div class='row'>
        <h3 class='header' id="header-wi"><i class="fa fa-proffesion"></i> Work Information</h3>
        <p class='content' id="content-wi"></p>
      </div>

      <div class='row'>
        <h3 class='header' id="header-wi"><i class="fa fa-calendar"></i> Work Schedule</h3>
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