<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use Hash;
use Toastr;
use App\Models\Account;
class StaffController extends Controller
{
	public function show_staff(){
$select_role=DB::table('roles')
->select('role_id','name')
->get();
// dd($select_role);
return view('admin.extends.user.staff_managment.manage_staff',compact('select_role'));
}
    public function show_sub_staff(){
        $select_role=DB::table('roles')
            ->select('role_id','name')
            ->get();
// dd($select_role);
        return view('admin.extends.user.staff_managment.manage_sub_staff',compact('select_role'));
    }
public function get_all_staff(){
	$query = DB::table('accounts')
	->leftjoin('roles','roles.role_id','=','accounts.role_id')
	->select('accounts.id','accounts.user_type','accounts.name','accounts.email','phone','accounts.address','status','accounts.created_at','roles.name as role_name')
   ->where('accounts.user_type','admin')
	;
	// $query = Account::all();

return DataTables::of($query)

->escapeColumns([])
->editColumn('status', function ($inquiry) {
if ($inquiry->status == 1) return '<span class="badge bg-success">Active</span>';
if ($inquiry->status == 2) return '<span class="badge bg-warning">Pending</span>';
if ($inquiry->status == 3) return '<span class="badge bg-danger">Inactive</span>';
return 'No selected';
})

->addColumn('action', function($data){
$button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="far fa-edit"></i></a>';
$button .= '&nbsp;&nbsp;';
$button .= '<button name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm confirmDelete" record="Area" recordid="{{$data->AreaID}}"><i class="fa fa-trash"></i></button>';
$button .= '&nbsp;&nbsp;';
$button.='<a href="' . route('change_staff.password', $data->id) .'">'.'<button class=" btn btn-sm btn-info "  ><i class="fas fa-lock"></i></button>'.'</a>';
return $button;
})
->rawColumns(['action'])
->toJson();
}

    public function sub_all_staff(){
        $query = DB::table('accounts')
            ->leftjoin('roles','roles.role_id','=','accounts.role_id')
             ->where('accounts.user_type','sub_admin')
            ->where('accounts.status',1)
            ->select('accounts.id','accounts.user_type','accounts.name','accounts.email','phone','accounts.address','status','accounts.created_at','roles.name as role_name')


        ;
        // $query = Account::all();

        return DataTables::of($query)

            ->escapeColumns([])
            ->editColumn('status', function ($inquiry) {
                if ($inquiry->status == 1) return '<span class="badge bg-success">Active</span>';
                if ($inquiry->status == 2) return '<span class="badge bg-warning">Pending</span>';
                if ($inquiry->status == 3) return '<span class="badge bg-danger">Inactive</span>';
                return 'No selected';
            })

            ->addColumn('action', function($data){
                $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="far fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm confirmDelete" record="Area" recordid="{{$data->AreaID}}"><i class="fa fa-trash"></i></button>';
                $button .= '&nbsp;&nbsp;';
                $button.='<a href="' . route('change_staff.password', $data->id) .'">'.'<button class=" btn btn-sm btn-info "  ><i class="fas fa-lock"></i></button>'.'</a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
public function delete_staff_api($id){

DB::table('accounts')
->where('id','=',$id)
->delete();
return 'Staff successfully deleted';
}
public function single_staff_info($id){
	$data=DB::table('accounts')
	->leftjoin('roles','roles.role_id','=','accounts.role_id')
	->where('accounts.id','=',$id)
	->select('accounts.id','accounts.name','accounts.email','accounts.phone','accounts.status','accounts.address','accounts.role_id')
	->first();
	return response()->json($data);
}
public function store_staff(Request $request){
	// dd($request->all());

	 $request->validate([
            'email' =>'required|unique:accounts',
            'name' =>'required',
            'address' =>'required',
            'role_id' =>'required',
            'status' =>'required',
            'phone' =>'required',
            'password' =>'required',

        ]);

	$select_user=DB::table('accounts')->where('email','=',$request->email)->first();
	if($select_user !=null){
		return redirect()->back()->with('warning','User Already registered. please contact developer');
	}

$staff_info = array('name' => $request->name,
'email' =>$request->email,
'password'=>Hash::make($request->password),
'user_type'=> $request->user_type,
'status' =>$request->status,
'address'=>$request->address,
'role_id' => $request->role_id,
'phone' => $request->phone,
'created_at' => Carbon::now(),
'updated_at' => Carbon::now(),
);
DB::table('accounts')
->insert($staff_info);
Alert::success('Staff Status', 'Staff Successfully Added');
return redirect('admin/staff');
}
public function update_staff(Request $request){
	// dd($request->all());
	 $request->validate([
            'email' =>'required',
            'name' =>'required',
            'address' =>'required',
            'role_id' =>'required',
            'status' =>'required',
            'phone' =>'required',
        ]);
$staff_info = array('name' => $request->name,
'email' =>$request->email,
'status' =>$request->status,
'user_type'=> $request->user_type,
'address'=>$request->address,
'role_id' => $request->role_id,
'ip_address' =>$request->ip(),
'updated_at' => Carbon::now(),
);
DB::table('accounts')
->where('id', $request->id)
->update($staff_info);
Alert::success('Staff Status', 'Staff Successfully updated');
return redirect('admin/staff');
}
public function change_staff_password($id){
	// return $id;
$select_staff_table=DB::table('accounts')
->where('id','=',$id)
->select('id','name')
->first();
return view('admin.extends.user.staff_managment.change_staff_password',compact('select_staff_table'));
}
public function update_staff_password  (Request $request){
$this->validate($request, [
'password' => ['required','min:6'],
]);
// dd($request->all());
$data = array('password' => Hash::make($request->password),
"updated_at" => date('Y-m-d H:i:s')
);
DB::table('accounts')
->where('id',  $request->id)
->update($data);
// Alert::success('Admin Status', 'Admin password Successfully Updated');
Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
return redirect('/admin/staff');

}


}
