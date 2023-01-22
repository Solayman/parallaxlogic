<!-- edit product model-->
<div class="modal fade" id="modalProductEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header text-center">
<h4 class="modal-title w-100 font-weight-bold">Edit Product</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body mx-6">
<form class="kt-form kt-form--label-right"  enctype="multipart/form-data" method="post" id="ProductUpdate"  name="edit_form">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" id="UpdateProductID" name="ProductID" class="form-control">
<div class="row">			
<div class="col-md-4">
<div class="form-group">
<label>Product Name
<span class="text-danger">*</span></label>
<input id="UpdateProductName" name="UpdateProductName" type="text" class="form-control" placeholder="Enter Product Name">
<span class="form-text  text-danger font-weight-bold" id="UpdateProductNameError"></span>
</div>

</div>


<div class="col-md-4">
<div class="form-group">
<label>Cost Price
<span class="text-danger">*</span></label>
<input oninput="calculatePrice()" id="UpdateCostPrice" name="UpdateCostPrice" type="number" class="form-control" placeholder="Product Cost Price">
<span class="form-text text-danger" id="UpdateCostPriceError"></span>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Sale Price
<span class="text-danger">*</span></label>
<input readonly id="UpdateSalePrice" name="UpdateSalePrice" type="number" class="form-control" placeholder="Product Sale Price">
<span class="form-text text-danger" id="UpdateSalePriceError"></span>
</div>
</div>
</div>
<div class="row">


<div class="col-md-6">
<div class="form-group">
											<label>Product Image
<span class="text-danger">*</span></label>
<input name="ProductImg" type="file"  class="form-control" placeholder="Product Image">
<span class="form-text text-muted" id="ProductImgError"></span>
</div>
											
</div>

<div class="col-md-6">
<div class="form-group">
<label>Product Quantity
<span class="text-danger">*</span></label>
<input id="UpdateQty" name="UpdateQty"  type="number" class="form-control" placeholder="Product Quantity">
<span class="form-text text-muted" id="UpdateQtyError"></span>
</div>
</div>
	<div class="col-md-12">
	<div class="form-group">
	<label>Product Short Description
	<span class="text-danger">*</span></label>
	<textarea class="form-control summernote" id="ShortDescription" name="ShortDescription"></textarea>
	<span class="form-text  text-danger font-weight-bold" >{{ $errors->first('shortDescription') }}</span>
	</div>
	</div>
	<div class="col-md-12">
	<div class="form-group">
	<label>Product Long Description
	<span class="text-danger">*</span></label>
	<textarea id="LongDescription" class="form-control summernote" name="LongDescription"></textarea>
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
</div>