@extends('admin.admin_master')
@include('admin.include.support',['data'=>['data_table','validation_jquery','summernote']])
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">× &nbsp;</button>
    <strong>{{ $message }}</strong>
</div>
@endif
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class=" product_table table table-bordered table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Cost Price</th>
                        <th>Sale Price</th>
                        <th>Min Quantity</th>
                        <th>Is Shown</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
            </table>
        </div>
        @include('admin.extends.product.vendor_product_update_modal')
    </div>
</div>
@include('admin.extends.product.delete_confirmation')
@endsection
@section('js')
<script>
$(document).ready(function() {
$('.summernote').summernote({
placeholder: 'type here',
height:300,
toolbar: [
[ 'style', [ 'style' ] ],
[ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
[ 'fontname', [ 'fontname' ] ],
[ 'fontsize', [ 'fontsize' ] ],
[ 'color', [ 'color' ] ],
[ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
[ 'table', [ 'table' ] ],
[ 'insert', [ 'link'] ],
[ 'view', [ 'undo', 'redo', 'fullscreen' ] ]
]
});
});
$(document).ready(function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
});
$(function() {
$('.product_table').DataTable({
processing: true,
serverSide: true,
responsive: true,
ajax: '{!! route('all_product.list') !!}',
columns: [
{ data: 'ProductID', name: 'product.ProductID ' },
{ data: 'ProductName', name: 'product.ProductName ' },
{ data: 'Qty', name: 'product.Qty' },
{data: 'Image', name: 'product.Image',
render: function( data, type, full, meta ) {
return "<img src=\"/frontend_assets/upload_assets/images/product/" + data + "\" height=\"40\" alt='No Image'/>";
}
},
{ data: 'CostPrice', name: 'product.CostPrice' },
{ data: 'SalePrice', name: 'product.SalePrice' },
{ data: 'MinQty', name: 'product.MinQty' },
{ data: 'IsShown', name: 'product.IsShown' },
{ data: 'created_at', name: 'product.created_at' },
{ data: 'updated_at', name: 'product.updated_at' },
{ data: 'action', name: 'action' },
],
order: [
[0, 'desc']
],
});
});
// start delete ------------------------
$(document).on('click', '.delete', function () {
dataId = $(this).attr('id');
// alert(dataId);
$('#DeleteConfirmation-modal').modal('show');
});
$('#record-delete').click(function () {
$.ajax({
url: "/admin/delete_product/" + dataId, //ajax execution to this url
type: 'delete',
data:{
_token:'{{ csrf_token() }}'
},
beforeSend: function () {
$('#record-delete').text('Clear Data'); //set text for the delete button
},
success: function (data) { //if successful
setTimeout(function () {
$('#DeleteConfirmation-modal').modal('hide'); //hide capital confirmation
var oTable = $('.product_table').dataTable();
oTable.fnDraw(false); //reset datatable
});
toastr.error('Product successfully deleted');
}
})
});
// end delete  --------------------------------
// start  edit button update model
$('body').on('click', '.edit-post', function () {
var data_id = $(this).data('id');
// alert(data_id);
$.get('/admin/single-product-information/' + data_id, function (data) {
$('#Update_category_model_heading').html("Update Sub Category"); //this is title
$('#modalProductEdit').modal('show');
$('#userId').val(data.vendor_product.VendorID);
$('#UpdateProductID').val(data.vendor_product.ProductID);
$('#UpdateProductName').val(data.vendor_product.ProductName);
$('#UpdateCostPrice').val(data.vendor_product.CostPrice);
$('#UpdateSalePrice').val(data.vendor_product.SalePrice);
$('#UpdateQty').val(data.vendor_product.Qty);
var ShortDescription = (data.vendor_product.ShortDescription);
$('#ShortDescription').summernote('code', ShortDescription);
var LongDescription = (data.vendor_product.LongDescription);
$('#LongDescription').summernote('code', LongDescription);
})
});
// start product update ajax
if ($("#ProductUpdate").length > 0) {
$("#ProductUpdate").validate({
submitHandler: function (form) {
var actionType = $('#vendor_product_update_modal_submit_button').val();
$('#vendor_product_update_modal_submit_button').html('Sending..');
var form = $('#ProductUpdate')[0];
var formData = new FormData(form);
event.preventDefault();
$.ajax({
url: "{{ route('product.update') }}", // the endpoint
type: "POST", // http method
processData: false,
contentType: false,
data: formData,
success: function (data) { //if it succeed
$('#ProductUpdate').trigger("reset"); //form reset
$('#modalProductEdit').modal('hide'); //modal hide
$('#vendor_product_update_modal_submit_button').html('Update blog post'); //save button
var oTable = $('.product_table').dataTable(); //initialization datatable
oTable.fnDraw(false); //reset datatable
toastr["success"]("Product Successfully Updated")
},
error: function (data) {
toastr.error('Validation failed');
// toastr["warning"]("Validation failed")
}
});
}
})
}
// end product update by ajax
// cost price calclution
function calculatePrice(){
let price = $("#UpdateCostPrice").val();
let sellPrice =parseFloat(price) + parseFloat(parseFloat(price * 10) / parseFloat(100));
$("#UpdateSalePrice").val(sellPrice);
}
</script>
@endsection