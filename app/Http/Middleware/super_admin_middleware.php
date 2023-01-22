<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class super_admin_middleware
{
public function handle(Request $request, Closure $next)
{


if(Auth::check())
{


$super_admin = DB::table('accounts')->where('id', Auth::user()->id)
->first();
if($super_admin->user_type=='admin'){
		return $next($request);
if($super_admin->status==1){
	return $next($request);
}
elseif($super_admin->status==2){
Auth::logout();
return redirect('/login')->with('warning','your account is not approve yet. please contact with administrator');
}
elseif($super_admin->status==3){
Auth::logout();
return redirect('/login')->with('warning','Your account has a major critical issue. Please contact the administrator');
}
}
else{
Auth::logout();
return redirect('/login')->with('warning','Invalid Attempt. please contact support');
}
}
else{
Auth::logout();
return redirect('/login')->with('warning','please log in first');
}
}
}