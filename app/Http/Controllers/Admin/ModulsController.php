<?php

namespace App\Http\Controllers\Admin; 
use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use App\Models\AdModules;
use App\Models\AdMenus;
use File;

class ModulsController extends Controller{

    private $table_name;
    private $primary_key;
    public function __construct() {
        $this->table_name  = 'ad_modules';
        $this->primary_key = 'id';
    }

    public function getIndex(){
        $data = [];
        $datA['page_title'] = 'Add New Module';
        $data['modules'] = DB::table("ad_modules")->where('is_protected', 0)->where('deleted_at', null)->select("ad_modules.*")->orderby("name", "asc")->get();
        return view('admin/modules/view-modules',$data);
    }

    public function getAddModuls(){
        if(!CommonHelpers::isCreate()) {
            CommonHelpers::redirect(CommonHelpers::adminPath(), trans("ad_default.denied_access"));
        }
        $data = [];
        $data['page_title'] = "Add Module";
        return view('admin/modules/add-module', $data);
    }

    public function postAddSave(Request $request){
        if (!CommonHelpers::isCreate()) {
            CommonHelpers::redirect(CommonHelpers::adminPath(), trans("ad_default.denied_access"));
        }

        //CREATE FILE
        if($request->type === 'Livewire'){
            $folderName = $request->controller;
            $contentName = $request->controller.'Content';
            $viewFolderName = preg_split('/(?=[A-Z])/',$request->controller);
            $viewContentName = preg_split('/(?=[A-Z])/',$request->controller);

            $finalViewFolderName = strtolower($viewFolderName[1])."-".strtolower($viewFolderName[2]);
            $finalViewContentName = strtolower($viewContentName[1])."-".strtolower($viewContentName[2]).'-'.'content';
      
            //MAKE FOLDER
            $folder = base_path('app/Livewire/Component/ModuleContents/'.$folderName);
            File::makeDirectory($folder, $mode = 0777, true, true);
            //MAKE FILE CONTENT
            $path = base_path("app/Livewire/Component/ModuleContents/$folderName/");
            $php = self::livewireContent($contentName,$folderName);
            $php = trim($php);
            file_put_contents($path.$contentName.'.php', $php);
            //MAKE FOLDER VIEW CONTENT
            $makeFolderViewContent = base_path('resources/views/livewire/component/module-contents/'.$finalViewFolderName);
            File::makeDirectory($makeFolderViewContent, $mode = 0777, true, true);
            //MAKE VIEW CONTENT
            $pathView = base_path("resources/views/livewire/component/module-contents/$finalViewFolderName/");
            $viewContent = self::viewContent();
            $viewContent = trim($viewContent);
            file_put_contents($pathView.$finalViewContentName.'.blade.php', $viewContent);
            //CREATE MODULE
            DB::table('ad_modules')->insert([
                'name'         => $request->name,
                'icon'         => $request->icon,
                'path'         => $request->path,
                'table_name'   => NULL,
                'controller'   => $folderName."\\".$contentName,
                'is_protected' => 0,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s')
            ]);
            //CREATE MENUS
            $menusId = DB::table('ad_menuses')->insertGetId([
                'name'                => $request->name,
                'type'                => 'Route',
                'icon'                => $request->icon,
                'path'                => $folderName."\\".$contentName.'GetIndex',
                'color'               => NULL,
                'parent_id'           => 0,
                'is_active'           => 1,
                'is_dashboard'        => 0,
                'id_ad_privileges'    => 1,
                'sorting'             => 1,
                'created_at'          => date('Y-m-d H:i:s')
            ]);
            //CREATE MENUS PRIVILEGE
            DB::table('ad_menus_privileges')->insert(['id_ad_menus' => $menusId, 'id_ad_privileges' => CommonHelpers::myPrivilegeId()]);

        }else{
            $controllerName = $request->controller.'Controller';
            $viewFileName = preg_split('/(?=[A-Z])/',$request->controller);
            $finalViewFileName = strtolower($viewFileName[1])."-".strtolower($viewFileName[2]);
            //MAKE FILE CONTROLLER
            $path = base_path("app/Http/Controllers/Admin/");
            $php = self::controllerContent($controllerName, $finalViewFileName);
            $php = trim($php);
            file_put_contents($path.$controllerName.'.php', $php);
            //MAKE FILE VIEW
            //MAKE FOLDER FILE VIEW 
            $makeFolderAdminFile = base_path('resources/views/admin/'.$finalViewFileName);
            File::makeDirectory($makeFolderAdminFile, $mode = 0777, true, true);
            $pathView = base_path("resources/views/admin/$finalViewFileName/");
            $viewContent = self::viewContent();
            $viewContent = trim($viewContent);
            file_put_contents($pathView.$finalViewFileName.'.blade.php', $viewContent);
              //CREATE MODULE
              DB::table('ad_modules')->insert([
                'name'         => $request->name,
                'icon'         => $request->icon,
                'path'         => $request->path,
                'table_name'   => NULL,
                'controller'   => $controllerName,
                'is_protected' => 0,
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s')
            ]);
            //CREATE MENUS
            $menusId = DB::table('ad_menuses')->insertGetId([
                'name'                => $request->name,
                'type'                => 'Route',
                'icon'                => $request->icon,
                'path'                => $controllerName.'GetIndex',
                'color'               => NULL,
                'parent_id'           => 0,
                'is_active'           => 1,
                'is_dashboard'        => 0,
                'id_ad_privileges'    => 1,
                'sorting'             => 1,
                'created_at'          => date('Y-m-d H:i:s')
            ]);
            //CREATE MENUS PRIVILEGE
            DB::table('ad_menus_privileges')->insert(['id_ad_menus' => $menusId, 'id_ad_privileges' => CommonHelpers::myPrivilegeId()]);

        }

        CommonHelpers::redirect(CommonHelpers::mainpath(), "Modules created successfully", 'success');
    
    }

    public function livewireContent($contentName, $folderName){
        return '<?php
        namespace App\Livewire\Component\ModuleContents\"'.$folderName'";
        use Livewire\Component;
        use App\Helpers\CommonHelpers;
        
        class '.$contentName.' extends Component{
            public function index(){}
            public function render(){
                return view("livewire.component.module-contents.employee-accounts.employee-accounts-content");
            }
        } ?>';
    }

    public function controllerContent($controllerName, $finalViewFileName){
        return '<?php

                namespace App\Http\Controllers\Admin; 
                use App\Helpers\CommonHelpers;
                use App\Http\Controllers\Controller;
                use Illuminate\Http\Request;
                use Illuminate\Http\RedirectResponse;
                use Illuminate\Support\Facades\Auth;
                use Illuminate\Support\Facades\Session;
                use DB;
        
                class '.$controllerName.' extends Controller{
                    public function getIndex(){
                        return view("admin/'.$finalViewFileName.'/'.$finalViewFileName.'");
                    }
                }
                ?>';
    }

    public function viewContent(){
        return '@extend("layout")
                @section("content")
                @endsection';
    }

}

?>