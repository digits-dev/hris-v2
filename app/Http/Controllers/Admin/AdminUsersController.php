<?php

namespace App\Http\Controllers\Admin; 
use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use App\Models\User;

    class AdminUsersController extends Controller{

        private $table_name;
        private $primary_key;
        public function __construct() {
            $this->table_name  = 'users';
            $this->primary_key = 'id';
        }

        public function getIndex(){
            $data = [];
            $datA['page_title'] = 'Add user';
            $data['users'] = User::getData();
            return view('admin/users/view-users',$data);
        }

        public function getAddUser(){
            if(!CommonHelpers::isCreate()) {
                CommonHelpers::redirect(CommonHelpers::adminPath(), trans("ad_default.denied_access"));
            }
            $data = [];
            $data['page_title'] = "Add User";
            $submasters = self::getSubmaster();
            $data = array_merge($submasters, $data);
            return view('admin/users/add-user', $data);

        }

        public function getSubmaster(){
            $data = [];
            $data['departments'] = DB::table('departments')->select('*')->where('status','ACTIVE')->get();
            $data['privileges'] = DB::table('ad_privileges')->select('*')->get();
            $data['companies'] = DB::table('companies')->select('*')->where('status','ACTIVE')->get();
            return $data;
        }
    }

?>