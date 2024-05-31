@extends('layout')
<link rel="stylesheet" href="{{ asset('css/navigation/section.css') }}">

@section('css')
    <style>
     
    /* Table Column Widths  */

    /* ID  */
    .table th:nth-child(1), .table td:nth-child(1){
        width: 25%;
    }

    /* Privilege Name */
    .table th:nth-child(2), .table td:nth-child(2){
        width: 25%;
    }
    /* Super Admin */
    .table th:nth-child(3), .table td:nth-child(3){
        width: 25%;
    }
    /* Action */
    .table th:nth-child(4), .table td:nth-child(4){
        width: 25%;
    }

    /* End of Table Column Widths  */

    .table{
        text-align: center;
    }
   

    </style>
@endsection

@section('content')
<section>
    <div class="main-container">
        <p class="header-title">{{trans('ad_default.Privileges')}}</p>

        <a href="{{ route('create-privilege') }}" class="primary-btn mt-2 inline-block">{{trans('ad_default.Add_New_Privilege')}}</a>

        <table class="table">
            <thead>
             <tr>
                <th>{{trans('ad_default.privileges_ID')}}</th>
                <th>{{trans('ad_default.privileges_name')}}</th>
                <th>{{trans('ad_default.privileges_super_admin')}}</th>
                <th>{{trans('ad_default.action_label')}}</th>
             </tr>
            </thead>
    
            <tbody>
                @foreach ($privileges as $priv)
                    <tr>
                        <td>{{ $priv->id}}</td>
                        <td>{{ $priv->name }}</td>
                        <td>
                        <span class="status"
                            @style([$priv->is_superadmin ? 'background: var(--tertiary-color)' : 'background: #1F6268'])>
                            {{ $priv->is_superadmin ? "Super Admin" : "Standard" }}
                        </span>

                           </td>
                        <td><a role="button" href="{{url(config('ad_url.ADMIN_PATH').'/privileges/edit-privilege')."/$priv->id"}}"
                        class="table-btn table-btn--green"><i class="fa-solid fa-pencil"></i></a></td>
           
                    </tr>
                @endforeach
            </tbody>
    
         
        </table>
    </div>
</section>
@endsection