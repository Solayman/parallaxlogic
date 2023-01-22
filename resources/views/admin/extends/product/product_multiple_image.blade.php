@extends('layouts.adminvendor')
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
				Product </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<!--<a href="" class="kt-subheader__breadcrumbs-link">-->
					<!--	Crud </a>-->
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<!--<a href="" class="kt-subheader__breadcrumbs-link">-->
					<!--	Forms & Controls </a>-->
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<!--<a href="" class="kt-subheader__breadcrumbs-link">-->
					<!--	Form Controls </a>-->
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="" class="kt-subheader__breadcrumbs-link">
					Select Related Products </a>
					<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
				</div>
			</div>
			
		</div>
	</div>
	<!-- end:: Subheader -->
	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="row">
			<!--<div class="col-md-10 offset-md-1">-->
			
			<div class="col-md-12">
				
				
				
				<div class="kt-portlet">
					
					
					
					
					<div class="kt-portlet__body">
						<form class="kt-form kt-form--label-right"  enctype="multipart/form-data" method="post" action="{{url('/vendor/Product/MultipleImage/Done')}}">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							
							<div class="form-group ">
								<div class="row">
									<div class="col-md-6">
										
										<select required="" class="form-control js-example-basic-single" id="PrimaryProduct"  name="CategoryName">
											<option value="0" >Select A Product</option>
											@foreach($List as $data)
											
											<option value="{{$data->ProductID}}">{{$data->ProductName}}</option>
											@endforeach
										</select>
										
									</div>
									
								</div>
								
							</div>
							<div class="form-group ">
								<div class="row">
									<div class="col-md-6">
										<div id="PrImg">
											<input type="file" name="ProductImg" class="form-control" id="ProductImg">
										</div>
									</div>
									<div class="col-md-2">
										<input class="btn btn-danger form-control" type="submit" value="Add Image">
									</div>
									<div class="col-md-4" id="ProductImageRowforImage">
										<img id="UserImgPlace" width="100" height="100">
									</div>
								</div>
							</div>
						</form>
						<!--end::Form-->
					</div>
				</div>
				<div class="kt-portlet">
					<div class="kt-portlet__body">
						<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
							<thead>
								<tr>
									<th>ID</th>
									<th>Image</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="RelationBody">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- end:: Content -->
	</div>
	<script>
function ShowImages(ProductID)
{
$.get('/vendor/Product/Images/Show/'+ProductID,function(data)
{
var Lister = JSON.parse(data.List);
var Total = Lister.length;

$('#RelationBody').empty();

for(i=0;i<Total;i++)
{

$('#RelationBody').append('<tr><input type="hidden" name="RelationID2[]" value="'+Lister[i].ProductImageMapping+'"><td>'+Lister[i].ProductID+'</td><td>  <img class="d-block w-30" src="/frontend_assets/upload_assets/images/product/multipleImage/'+Lister[i].Image+'" width="50" height="50" alt="Second slide"></td><td><button class="btn btn-danger RelationDelete" name="RelationDelete[]"><i class="fa fa-times fa-3x"></i></button></td>	</tr>');

}
		
$('.RelationDelete').on('click',function(e)
{
e.preventDefault();
var Index=$('[name="RelationDelete[]"]').index(this);
var SecID = $('input[name="RelationID2[]"]').eq(Index).val();
var PrimaryID = $('#PrimaryProduct').val();
$.get('/vendor/Product/Images/Delete/'+PrimaryID+'/'+SecID,function(data)
{
location.reload(true);
});
});
});
}
$(document).ready(function(e)
{

function readURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function (e) {
$('#UserImgPlace').attr('src', e.target.result);
}
reader.readAsDataURL(input.files[0]);
}
}
$("#ProductImg").change(function(){
readURL(this);
});
$('#PrimaryProduct').on('change',function(e)
{
var ProductIDD = $('#PrimaryProduct').val();
ShowImages(ProductIDD);
});
});
	</script>
	@endsection