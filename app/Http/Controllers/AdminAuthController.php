<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\CustomerVerifyModel;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Mail;
use DB;
use Validator;
// use App\Models\user\admin\Admin;
class AdminAuthController extends Controller
{
public function admin_login_page(){
if(Auth::check())
{
// echo 'working fine';
$super_admin = DB::table('accounts')->where('id', Auth::user()->id)
->first();
if($super_admin->user_type=='admin' && $super_admin->status==1){
return redirect('admin/dashboard');
}
else{
Auth::logout();
return redirect('login')->with('warning','Please Log In First');
}
}
Auth::logout();
return view('login_system.admin_auth.admin_login');
}
public function admin_login(Request $request){
$validated = $request->validate([
'email' => 'required|max:255',
'password' => 'required',
]);
$select_admin=DB::table('accounts')->where('email','=',$request->email)->first();
if($select_admin ==null){
return redirect('/login')->with('warning','We could not found your email');
}
elseif($select_admin->status==1 && $select_admin->user_type== 'admin'){
$credentials = array(
'email' => $request->input('email'),
'password' => $request->input('password'),
);
$remember = isset($input['remember']) ? $request->input('remember') : false;
if (Auth::attempt($credentials, $remember)) {

$request->session()->regenerate();
return redirect('/admin/dashboard');
}
else {
	// dd($request->all());
// dd("not authenticate");
return redirect('/login')->with('warning','Login Failed');
}
}
else {
// dd("not authenticate");
return redirect('/login')->with('warning','Your account have some issue. Please contact support');
}
}

public function admin_dashboard (){
return view('admin.extends.dashboard');
}
public function admin_logout()
{
Auth::logout();
return redirect('/login')->with('warning', 'You have successfully logged out');
}

 
}