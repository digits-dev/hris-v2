<?php

namespace App\Http\Controllers\Authentication; 
use App\Helpers\CommonHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;

class LoginAuthController extends Controller
{
    public function index()
    {
        if(auth()->check()){
            return redirect()->intended('dashboard');
        }
        return view('authentication/login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $users = DB::table("users")->where("email", $credentials['email'])->first();
        $session_details = self::getOtherSessionDetails($users->id_ad_privileges);

        if(!$users->id_ad_privileges){
            $error = 'No privilege set, Please contact administrator!';
            return redirect('login')->withErrors(['no_priv' => $error]);
        }
        if($users->status == 0 || $users->status == 'INACTIVE'){
            $accDeact = "Account Doesn't Exist/Deactivated";
            Session::flush();
            return redirect('login')->withErrors(['acc_deact'=>$accDeact]);
        }
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Session::put('admin_id', $users->id);
            Session::put('admin_is_superadmin', $session_details['priv']->is_superadmin);
            Session::put("admin_privileges", $session_details['priv']->id);
            Session::put('admin_privileges_roles', $session_details['roles']);
            Session::put('theme_color', $session_details['priv']->theme_color);
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'mobile_number' => 'The provided credentials do not match our records',
            'password' => 'Incorrect email or password'
        ])->onlyInput(['mobile_number', 'password']);
    }

    public function getOtherSessionDetails($id){
        $data = [];
        $data['priv'] = DB::table("ad_privileges")->where("id", $id)->first();
        $data['roles'] = DB::table('ad_privileges_roles')->where('id_ad_privileges', $id)->join('ad_modules', 'ad_modules.id', '=', 'id_ad_modules')->select('ad_modules.name', 'ad_modules.path', 'is_visible', 'is_create', 'is_read', 'is_edit', 'is_delete')->get();
		return $data;
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

    public function endSession(Request $request){

        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
