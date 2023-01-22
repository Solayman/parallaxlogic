<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="show-details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background:#f46f22;color:white">
				<h5 class="modal-title" id="exampleModalLabel">User Details Information</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post"  enctype="multipart/form-data" id="update_expense">
				<div class="modal-body">
					<div class="table-responsive">
                    <table class="table table-white m-0 table-bordered table-sm" id="expense_pages_table">
                       			<tr>
                       				<th style="text-align:center;font-size:20px" colspan="4">User Details Information</th>
                       			</tr>
                              <tr>
                                <th width="25%">ID</th>
                                <td width="25%"><p id="id_view"></p></td>
                                <th width="25%">Name</th>
                                <td width="25%"><span id="name_view"> </span> <span id="lname_view"></span></td>
                            </tr>
                             <tr>
                                <th width="25%">Email</th>
                                <td width="25%"><p id="email_view"></p></td>
                                <th width="25%">Phone</th>
                                <td width="25%"><p id="phone_view"></p></td>
                            </tr>
                            <tr>
                                <th width="25%">User Type</th>
                                <td width="25%"><p id="user_type_view"></p></td>
                                <th width="25%">Role</th>
                                <td width="25%"><p id="role_id_view"></p></td>
                            </tr>
                            <tr>
                                <th width="25%">Address</th>
                                <td width="25%"><p id="address_view"></p></td>
                                <th width="25%">Status</th>
                                <td width="25%"><p id="status_view"></p></td>
                            </tr>
                            <tr>
                                <th width="25%">Created At</th>
                                <td width="25%"><p id="created_at_view"></p></td>
                                <th width="25%">Updated At</th>
                                <td width="25%"><p id="updated_at_view"></p></td>
                            </tr>
                    </table>
                </div>
					
				</div>
				
				<div class="modal-footer">
					<button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>
					
				</div>
				
				<!-- </div> -->
				
			</form>
		</div>
	</div>
</div>