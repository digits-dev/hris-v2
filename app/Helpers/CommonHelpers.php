<?php

namespace app\Helpers;

use Cache;
use DB;
use Image;
use Request;
use Route;
use Schema;
use Session;
use Storage;
use Validator;

class CommonHelpers {

    public static function getMainControllerFiles() {
        $controllers = glob(__DIR__.'/../../app/Http/Controllers/Admin/*.php');
        $result = [];
        foreach ($controllers as $file) {
            $result[] = str_replace('.php', '', basename($file));
        }
        return $result;
    }

    public static function getLivewireControllerFiles() {
        $controllers = glob(__DIR__.'/../../app/Livewire/Component/ModuleContents/*/*.php');
        $livewireFolder = glob(__DIR__.'/../../app/Livewire/Component/ModuleContents/*');
        $result = [];
      
        foreach ($controllers as $file) {
            $parsedUrl = parse_url($file);

            // Extract the path component
            $path = $parsedUrl['path'];
            
            // Get the directory path
            $directoryPath = dirname($path);
            
            // Get the folder name immediately preceding the basename
            $precedingFolder = basename($directoryPath);
     
            $result[] = str_replace('.php', '', $precedingFolder. "\\" .basename($file));
        }
        return $result;
    }

    public static function isSuperadmin(){
        return Session::get('admin_is_superadmin');
    }

    public static function myPrivilegeId()
    {
        return Session::get('admin_privileges');
    }

    public static function sidebarDashboard(){
        $menu = DB::table('ad_menuses')->whereRaw("ad_menuses.id IN (select id_ad_menus from ad_menus_privileges where id_ad_privileges = '".self::myPrivilegeId()."')")->where('is_dashboard', 1)->where('is_active', 1)->first();
        if($menu){
            switch ($menu->type) {
                case 'Route':
                    $url = route($menu->path);
                    break;
                default:
                case 'URL':
                    $url = $menu->path;
                    break;
                case 'Controller & Method':
                    $url = action($menu->path);
                    break;
                case 'Module':
                case 'Statistic':
                    $url = self::adminPath($menu->path);
                    break;
            }
            @$menu->url = $url;
        }
    
        return $menu;
    }

    public static function sidebarMenu(){
        $menu_active = DB::table('ad_menuses')
        ->whereRaw("ad_menuses.id IN (select id_ad_menus from ad_menus_privileges where id_ad_privileges = '".self::myPrivilegeId()."')")
        ->where('parent_id', 0)
        ->where('is_active', 1)
        ->where('is_dashboard', 0)
        ->orderby('sorting', 'asc')
        ->select('ad_menuses.*')->get();
 
        foreach ($menu_active as &$menu) {
            try {
                switch ($menu->type) {
                    case 'Route':
                        $url = route($menu->path);
                        break;
                    default:
                    case 'URL':
                        $url = $menu->path;
                        break;
                    case 'Controller & Method':
                        $url = action($menu->path);
                        break;
                    case 'Module':
                    case 'Statistic':
                        $url = self::adminPath($menu->path);
                        break;
                }

                $menu->is_broken = false;
            } catch (\Exception $e) {
                $url = "#";
                $menu->is_broken = true;
            }

            $menu->url = $url;
            $menu->url_path = trim(str_replace(url('/'), '', $url), "/");

            $child = DB::table('ad_menuses')->whereRaw("ad_menuses.id IN (select id_ad_menus from ad_menus_privileges where id_ad_privileges = '".self::myPrivilegeId()."')")->where('is_dashboard', 0)->where('is_active', 1)->where('parent_id', $menu->id)->select('ad_menuses.*')->orderby('sorting', 'asc')->get();
            if (count($child)) {

                foreach ($child as &$c) {

                    try {
                        switch ($c->type) {
                            case 'Route':
                                $url = route($c->path);
                                break;
                            default:
                            case 'URL':
                                $url = $c->path;
                                break;
                            case 'Controller & Method':
                                $url = action($c->path);
                                break;
                            case 'Module':
                            case 'Statistic':
                                $url = self::adminPath($c->path);
                                break;
                        }
                        $c->is_broken = false;
                    } catch (\Exception $e) {
                        $url = "#";
                        $c->is_broken = true;
                    }

                    $c->url = $url;
                    $c->url_path = trim(str_replace(url('/'), '', $url), "/");
                }

                $menu->children = $child;
            }
        }
       
    
        return $menu_active;
    }

    public static function adminPath($path = null)
    {
        return url(config('ad_url.ADMIN_PATH').'/'.$path);
    }

    public static function routeController($prefix, $controller, $namespace = null){
        $prefix = trim($prefix, '/').'/';
        $namespace = ($namespace) ?: 'App\Http\Controllers\Admin';
   
        try {
            Route::get($prefix, ['uses' => $controller.'@getIndex', 'as' => $controller.'GetIndex']);

            $controller_class = new \ReflectionClass($namespace.'\\'.$controller);
            $controller_methods = $controller_class->getMethods(\ReflectionMethod::IS_PUBLIC);
            $wildcards = '/{one?}/{two?}/{three?}/{four?}/{five?}';
            foreach ($controller_methods as $method) {

                if ($method->class != 'Illuminate\Routing\Controller' && $method->name != 'getIndex') {
                    if (substr($method->name, 0, 3) == 'get') {
                        $method_name = substr($method->name, 3);
                        $slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
                        $slug = strtolower(implode('-', $slug));
                        $slug = ($slug == 'index') ? '' : $slug;
                        Route::get($prefix.$slug.$wildcards, ['uses' => $controller.'@'.$method->name, 'as' => $controller.'Get'.$method_name]);
                    } elseif (substr($method->name, 0, 4) == 'post') {
                        $method_name = substr($method->name, 4);
                        $slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
                        Route::post($prefix.strtolower(implode('-', $slug)).$wildcards, [
                            'uses' => $controller.'@'.$method->name,
                            'as' => $controller.'Post'.$method_name,
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {

        }
    }

    public static function routeLivewireController($prefix, $controller, $namespace = null){
        $prefix = trim($prefix, '/').'/';
        $namespace = ($namespace) ?: 'App\Livewire\Component\ModuleContents';
   
        try {
            Route::get($prefix, ['uses' => $controller.'@index', 'as' => $controller.'GetIndex']);

            $controller_class = new \ReflectionClass($namespace.'\\'.$controller);
            $controller_methods = $controller_class->getMethods(\ReflectionMethod::IS_PUBLIC);
            $wildcards = '/{one?}/{two?}/{three?}/{four?}/{five?}';
            foreach ($controller_methods as $method) {
                if ($method->class != 'Illuminate\Routing\Controller' && $method->name != 'index') {
                    if (substr($method->name, 0, 3) == 'get') {
                        $method_name = substr($method->name, 3);
                        $slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
                        $slug = strtolower(implode('-', $slug));
                        $slug = ($slug == 'index') ? '' : $slug;
                        Route::get($prefix.$slug.$wildcards, ['uses' => $controller.'@'.$method->name, 'as' => $controller.'Get'.$method_name]);
                    } elseif (substr($method->name, 0, 4) == 'post') {
                        $method_name = substr($method->name, 4);
                        $slug = array_filter(preg_split('/(?=[A-Z])/', $method_name));
                        Route::post($prefix.strtolower(implode('-', $slug)).$wildcards, [
                            'uses' => $controller.'@'.$method->name,
                            'as' => $controller.'Post'.$method_name,
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {

        }
    }
}