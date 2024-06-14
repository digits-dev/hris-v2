@extends('layout')
<script src="{{ asset('plugins/sweetalert.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/section/table-section.css') }}">
<link rel="stylesheet" href="{{ asset ('css/bootstrap-utilities/utilities.css') }}">
@section('css')
    <style>
        .dropbtn {
            color: #333;
            background-color: #fff;
            border-color: #ccc;
            padding: 10px;
            font-size: 13px;
            cursor: pointer;
            border-radius: 5px;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: #f8f6f6;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content span {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown span:hover {background-color: #ddd;}

        .show {display: block;}
    </style>
@endsection
@section('content')
    <section>
        <div class="main-container">
            <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
            <p class="header-title">{{trans('ad_lang.logs.log_name')}}</p>

            <table class="table">
            <thead>
             <tr>
   
                <th>{{trans('ad_lang.logs.ip_address')}}</th>
                <th>{{trans('ad_lang.logs.user_agent')}}</th>
                <th>{{trans('ad_lang.logs.url')}}</th>
                <th>{{trans('ad_lang.logs.description')}}</th>
                <th>{{trans('ad_lang.logs.details')}}</th>
                <th>{{trans('ad_lang.logs.user')}}</th>
                <th>{{trans('ad_lang.logs.date')}}</th>
             </tr>
            </thead>

            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->ipaddress }}</td>
                        <td>{{ $log->useragent }}</td>
                        <td>{{ $log->url }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{$log->details}}</td>
                        <td>{{$log->fullname}}</td>
                        <td>{{$log->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
    
    
            </table>
        </div>

    </section>
@endsection

@section('script')

@endsection