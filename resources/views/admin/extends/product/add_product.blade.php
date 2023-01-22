@extends('admin.admin_master')
@include('admin.include.support',['data'=>['data_table','validation_jquery','summernote']])
@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">× &nbsp;</button>
    <strong>{{ $message }}</strong>
</div>
@endif

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
<div class="kt-portlet__body">
    <form class="kt-form kt-form--label-right"  id="ProductSubmit" method="post"
        enctype="multipart/form-data" action="add_product">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Product Name
                        <span class="text-danger">*</span></label>
                        <input required="" type="text" class="form-control" placeholder="Product Name" name="productName">
                        <span class="form-text  text-danger font-weight-bold" >{{ $errors->first('productName') }}</span>
                    </div>
                </div>
                   <div class="col-md-4">
    <div class="form-group">
        <label>Product Quantity
            <span class="text-danger">*</span></label>
            <input type="number" value="1" class="form-control" placeholder="Quantity"
            name="quantity">
            <span class="form-text  text-danger font-weight-bold" >{{ $errors->first('Quantity') }}</span>
        </div>
    </div>
 <div class="col-md-4">
        <div class="form-group">
            <label>Min Product Quantity
                <span class="text-danger">*</span></label>
                <input required type="number" value="1"  class="form-control" placeholder="Minimum Qty"
                name="minQty">
                <span class="form-text  text-danger font-weight-bold" >{{ $errors->first('minQty') }}</span>
            </div>
        </div>
            </div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Cost Price
                <span class="text-danger">*</span></label>
                <input required type="text" class="form-control" placeholder="Cost Price" name="costPrice" id="CostPrice">
              <span class="form-text  text-danger font-weight-bold" >{{ $errors->first('costPrice') }}</span>
            </div>
            
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Sale Price
                    <span class="text-danger">*</span></label>
                    <input required type="text" class="form-control" placeholder="Sale Price" name="salePrice" id="SalePrice">
                    <span class="form-text  text-danger font-weight-bold" >{{ $errors->first('salePrice') }}</span>
                </div>
                
            </div>

    <div class="col-md-4">
        <div class="form-group">
            <label>Product Image
                <span class="text-danger">*</span></label>
                <input required type="file" class="form-control" name="productImg" placeholder="Product Image">
               <span class="form-text  text-danger font-weight-bold" >{{ $errors->first('productImg') }}</span>
            </div>
            
        </div>
        

        <div class="col-md-12">
            <div class="form-group">
                <label>Product Short Description
                    <span class="text-danger">*</span></label>
                    <textarea class="form-control summernote" name="shortDescription"></textarea>
                    <span class="form-text  text-danger font-weight-bold" >{{ $errors->first('shortDescription') }}</span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Product Long Description
                        <span class="text-danger">*</span></label>
                        <textarea class="form-control summernote" name="longDescription"></textarea>
                         <span class="form-text  text-danger font-weight-bold" >{{ $errors->first('longDescription') }}</span>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="submit" id="vendor_product_update_modal_submit_button" class="btn btn-primary font-weight-bold">Save changes</button>
            </div>
        </form>
    </div>
</div>
</div>
<script>
$(document).ready(function(e) {
var SupplierID = $('#supplierID').val();
$.get('/Supplier/Percentage/' + SupplierID, function(data) {
$('#referencePercentage').val(data);
console.log(data);
});
$('#referencePercentage').on('keyup', function(e) {
var Cost = parseFloat($('#CostPrice').val(), 2);
var Reference = $('#referencePercentage').val();
Reference = parseFloat(Reference, 2);
var Extra = (Reference / 100) * Cost;
var Sale = Cost + Extra;
$('#SalePrice').val(Sale);
});
$('#CostPrice').on('keyup', function(e) {
var Cost = parseFloat($('#CostPrice').val(), 2);
var Reference = $('#referencePercentage').val();
Reference = parseFloat(Reference, 2);
var Extra = (Reference / 100) * Cost;
var Sale = Cost + Extra;
$('#SalePrice').val(Sale);
});
});
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
</script>
                                        @endsection