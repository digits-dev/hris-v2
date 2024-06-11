@extends('layout')



@section('css')
    <style>
        :root {
            --primary-color: #1F6268;
            --stroke-color: #599297;
            --secondary-color: #cbfaff;
            --primary-text: #113437;
            --primary-hover: #DDFAFD;
            --tertiary-color: #27C1CE;
        }

        section {
            margin: 1rem 2.5rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .box {
            margin: 10px auto;
        }

        

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-group label {
            font-weight: 600;
            font-family: "Inter", sans-serif;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            border: 1px solid var(--stroke-color);
            border-radius: 5px;
            outline: none;
            padding: 6px 12px;
        }

        .box-body {
            margin: 30px 0;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }




        .table {
            width: 100%;
            margin: 30px 0;
            gap: 0;
            /* border: 1px solid black; */
            border-collapse: collapse;
            text-align: left;
            width: 850px;
        }

        .table thead tr:first-child {
            background: var(--secondary-color);

        }

        .table th {
            color: var(--primary-text);
            font-weight: bold;
            font-family: "Inter", sans-serif;
            padding: 12px 10px;
            font-size: 13px;
        }

        .table thead tr {
            border-bottom: unset;
            border-radius: 10px;
        }

        .table tr {
            color: var(--primary-text);
            font-weight: 600;
            font-family: "Inter", sans-serif;
            border-bottom: 0.1px solid var(--stroke-color);
        }

        .table tbody tr:hover {
            background-color: var(--primary-hover);
        }

        .table td {
            color: var(--primary-text);
            font-weight: 500;
            font-family: "Inter", sans-serif;
            padding: 10px;
            font-size: 12px;
        }


        .table input {
            display: inline-block;
        }

        ::placeholder {
            color: var(--primary-color);
            font-weight: 500;
        }

        input[type="checkbox"] {
            -webkit-appearance: none;
            /* Remove default appearance */
            -moz-appearance: none;
            background-color: white;
            /* Background color when checked */
            appearance: none;
            margin-top: 5px;
            width: 15px;
            height: 15px;
            border: 2px solid var(--stroke-color);
            /* Default border color */
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;
        }

        /* Custom checkbox when checked */
        input[type="checkbox"]:checked {
            background-color: var(--primary-color);
            /* Background color when checked */
            padding: 5px;

        }

        /* Custom checkbox when checked - checkmark */
        input[type="checkbox"]:checked::after {
            content: "\2714";
            /* Checkmark symbol */
            color: white;
            /* Color of the checkmark */
            font-size: 8px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }


        /* Table Column Widths  */

        /* ID  */

        .table th:nth-child(1),
        .table td:nth-child(1) {
            width: 10%;
            padding-left: 40px;
        }

        /* Privilege Name */
        .table th:nth-child(2),
        .table td:nth-child(2) {
            width: 55%;
        }

        /* Super Admin */
        .table th:nth-child(3),
        .table td:nth-child(3) {
            width: 5%;
        }

        /* Action */
        .table th:nth-child(4),
        .table td:nth-child(4) {
            width: 5%;
            text-align: center;
        }

        /* ID  */
        .table th:nth-child(5),
        .table td:nth-child(5) {
            width: 5%;
            text-align: center;
        }

        /* Privilege Name */
        .table th:nth-child(6),
        .table td:nth-child(6) {
            width: 5%;
            text-align: center;
        }

        /* Super Admin */
        .table th:nth-child(7),
        .table td:nth-child(7) {
            width: 5%;
            text-align: center;
        }

        .table th:nth-child(8),
        .table td:nth-child(8) {
            width: 5%;
            text-align: center;

        }
        .table th:nth-child(9),
        .table td:nth-child(9) {
            width: 5%;
     

        }

        /* Action */
        /* End of Table Column Widths  */

        .primary-btn {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            border-radius: 8px;
            font-size: 12px;
            border: 2px solid var(--stroke-color);
            padding: 10px 20px;
            cursor: pointer;
        }

        .primary-btn:hover {
            opacity: 0.9;
        }

        .secondary-btn {
            background-color: white;
            color: var(--primary-color);
            font-weight: 600;
            border-radius: 8px;
            font-size: 12px;
            border: 1px solid var(--stroke-color);
            padding: 10px 20px;
            cursor: pointer;
        }

        .secondary-btn:hover {
            background: var(--primary-hover);
            opacity: 0.9;
        }

      
        .view{
            background-color: rgb(147 197 253);
        }
        .edit{
            background-color: rgb(253 224 71);
        }
        .create{
            background-color: rgb(134 239 172);
        }
        .delete{
            background-color: rgb(252 165 165);
        }
        .select-all{
            background-color: rgb(209 213 219);
        }
    </style>
@endsection

@section('content')

    <section>

        @if (App\Helpers\CommonHelpers::getCurrentMethod() != 'getProfile')
            <p><a href='{{ App\Helpers\CommonHelpers::mainpath() }}'></a></p>
        @endif

        <p class="header-title">{{ $page_title }}</p>


        <!-- Box -->
        <div class="box">
            <form method='post'
                action='{{ @$row->id ? url(config('ad_url.ADMIN_PATH') . '/privileges/edit-privilege-save') . "/$row->id" : route('save-privilege') }}'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="box-body">
                    <p>
                        <strong>Note:</strong> To show the menu you have to create a menu at <strong>Menu
                            Management</strong>
                    </p>

                    <div class="flex gap-5">

                        <div class='form-group w-2/6'>
                            <label>{{ trans('ad_default.privileges_name') }}</label>
                            <input type='text' class='form-control' name='name' required
                                value='{{ @$row->name }}' />
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                        </div>

                        <div class='form-group w-2/6'>
                            <label>{{ trans('ad_default.chose_theme_color') }}</label>
                            <select name='theme_color' class='form-control' required>
                                <option value=''>{{ trans('ad_default.chose_theme_color_select') }}</option>
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
                                <option <?= @$row->theme_color == $skin ? 'selected' : '' ?> value='<?= $skin ?>'>
                                    <?= ucwords(str_replace('-', ' ', $skin)) ?></option>
                                <?php endforeach;?>
                            </select>
                            <div class="text-danger">{{ $errors->first('theme_color') }}</div>
                        @section('script')
                            <script type="text/javascript">
                                $(function() {
                                    $("select[name=theme_color]").change(function() {
                                        var newClass = $(this).val();
                                        $(".navbar-section").each(function() {
                                            var classes = $(this).attr("class").split(" ");
                                            
                                            if (classes.length > 1) {
                                                classes[1] = newClass;
                                            } else {
                                                classes.push(newClass);
                                            }
                                            
                                            $(this).attr("class", classes.join(" "));
                                        });
                                    });

                                    $('#set_as_superadmin input').click(function() {
                                        var n = $(this).val();
                                        if (n == '1') {
                                            $('#privileges_configuration').hide();
                                        } else {
                                            $('#privileges_configuration').show();
                                        }
                                    })

                                    $('#set_as_superadmin input:checked').trigger('click');
                                });

                                $(function() {
                                    $("#is_visible").click(function() {
                                        var is_ch = $(this).prop('checked');
                                        console.log('is checked create ' + is_ch);
                                        $(".is_visible").prop("checked", is_ch);
                                        console.log('Create all');
                                    })
                                    $("#is_create").click(function() {
                                        var is_ch = $(this).prop('checked');
                                        console.log('is checked create ' + is_ch);
                                        $(".is_create").prop("checked", is_ch);
                                        console.log('Create all');
                                    })
                                    $("#is_read").click(function() {
                                        var is_ch = $(this).is(':checked');
                                        $(".is_read").prop("checked", is_ch);
                                    })
                                    $("#is_edit").click(function() {
                                        var is_ch = $(this).is(':checked');
                                        $(".is_edit").prop("checked", is_ch);
                                    })
                                    $("#is_delete").click(function() {
                                        var is_ch = $(this).is(':checked');
                                        $(".is_delete").prop("checked", is_ch);
                                    })
                                    $(".select_horizontal").click(function() {
                                        var p = $(this).parents('tr');
                                        var is_ch = $(this).is(':checked');
                                        p.find("input[type=checkbox]").prop("checked", is_ch);
                                    })
                                })
                            </script>
                        @endsection
                    </div>

                </div>

                <div class='form-group'>
                    <label>{{ trans('ad_default.set_as_superadmin') }}</label>
                    <div id='set_as_superadmin' class='radio'>
                        <label><input required {{ @$row->is_superadmin == 1 ? 'checked' : '' }} type='radio'
                                name='is_superadmin' value='1' />
                            {{ trans('ad_default.confirmation_yes') }}</label> &nbsp;&nbsp;
                        <label><input {{ @$row->is_superadmin == 0 ? 'checked' : '' }} type='radio' name='is_superadmin'
                                value='0' /> {{ trans('ad_default.confirmation_no') }}</label>
                    </div>
                    <div class="text-danger">{{ $errors->first('is_superadmin') }}</div>
                </div>

                <div id='privileges_configuration' class='form-group'>
                    <label> {{ trans('ad_default.privileges_configuration') }}</label>
                    <table class='table'>
                        <thead>
                            <tr class='active'>
                                <th width='3%'> {{ trans('ad_default.privileges_module_list_no') }}</th>
                                <th width='60%'> {{ trans('ad_default.privileges_module_list_mod_names') }}</th>
                                <th>&nbsp;</th>
                                <th>View</th>
                                <th>Create</th>
                                <th>Read</th>
                                <th>Update</th>
                                <th>Delete</th>
                                <th>&nbsp;</th>

                            </tr>
                            <tr class='info'>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <td><input title='Check all vertical' type='checkbox' id='is_visible' /></td>
                                <td><input title='Check all vertical' type='checkbox' id='is_create' /></td>
                                <td><input title='Check all vertical' type='checkbox' id='is_read' /></td>
                                <td><input title='Check all vertical' type='checkbox' id='is_edit' /></td>
                                <td><input title='Check all vertical' type='checkbox' id='is_delete' /></td>
                                <td></td>

                            </tr>
                        </thead>
                        <tbody>

                            <?php $no = 1; ?>
                            @foreach ($modules as $modul)
                                <?php
                                $roles = DB::table('ad_privileges_roles')
                                    ->where('id_ad_modules', $modul->id)
                                    ->where('id_ad_privileges', @$row->id)
                                    ->first();
                                ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td>{{ $modul->name }}</td>
                                    <td class='info'><input type='checkbox' title='Check All Horizontal'
                                            <?= @$roles->is_create && @$roles->is_read && @$roles->is_edit && @$roles->is_delete ? 'checked' : '' ?>
                                            class='select_horizontal' />
                                    </td>
                                    <td ><input type='checkbox' class='is_visible'
                                            name='privileges[<?= $modul->id ?>][is_visible]'
                                            <?= @$roles->is_visible ? 'checked' : '' ?> value='1' />
                                    </td>

                                    <td class='warning'><input type='checkbox' class='is_create'
                                            name='privileges[<?= $modul->id ?>][is_create]'
                                            <?= @$roles->is_create ? 'checked' : '' ?> value='1' /></td>
                                    <td class='info'><input type='checkbox' class='is_read'
                                            name='privileges[<?= $modul->id ?>][is_read]'
                                            <?= @$roles->is_read ? 'checked' : '' ?> value='1' /></td>
                                    <td class='success'><input type='checkbox' class='is_edit'
                                            name='privileges[<?= $modul->id ?>][is_edit]'
                                            <?= @$roles->is_edit ? 'checked' : '' ?> value='1' /></td>
                                    <td class='danger'><input type='checkbox' class='is_delete'
                                            name='privileges[<?= $modul->id ?>][is_delete]'
                                            <?= @$roles->is_delete ? 'checked' : '' ?> value='1' /></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="flex gap-3 float-end">
                <button type='button' onclick="location.href='{{ App\Helpers\CommonHelpers::mainpath() }}'"
                    class='secondary-btn'>{{ trans('ad_default.button_cancel') }}</button>
                <button type='submit' class='primary-btn'>
                    {{ trans('ad_default.button_save') }}</button>
            </div>
    </div>

</section>
@endsection
