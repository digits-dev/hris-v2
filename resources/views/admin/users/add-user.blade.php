@extends('layout')

@section('content')

    <div style="width:750px;margin:0 auto ">

    @if(App\Helpers\CommonHelpers::getCurrentMethod() != 'getProfile')
        <p><a href='{{App\Helpers\CommonHelpers::mainpath()}}'></a></p>
    @endif

    <!-- Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $page_title }}</h3>
                <div class="box-tools">

                </div>
            </div>

            <form method='post' action='{{ (@$row->id) ? url(config('ad_url.ADMIN_PATH').'/privileges/edit-privilege-save')."/$row->id" : route("save-privilege") }}'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-body">
                    <div class="alert alert-info">
                        <strong>Note:</strong> To show the menu you have to create a menu at Menu Management
                    </div>
                    <div class='form-group'>
                        <label>{{trans('ad_default.privileges_name')}}</label>
                        <input type='text' class='form-control' name='name' required value='{{ @$row->name }}' />
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    </div>

                    <div class='form-group'>
                        <label>{{trans('ad_default.set_as_superadmin')}}</label>
                        <div id='set_as_superadmin' class='radio'>
                            <label><input required {{ (@$row->is_superadmin==1)?'checked':'' }} type='radio' name='is_superadmin'
                                value='1'/> {{trans('ad_default.confirmation_yes')}}</label> &nbsp;&nbsp;
                            <label><input {{ (@$row->is_superadmin==0)?'checked':'' }} type='radio' name='is_superadmin'
                                value='0'/> {{trans('ad_default.confirmation_no')}}</label>
                        </div>
                        <div class="text-danger">{{ $errors->first('is_superadmin') }}</div>
                    </div>

                    <div class='form-group'>
                        <label>{{trans('ad_default.chose_theme_color')}}</label>
                        <select name='theme_color' class='form-control' required>
                            <option value=''>{{trans('ad_default.chose_theme_color_select')}}</option>
                            <?php
                            $skins = array(
                                'skin-blue',
                                'skin-blue-light',
                                'skin-yellow',
                                'skin-yellow-light',
                                'skin-green',
                                'skin-green-light',
                                'skin-purple',
                                'skin-purple-light',
                                'skin-red',
                                'skin-red-light',
                                'skin-black',
                                'skin-black-light'
                            );
                            foreach($skins as $skin):
                            ?>
                            <option <?=(@$row->theme_color == $skin) ? "selected" : ""?> value='<?=$skin?>'><?=ucwords(str_replace('-', ' ', $skin))?></option>
                            <?php endforeach;?>
                        </select>
             
                    </div>


                </div><!-- /.box-body -->
                <div class="box-footer" align="right">
                    <button type='button' onclick="location.href='{{App\Helpers\CommonHelpers::mainpath()}}'"
                            class='btn btn-default'>{{trans('ad_default.button_cancel')}}</button>
                    <button type='submit' class='btn btn-primary'><i class='fa fa-save'></i> {{trans('ad_default.button_save')}}</button>
                </div><!-- /.box-footer-->
        </div><!-- /.box -->

    </div><!-- /.row -->
@endsection