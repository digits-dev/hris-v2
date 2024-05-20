@extends('layout')
<link rel="stylesheet" href="{{ asset('css/navigation/section.css') }}">
@section('content')
<section>
    <div class="main-container">
        <div class="date-container">
            <span class="font-bold">Privileges</span>
            <a href="{{ route('create-privilege') }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-1 dark:bg-green-700 dark:hover:bg-green-700 dark:focus:ring-green-800"> <i class="fa fa-circle-plus"></i> Add Privilege</a>
            <p class="date" id="Date"></p>
        </div>

        <table class="table">
            <thead>
             <tr>
                <th>Action</th>
                <th>ID</th>
                <th>Name</th>
                <th>Superadmin</th>
             </tr>
            </thead>
    
          
            
            <tbody>
                @foreach ($privileges as $priv)
                    <tr>
                        <td><a class="" href="{{url(config('ad_url.ADMIN_PATH').'/privileges/edit-privilege')."/$priv->id"}}"> <i class="fa fa-edit"></i> Edit</a></td>
                        <td>{{ $priv->id}}</td>
                        <td>{{ $priv->name }}</td>
                        <td>{{ $priv->is_superadmin }}</td>
                    </tr>
                @endforeach
            </tbody>
    
    
        </table>
    </div>
</section>
@endsection