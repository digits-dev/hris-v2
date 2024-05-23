@extends('layout')
    @section('css')
     <link rel="stylesheet" href="{{ asset ('css/bootstrap-utilities/utilities.css') }}">
    @endsection
@section('content')
    <section class="content">
        <div class='panel panel-default'>
            <div class='panel-heading'>
               Edit Menus
            </div>
            <div class='panel-body'>
                <form class="form-horizontal" method="post" id="form" enctype="multipart/form-data" action="{{ url(config('ad_url.ADMIN_PATH').'/menu_management/edit-menu-save')."/".$menus->id }}">
                <input type="hidden" name="mune_id" value="{{ $menus->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"> Privilege</label>
                            <select selected data-placeholder="Choose prvileges" id="privileges_id" name="privileges_id[]" class="form-select select2" style="width:100%;" multiple>
                                @foreach($privileges as $data)
                                    <option value="{{$data->id}}" {{ (in_array($data->name,$menu_priv)) ? "selected" : ""}}>
                                        {{$data->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{$menus->name}}">
                        </div>
                    </div>
                    <div class='panel-footer'>
                        <a href="{{ App\Helpers\CommonHelpers::mainpath() }}" class="btn btn-default">{{ trans('ad_lang.form-btn.cancel') }}</a>
                        <button class="btn btn-success pull-right" type="submit" id="btnUpdate"> <i class="fa fa-save" ></i> {{ trans('ad_lang.form-btn.update') }}</button>
                    </div>
                </form> 
                </div>
            </div>
    </section>
@endsection

@section('script')
 <script>
    $('#privileges_id').select2([]);
 </script>
@endsection