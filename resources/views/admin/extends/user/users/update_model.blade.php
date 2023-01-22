<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#f46f22;color:white">
				<h5 class="modal-title" id="exampleModalLabel">Update User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post"  enctype="multipart/form-data" id="update_user">
				<div class="modal-body">
					
					@csrf
					<input type="hidden" name="id"  id="id">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label"  >First Name</label>
								<input name="first_name"  type="text" id="first_name"  class="form-control" placeholder=" First Name " >
								{{-- @error('Heading') is-invalid @enderror
								@error('Heading')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror --}}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label"  >Last Name</label>
								<input name="last_name"  type="text" id="last_name"  class="form-control" placeholder=" Last Name " >
								{{-- @error('Heading') is-invalid @enderror
								@error('Heading')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror --}}
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label"  >Email</label>
								<input name="email"  type="email" id="email" class="form-control" placeholder=" Email  ">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label"  >Mobile</label>
								<input name="phone"  type="text" id="phone" class="form-control" placeholder="Mobile">
							</div>
						</div>
						
					
						
						<div class="col-md-12">
							<div class="form-group">
							<label class="form-label"  >Status</label>
							<select name="status"class="form-control" id="status" placeholder="status">
							<option value="">Select Status</option>
							<option value="1">Approved</option>
							<option value="2">Pending</option>
							<option value="3">Banned</option>
						    </select>
							</div>
						</div>
						<!--<div class="col-md-6">-->
						<!--	<div class="form-group">-->
						<!--		<label class="form-label"  >Current City</label>-->
						<!--		<input name="current_city"  type="text" id="current_city"  class="form-control" placeholder="Current City address" required>-->
						<!--	</div>-->

							
						<!--</div>-->
						<!--<div class="col-md-12">-->
						<!--	<div class="form-group">-->
						<!--		<label class="form-label"  >Hometown address</label>-->
						<!--		<input name="hometown"  type="text" id="hometown"  class="form-control" placeholder="Hometown address" required>-->
						<!--	</div>-->
						<!--</div>-->
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" style="background:#f46f22;color:white" id="user_update_submit_button" class="btn ">Update User </button>
					
				</div>
				
				<!-- </div> -->
				
			</form>
		</div>
	</div>
</div>