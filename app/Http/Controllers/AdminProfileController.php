<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Toastr;
class AdminProfileController extends Controller
{
    public function view_profile(){
    $user = DB::table('accounts')->where('id', Auth::user()->id)
->first();
    return view('admin.extends.user.profile.view-profile',compact('user'));

   }
   public function edit(){
     $id = Auth::user()->id;
     $editdata = User::find($id);
     return view('backend.admin.profile.edit-profile',compact('editdata'));

   }
   public function update_profile(Request $request){

        $data =  Account::find(Auth::user()->id);

        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address= $request->address;
        if ($request->file('photo')){
          $file = $request->file('photo');
          @unlink(public_path('upload/adminimage/'.$data->photo));
          $filename =date('YmdHi').$file->getClientOriginalName();
          $file->move(public_path('upload/adminimage'), $filename);
          $data['photo'] = $filename;
        }
        $data->save();
        Toastr::success('helo');
      return back()->with('success','Profile Updated Successfully');

        }

        public function passwordview(){

        return view('admin.profile.edit-password');


        }

        public function change_password(Request $request){
            $this->validate($request,[
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required',
        ]);
          $id = Account::find(Auth::user()->id);
          $db_pass = Auth::user()->password;
          $old_pass = $request->old_password;
          $new_pass = $request->new_password;
          $confirm_pass = $request->confirm_password;

          if(Hash::check($old_pass, $db_pass)){
            if($new_pass === $confirm_pass){

                $data= Account::find(Auth::user()->id);
                $data->password = Hash::make($request->new_password);
                $data->save();

                Auth::logout();
                return redirect('/login')->with('success','Password Changed Successfully');
            }else{
               return redirect()->back()->with('error','New Password and Confirm Password Does Not Match!');
            }

          }else{

            return redirect()->back()->with('error','Your Current Password Does Not Match!');
          }
}
}
