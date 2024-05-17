<?php

namespace App\Http\Controllers\Admin; 
use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use App\Models\Privileges;

class PrivilegesController extends Controller{
    private $table_name;
    public function __construct() {
        $this->table_name  =  'ad_privileges';
    }

    public function getIndex(){
        $data = [];
        $data['privileges'] = Privileges::getData();
        return view('admin/ad-privilege',$data);
    }

    public function getCreate(){
        if(!CommonHelpers::isCreate()) {
            echo 'error!';
        }
        $id = 0;
        $data = [];
        $data['page_title'] = "Add Data";
        $data['modules'] = DB::table("ad_modules")->where('is_protected', 0)->whereNull('deleted_at')
         ->select("ad_modules.*", 
                DB::raw("(select is_visible from ad_privileges_roles where id_ad_modules = ad_modules.id and id_ad_privileges = '$id') as is_visible"), 
                DB::raw("(select is_create from ad_privileges_roles where id_ad_modules  = ad_modules.id and id_ad_privileges = '$id') as is_create"), 
                DB::raw("(select is_read from ad_privileges_roles where id_ad_modules    = ad_modules.id and id_ad_privileges = '$id') as is_read"), 
                DB::raw("(select is_edit from ad_privileges_roles where id_ad_modules    = ad_modules.id and id_ad_privileges = '$id') as is_edit"), 
                DB::raw("(select is_delete from ad_privileges_roles where id_ad_modules  = ad_modules.id and id_ad_privileges = '$id') as is_delete")
                )
         ->orderby("name", "asc")->get();
        return view('admin/create-privilege',$data);
    }

    public function postAddSave(Request $request){
    
        if (!CommonHelpers::isCreate()) {
            echo 'error';
        }

        $savePriv = [
            "name" => $request->name,
            "is_superadmin" => $request->is_superadmin,
            "theme_color" => $request->theme_color
        ];

      
        $id = DB::table($this->table_name)->insertGetId($savePriv);

        //set theme
        Session::put('theme_color', $request->theme_color);

        $priv = $request->privileges;
  
        if ($priv) {
            foreach ($priv as $id_modul => $data) {
                $arrs = [];
                $arrs['is_visible'] = @$data['is_visible'] ?: 0;
                $arrs['is_create'] = @$data['is_create'] ?: 0;
                $arrs['is_read'] = @$data['is_read'] ?: 0;
                $arrs['is_edit'] = @$data['is_edit'] ?: 0;
                $arrs['is_delete'] = @$data['is_delete'] ?: 0;
                $arrs['id_ad_privileges'] = $id;
                $arrs['id_ad_modules'] = $id_modul;
                DB::table("ad_privileges_roles")->insert($arrs);

                $module = DB::table('ad_modules')->where('id', $id_modul)->first();
            }
        }

        //Refresh Session Roles
        $roles = DB::table('ad_privileges_roles')->where('id_ad_privileges', CommonHelpers::myPrivilegeId())->join('ad_modules', 'ad_modules.id', '=', 'id_ad_modules')->select('ad_modules.name', 'ad_modules.path', 'is_visible', 'is_create', 'is_read', 'is_edit', 'is_delete')->get();
        Session::put('admin_privileges_roles', $roles);

        CommonHelpers::redirect(CommonHelpers::mainpath(), "Created Succefully", 'success');
    }
}

?>