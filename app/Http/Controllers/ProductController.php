<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\Datatables\Datatables;
use App\Models\Product;
use App\Product\ProductAreaMapping;
use App\Supplier\AreaMapping;
use App\Supplier\Supplier;
use App\Product\Category\ProductCategory;
use App\Product\Category\ProductArea;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Auth;
class ProductController extends Controller
{
public function productList(){
return view('admin.extends.product.product_list');
}
public function vendor_product_api(){
$query = DB::table('product');
return DataTables::of($query)
->editColumn('IsShown', function ($inquiry) {
if ($inquiry->IsShown == 1) return 'Shown';
if ($inquiry->IsShown == 0) return 'Not Shown';
return 'Not selected';
})
->addColumn('action', function($data){
$button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->ProductID .'" data-original-title="Edit" class="edit btn btn-success btn-sm edit-post"><i class="far fa-edit"></i></a>';
$button .= '&nbsp;&nbsp;';
$button .= '<button name="delete" id="'.$data->ProductID .'" class="delete btn btn-danger confirmDelete" record="Area" recordid="{{$data->AreaID}}"><i class="fa fa-trash"></i></button>';
$button .= '&nbsp;&nbsp;';
return $button;
})
->rawColumns(['action'])
->toJson();
}
public function single_product_information($product_id){
	$vendor_product= DB::table('product')
->where('product.ProductID','=',$product_id )
->first();
return response()->json(['vendor_product'=>$vendor_product]);
}
public function addProduct(){
return view('admin.extends.product.add_product');
}
public function storeProduct(Request $request){
$request->validate([
'productName' => 'required|max:60',
'quantity' => 'required|max:20',
'minQty' => 'required|max:20',
'costPrice' => 'required|max:20',
'salePrice' => 'required|max:20',
'productImg' => 'required',
'shortDescription' => 'required|min:20',
'longDescription' => 'required|min:20',
]);
// dd($request->all());
$userId = Auth::user()->id;
$ImageName="";
if($request->hasFile('productImg')){
$ImageName = rand().'_'.$request->file('productImg')->getClientOriginalName();
}
$Path = './frontend_assets/upload_assets/images/product';
$request->file('productImg')->move($Path , $ImageName);
$Product  = new Product();
	$Product->UserID = $userId;
	$Product->ProductName = $request->productName;
	$Product->CostPrice = $request->costPrice;
	$Product->SalePrice = $request->salePrice;
	$Product->Qty = $request->quantity;
	$Product->ShortDescription = $request->shortDescription;
	$Product->LongDescription = $request->longDescription;
	$Product->IsShown = 0;
	$Product->Image =$ImageName;
	$Product->MinQty = $request->minQty;
	$Product->save();
$select_latest_product=DB::table('product')->latest()->first();
	return redirect()->back()->with('success','Product is successfully added!');;
}
public function productUpdate(Request $request){
		
$request->validate([
'UpdateProductName' => 'required|max:60',
'UpdateSalePrice' => 'required|max:20',
'UpdateQty' => 'required|max:20',
'UpdateCostPrice' => 'required|max:20',
]);


$select_product=DB::table('product')->where('ProductID','=',$request->ProductID)->first();
$ImageName=$select_product->Image;
$userId = Auth::user()->id;
if($request->hasFile('ProductImg')){
$ImageName = $request->file('ProductImg')->getClientOriginalName();
$Path = './frontend_assets/upload_assets/images/product/';
$request->file('ProductImg')->move($Path , $ImageName);
}
$productInfo= array(
'ProductName' =>  $request->UpdateProductName,
'CostPrice' =>  $request->UpdateCostPrice,
'SalePrice' =>  $request->UpdateSalePrice,
'Qty' =>  $request->UpdateQty,
'ShortDescription' =>  $request->ShortDescription,
'LongDescription' =>  $request->LongDescription,
'Image' => $ImageName,
"updated_at" => date('Y-m-d H:i:s'),
);
$UpdateProductID = $request->ProductID;
Product::where('ProductID', $UpdateProductID)->update($productInfo);
return response('Product Successfully updated');
}
public function productDescription($productId)
{
$Product = Product::where('ProductID','=',$productId)->get();
$User = Auth::user()->id;
$Supplier  = Supplier::where('UserID','=',$User)->get();
return view('vendor.product_description',compact('Product','Supplier'));
}


public function deleteProduct($ProductID)
{
$ID = Product::where('ProductID','=',$ProductID)->first();
$Path = './frontend_assets/upload_assets/images/product/';
$location=$Path.$ID->Image;
if (file_exists($location) && !is_dir($location))
{
unlink($Path.$ID->Image);
}

DB::table('product')
->where('ProductID','=',$ProductID)
->delete();

// log
$data = array('admin_id' =>Auth::user()->id,
'activity_name' => 'Product Deletion',
'activity_desctiption' => 'Product '.$ProductID.' Successfully deleted by vendor',
'admin_name' => Auth::user()->name,
'admin_email' => Auth::user()->email,
'created_at' => date('Y-m-d H:i:s'),
);
DB::table('admins_activity')->insert($data);
// end log
return response('product successfully deleted');
}
}