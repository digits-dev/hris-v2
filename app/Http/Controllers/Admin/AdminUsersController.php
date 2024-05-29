<?php

namespace App\Http\Controllers\Admin; 
use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
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

        public function getChangePasswordView(){
            $data = [];
            $data['page_title'] = "Change Password";
            return view('admin/users/change-password', $data);
        }

        public function postUpdatePassword(Request $request){
            $user = User::find(CommonHelpers::myId());
            if (Hash::check($request->all()['current_password'], $user->password)){
          
                $request->validate([
                    'new_password' => 'required',
                    'confirmation_password' => 'required|same:new_password'
                ]);
          
                $user->password = Hash::make($request->get('new_password'));
                $user->save();
  
                return CommonHelpers::redirect(url('/change-password'), "Password Updated, You Will Be Logged-Out.", "success");
                
            } else {
                return CommonHelpers::redirect(url('/change-password'), "Incorrect Current Password.", "danger");
            }
        }

        public function getProfileUser(){
            $data = [];
            $data['page_title'] = "Profile";
            return view('admin/users/profile', $data);
        }
    }

?>