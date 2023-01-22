<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#f46f22">
				<h5 class="modal-title" id="exampleModalLabel">Update Admin</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="{{url('admin/update-staff')}}" enctype="multipart/form-data" id="update-stuff-form">
					@csrf
			<div class="modal-body">

					<input type="hidden" name="id" id="id">

					<div class="row">
						<div class="form-group col-md-6 ">
						<label class="form-label"  for="simpleinput">Admin Name</label>
						<input name="name"  type="text" id="name" class="form-control" placeholder="Admin Name">
					</div>
					<div class="form-group col-md-6">
						<label class="form-label"  for="simpleinput">Admin Email</label>
						<input name="email"  type="email" id="email" class="form-control" placeholder="Admin Email">
					</div>
					<div class="form-group col-md-6">
						<label class="form-label"  for="simpleinput">Admin Phone</label>

						<input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
					</div>
                        <div class="form-group col-md-6">
                            <label class="form-label"  for="simpleinput">User Type</label>
                            <input type="text" name="user_type" id="user_type"  class="form-control" placeholder="User Type">
                        </div>

					<div class="form-group col-md-6">
						<label >Select Role</label>
						<select name="role_id" id="role_id" class="form-control form-control" >
							<option value="">Role...</option>
							@foreach($select_role as $select_role_info)
							<option value="{{$select_role_info->role_id}}">{{$select_role_info->name}}</option>
							@endforeach

						</select>
					</div>

					<div class="form-group col-md-6">
						<label >Select Status</label>
						<select name="status" id="status" class="form-control form-control" required>
							<option value="">Status...</option>
							<option value="1">Active</option>
							<option value="2">Pending</option>
							<option value="3">Inactive</option>

						</select>
					</div>
                        <div class="form-group col-md-12">
                            <label class="form-label"  for="simpleinput">Admin Address</label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                        </div>
					</div>



				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update  Admin</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
