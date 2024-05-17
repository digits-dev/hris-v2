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
            <form method='post'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-body">
                    <div class="alert alert-info">
                        <strong>Note:</strong> To show the menu you have to create a menu at Menu Management
                    </div>
                    <div class='form-group'>
                        <label>privileges_name</label>
                        <input type='text' class='form-control' name='name' required/>
                        <div class="text-danger">{{ $errors->first('name') }}</div>
                    </div>

                    <div class='form-group'>
                        <label>set_as_superadmin</label>
                        <div id='set_as_superadmin' class='radio'>
                            <label><input required type='radio' name='is_superadmin'
                                          value='1'/> confirmation_yes</label> &nbsp;&nbsp;
                            <label><input type='radio' name='is_superadmin'
                                          value='0'/> confirmation_no</label>
                        </div>
                        <div class="text-danger">{{ $errors->first('is_superadmin') }}</div>
                    </div>

                    <div class='form-group'>
                        <label>chose_theme_color</label>
                        <select name='theme_color' class='form-control' required>
                            <option value=''>chose_theme_color_select</option>
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
                            <option value='<?=$skin?>'><?=ucwords(str_replace('-', ' ', $skin))?></option>
                            <?php endforeach;?>
                        </select>
                        <div class="text-danger">{{ $errors->first('theme_color') }}</div>
                        @push('bottom')
                            <script type="text/javascript">
                                $(function () {
                                    $("select[name=theme_color]").change(function () {
                                        var n = $(this).val();
                                        $("body").attr("class", n);
                                    })

                                    $('#set_as_superadmin input').click(function () {
                                        var n = $(this).val();
                                        if (n == '1') {
                                            $('#privileges_configuration').hide();
                                        } else {
                                            $('#privileges_configuration').show();
                                        }
                                    })

                                    $('#set_as_superadmin input:checked').trigger('click');
                                })
                            </script>
                        @endpush
                    </div>

                    <div id='privileges_configuration' class='form-group'>
                        <label>privileges_configuration</label>
                        @push('bottom')
                            <script>
                                $(function () {
                                    $("#is_visible").click(function () {
                                        var is_ch = $(this).prop('checked');
                                        console.log('is checked create ' + is_ch);
                                        $(".is_visible").prop("checked", is_ch);
                                        console.log('Create all');
                                    })
                                    $("#is_create").click(function () {
                                        var is_ch = $(this).prop('checked');
                                        console.log('is checked create ' + is_ch);
                                        $(".is_create").prop("checked", is_ch);
                                        console.log('Create all');
                                    })
                                    $("#is_read").click(function () {
                                        var is_ch = $(this).is(':checked');
                                        $(".is_read").prop("checked", is_ch);
                                    })
                                    $("#is_edit").click(function () {
                                        var is_ch = $(this).is(':checked');
                                        $(".is_edit").prop("checked", is_ch);
                                    })
                                    $("#is_delete").click(function () {
                                        var is_ch = $(this).is(':checked');
                                        $(".is_delete").prop("checked", is_ch);
                                    })
                                    $(".select_horizontal").click(function () {
                                        var p = $(this).parents('tr');
                                        var is_ch = $(this).is(':checked');
                                        p.find("input[type=checkbox]").prop("checked", is_ch);
                                    })
                                })
                            </script>
                        @endpush
                        <table class='table table-striped table-hover table-bordered'>
                            <thead>
                            <tr class='active'>
                                <th width='3%'> list</th>
                                <th width='60%'> Modules Name's</th>
                                <th>&nbsp;</th>
                                <th>View</th>
                                <th>Create</th>
                                <th>Read</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            <tr class='info'>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <td align="center"><input title='Check all vertical' type='checkbox' id='is_visible'/></td>
                                <td align="center"><input title='Check all vertical' type='checkbox' id='is_create'/></td>
                                <td align="center"><input title='Check all vertical' type='checkbox' id='is_read'/></td>
                                <td align="center"><input title='Check all vertical' type='checkbox' id='is_edit'/></td>
                                <td align="center"><input title='Check all vertical' type='checkbox' id='is_delete'/></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;?>
                            @foreach($modules as $modul)
                             
                                <tr>
                                    <td><?php echo $no++;?></td>
                                    <td>{{$modul->name}}</td>
                                    <td class='info' align="center"><input type='checkbox' title='Check All Horizontal'
                                                                          class='select_horizontal'/>
                                    </td>
                                    <td class='active' align="center"><input type='checkbox' class='is_visible' name='privileges[<?=$modul->id?>][is_visible]'
                                                                             value='1'/></td>
                                    <td class='warning' align="center"><input type='checkbox' class='is_create' name='privileges[<?=$modul->id?>][is_create]'
                                                                             value='1'/></td>
                                    <td class='info' align="center"><input type='checkbox' class='is_read' name='privileges[<?=$modul->id?>][is_read]'
                                                                            value='1'/></td>
                                    <td class='success' align="center"><input type='checkbox' class='is_edit' name='privileges[<?=$modul->id?>][is_edit]'
                                                                               value='1'/></td>
                                    <td class='danger' align="center"><input type='checkbox' class='is_delete' name='privileges[<?=$modul->id?>][is_delete]'
                                                                             value='1'/></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div><!-- /.box-body -->
                <div class="box-footer" align="right">
                    <button type='button' onclick="location.href='{{App\Helpers\CommonHelpers::mainpath()}}'"
                            class='btn btn-default'>button_cancel</button>
                    <button type='submit' class='btn btn-primary'><i class='fa fa-save'></i> button_save</button>
                </div><!-- /.box-footer-->
        </div><!-- /.box -->

    </div><!-- /.row -->
@endsection