<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#f46f22;color:white">
				<h5 class="modal-title" id="exampleModalLabel">Add User</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<form method="post"  enctype="multipart/form-data" id="store_user">
				<div class="modal-body">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label"  >First Name</label>
								<input name="first_name"  type="text"   class="form-control" placeholder=" First Name " >
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
								<input name="last_name"  type="text"   class="form-control" placeholder=" Last Name " >
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
								<input name="email"  type="email"  class="form-control" placeholder=" Email  ">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label"  >Mobile</label>
								<input name="phone"  type="text"  class="form-control" placeholder="Mobile">
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label"  >User Type</label>
								<input name="user_type"  type="text"   class="form-control" placeholder="User Type">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label"  >Address</label>
								<input name="address"  type="text"   class="form-control" placeholder="Address">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label"  >Role</label>
								<input name="role_id"  type="text"   class="form-control" placeholder="Role">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-label"  >Password</label>
								<input name="password"  type="password"   class="form-control" placeholder="Password">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label class="form-label"  >Status</label>
							<select name="status"class="form-control"  placeholder="status">
							<option value="">Select Status</option>
							<option value="1">Approved</option>
							<option value="2">Pending</option>
							<option value="2">Reject</option>
						    </select>
							</div>
						</div>
						
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" style="background:#f46f22;color:white" id="store_user_submit_button" class="btn">Add User</button>
					
				</div>
			</form>
		</div>
	</div>
</div>