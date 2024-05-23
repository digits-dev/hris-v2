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

class MenusController extends Controller{
    private $table_name;
    private $primary_key;
    public function __construct() {
        $this->table_name  =  'ad_privileges';
        $this->primary_key = 'id';
    }

    public function getIndex(Request $request){
        $data = [];
   
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(CommonHelpers::adminPath(), 'Denied Access');
        }

        $data['privileges'] = DB::table('ad_privileges')->get();

        $data['id_ad_privileges'] = $request->id_ad_privileges;
        $data['id_ad_privileges'] = ($data['id_ad_privileges']) ?: CommonHelpers::myPrivilegeId();

        $data['menu_active'] = DB::table('ad_menuses')->where('parent_id', 0)->where('is_active', 1)->orderby('sorting', 'asc')->get();

        foreach ($data['menu_active'] as &$menu) {
            $child = DB::table('ad_menuses')->where('is_active', 1)->where('parent_id', $menu->id)->orderby('sorting', 'asc')->get();
            if (count($child)) {
                $menu->children = $child;
            }
        }

        $data['menu_inactive'] = DB::table('ad_menuses')->where('parent_id', 0)->where('is_active', 0)->orderby('sorting', 'asc')->get();

        foreach ($data['menu_inactive'] as &$menu) {
            $child = DB::table('ad_menuses')->where('is_active', 1)->where('parent_id', $menu->id)->orderby('sorting', 'asc')->get();
            if (count($child)) {
                $menu->children = $child;
            }
        }
        $data['return_url'] = $request->fullUrl();
        $data['page_title'] = 'Menu Management';
        return view('admin/menus/view-menus',$data);
    }

    public function postAddSave(Request $request){
        $post = $request->menus;
        $isActive = $request->isActive;
        $post = json_decode($post, true);
        $i = 1;
        foreach ($post[0] as $ro) {
            $pid = $ro['id'];
            if (isset($ro['children'][0])) {
                $ci = 1;
                foreach ($ro['children'][0] as $c) {
                    $id = $c['id'];
                    DB::table('ad_menuses')->where('id', $id)->update(['sorting' => $ci, 'parent_id' => $pid, 'is_active' => $isActive]);
                    $ci++;
                }
            }
            DB::table('ad_menuses')->where('id', $pid)->update(['sorting' => $i, 'parent_id' => 0, 'is_active' => $isActive]);
            $i++;
        }

        return response()->json(['success' => true]);
    }

    public function getEdit($id){
        $data = [];
        if (!CommonHelpers::isView()) {
            CommonHelpers::redirect(CommonHelpers::adminPath(), 'Denied Access');
        }
        $data['page_title'] = "Edit Menus";
        $data['menus'] = DB::table('ad_menuses')->where('id',$id)->first();
        $data['privileges'] = DB::table('ad_privileges')->get();
        $data['menu_priv'] = DB::table('ad_menus_privileges')
                    ->join('ad_privileges','ad_privileges.id','=','ad_menus_privileges.id_ad_privileges')
                    ->where('id_ad_menus',$id)->pluck('ad_privileges.name')->toArray();
        return view('admin/menus/edit-menus',$data);
    }

    public function postEditSave(Request $request){
        $privileges = $request->privileges_id;
        $menuId     = $request->mune_id;
        foreach($privileges as $privs){
            DB::table('ad_menus_privileges')->updateOrInsert(
                [
                    'id_ad_menus'       => $menuId,
                    'id_ad_privileges'  => $privs
                ],
                [
                    'id_ad_menus'       => $menuId,
                    'id_ad_privileges'  => $privs
                ]
            );
        }
        CommonHelpers::redirect(CommonHelpers::mainpath(), "Edit successfully!", 'success');
    }
}

?>