@extends('layout')
@section('content')
<section>

    <form method='post' action='{{ route("save-module") }}'>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="personal-content">
                <div class="personal-content-inputs">
                    <label for="first-name">{{trans('ad_default.privileges_module_list_mod_names')}} 
                        <input type="text" name="name" id="name">
                    </label>
                    <label for="last-name">{{trans('ad_lang.form-header.path')}} 
                        <input type="text" name="path" id="path">
                    </label>
                    <label for="last-name">{{trans('ad_lang.form-header.icon')}} 
                        <input type="text" name="icon" id="icon">
                    </label>
                    <label for="last-name">{{trans('ad_lang.form-header.controller')}} 
                        <input type="text" name="controller" id="controller">
                    </label>
                    <label for="last-name">{{trans('ad_lang.form-header.type')}} 
                        <select name='type' class='form-control' required>
                            <option value=''>{{trans('ad_lang.form-header.choose-type')}}</option>
                            <?php
                            $skins = array(
                                'Controller',
                                'Livewire'
                            ); ?>
                            @foreach($skins as $skin)
                             <option value='{{$skin}}'>{{$skin}}</option>
                            @endforeach;
                        </select>
                    </label>
                </div>
            </div>

        <div class="flex w-full justify-between">
            <button type='button' onclick="location.href='{{App\Helpers\CommonHelpers::mainpath()}}'"
                            class='btn btn-default'>{{trans('ad_default.button_cancel')}}</button>
            <button type='submit' class='btn btn-primary'><i class='fa fa-save'></i> {{trans('ad_default.button_save')}}</button>
        </div>
    </form>
</section>
@endsection