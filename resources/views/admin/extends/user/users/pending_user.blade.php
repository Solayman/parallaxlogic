@extends('admin.admin_master')
@include('admin.include.support',['data'=>['data_table','validation_jquery']])
@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Pending User List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<div class="container-fluid">
    <div class="card">
        <div class="card-header" style="background:#f46f22;color:white">
            <div class="row">
                <div class="col-md-12">
                    @if ($message = Session::get('warning'))
                    <div class="alert alert-success alert-block" mb-5>
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong class="text-danger">{{ $message }}</strong>
                    </div>
                    @endif

                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="fw-bold  font-weight-bold">Pending User Page Section</h5>
                </div>
                <div class="col-md-6">
                  {{--   <div class="row ">
                        <div class="col-md-9 col-sm-12">

                        </div>
                        <div class="col-md-3 col-sm-12 text-center">
                            <button type="button" class="btn btn-info float-end  mx-auto" data-toggle="modal" data-target="#add-modal">
                            Add Admin
                            </button>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-white m-0" id="user_pages_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>User Type</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>


</div>

@include('admin.extends.user.users.show-details-modal')
@include('admin.extends.user.users.update_model')
@include('admin.extends.user.users.delete_confirmation')
@endsection
@section('js')
<script>

$(document).ready(function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
});
$(function() {
$('#user_pages_table').DataTable({
processing: true,
serverSide: true,
responsive: true,
ajax: '{!! route('pending.users.list') !!}',
columns: [
{ data: 'id', name: 'id' },
{ data: 'first_name', name: 'first_name' },
{ data: 'user_type', name: 'user_type' },
{ data: 'email', name: 'email' },
{ data: 'phone', name: 'phone' },
{ data: 'status', name: 'status' },
{ data: 'created_at', name: 'created_at'},
{ data: 'action', name: 'action' },
],
order: [
[0, 'desc']
],
dom: 'Blfrtip',
buttons: [
'copy', 'csv', 'excel', 'pdf', 'print'
]
});
});
// show Data
$('body').on('click', '.show-details', function () {
var data_id = $(this).data('id');
// alert(data_id);
$.get('show-user-information/' + data_id, function (data) {
$('#Update_category_model_heading').html("Show payment Page");
$('#update-user-btn').val("show-details"); 
$('#show-details-modal').modal('show');
$('#id_view').html(data.user_info.id);
$('#name_view').html(data.user_info.first_name);
$('#lname_view').html(data.user_info.last_name);
$('#email_view').html(data.user_info.email);
$('#phone_view').html(data.user_info.phone);
$('#address_view').html(data.user_info.address);
$('#user_type_view').html(data.user_info.user_type);
$('#role_id_view').html(data.user_info.role_id);
$('#status_view').html(data.user_info.status);
$('#created_at_view').html(data.user_info.created_at);
$('#updated_at_view').html(data.user_info.updated_at);
})
});
// start delete team_member_table------------------------
$(document).on('click', '.delete', function () {
 data_id = $(this).attr('id');
// alert( data_id);
$('#DeleteConfirmation-modal').modal('show');
});
$('#record-delete').click(function () {
$.ajax({
url: "delete_user_api/" +  data_id, //ajax execution to this url
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
var oTable = $('#user_pages_table').dataTable();
oTable.fnDraw(false); //reset datatable
});
// alert('user successfully deleted');
// swal("User Successfully Deleted");
iziToast.success({ // izitoast warning
title: 'User successfully deleted',
message: '{{ Session('
delete ')}}',
position: 'bottomRight'
});
}
})
});
// delete end
// start contact us edit button update model
$('body').on('click', '.edit-post', function () {
var data_id = $(this).data('id');
// alert(data_id);
$.get('/admin/single-user-table-information/' + data_id, function (data) {
$('#Update_category_model_heading').html("Update user Page"); //this is title
$('#update-user-btn').val("edit-post");
$('#edit-modal').modal('show');
$('#id').val(data.id);
$('#first_name').val(data.first_name);
$('#last_name').val(data.last_name);
$('#email').val(data.email);
$('#phone').val(data.phone);
var address=JSON.parse(data.address);
$('#current_city').val(address.current_city);
$('#hometown').val(address.hometown);
$('#status').val(data.status);
$('#user_type').val(data.user_type);
$('#password').val(data.password);
})
});
// end subcategory edit button update model
// start update contact us  form
if ($("#update_user").length > 0) {
$("#update_user").validate({
       rules: {
first_name: "required",
last_name: "required",
phone: "required",
address: "required",
status: "required",
role_id: "required",
user_type: "required",


password: {
required: true,
minlength: 8
},
confirm_password: {
required: true,
minlength: 8,
equalTo: "#password"
},
email: {
required: true,
email: true
},

agree: "required"
},

messages: {
name: "Please enter user Name",
email: "Please enter user a valid email address",
phone: "Please enter user  mobile",
address: "Please enter user  address",
status: "Please select user status",
role_id: "Please enter user  role",
user_type: "Please select user user type",
password: {
required: "Please provide a password",
minlength: "Your password must be at least 8 characters long"
}
},

errorPlacement: function(label, element) {
label.addClass('mt-2 text-danger');
label.insertAfter(element);
},
highlight: function(element, errorClass) {
$(element).parent().addClass('has-danger')
$(element).addClass('form-control-danger')
},
submitHandler: function (form) {
var actionType = $('#user_update_submit_button').val();
$('#user_update_submit_button').html('Sending Request...');
$.ajax({
data: $('#update_user')
.serialize(), //functions that are used so that values on form-controls such as input, textarea, select etc. can be used in the URL query string when making ajax requests
url: "{{ route('user.update') }}", //save data url
type: "POST", //because save we use the POST method
dataType: 'json', //the data type we send is JSON
success: function (data) { //if it succeed
$('#update_user').trigger("reset"); //form reset
$('#edit-modal').modal('hide'); //modal hide
$('#user_update_submit_button').html('Update user Page');  //save button
var oTable = $('#user_pages_table').dataTable(); //initialization datatable
oTable.fnDraw(false); //reset datatable
iziToast.success({ //show iziToast with notification data successfully saved in the lower right position
title: 'User Successfully Updated',
message: '{{ Session('
success ')}}',
position: 'bottomRight'
});
function openToast(text, icon, bgColor) {
$.toast({
text: `<h6 class="my-2">${text}</h6>`,
icon: icon,
showHideTransition: "slide",
bgColor: bgColor,
textColor: "#eee",
hideAfter: 3000,
textAlign: "left",
position: "top-right",
});
}
// openToast("This is a success toast message", "success", "#269940");
},
error: function (data) { //if an error shows an error on the console
console.log('Error:', data);
$('#user_update_submit_button').html('Update user Page');
}
});
}
})
}
// store_contact us
if ($("#store_user").length > 0) {
$("#store_user").validate({
    rules: {
first_name: "required",
last_name: "required",
// phone: "required",
// address: "required",
status: "required",
role_id: "required",
user_type: "required",


password: {
required: true,
minlength: 8
},
confirm_password: {
required: true,
minlength: 8,
equalTo: "#password"
},
email: {
required: true,
email: true
},

agree: "required"
},

messages: {
name: "Please enter user Name",
email: "Please enter user a valid email address",
phone: "Please enter user  mobile",
address: "Please enter user  address",
status: "Please select user status",
role_id: "Please enter user  role",
user_type: "Please select user user type",
password: {
required: "Please provide a password",
minlength: "Your password must be at least 8 characters long"
}
},

errorPlacement: function(label, element) {
label.addClass('mt-2 text-danger');
label.insertAfter(element);
},
highlight: function(element, errorClass) {
$(element).parent().addClass('has-danger')
$(element).addClass('form-control-danger')
},
submitHandler: function (form) {
var actionType = $('#store_user_submit_button').val();
$('#store_user_submit_button').html('Sending Request...');
$.ajax({
data: $('#store_user')
.serialize(), //functions that are used so that values on form-controls such as input, textarea, select etc. can be used in the URL query string when making ajax requests
url: "{{ route('user.store') }}", //save data url
type: "POST", //because save we use the POST method
dataType: 'json', //the data type we send is JSON
success: function (data) { //if it succeed
$('#store_user').trigger("reset"); //form reset
$('#add-modal').modal('hide'); //modal hide
$('#store_user_submit_button').html('Store user');  //save button
var oTable = $('#user_pages_table').dataTable(); //initialization datatable
oTable.fnDraw(false); //reset datatable
iziToast.success({ //show iziToast with notification data successfully saved in the lower right position
title: 'user  Successfully Added',
message: '{{ Session('
success ')}}',
position: 'bottomRight'
});
},
error: function (data) { //if an error shows an error on the console
// console.log('Error:', data);
console.log(data.response.data.errors)
$('#headingError').text(data.dataJSON.errors.heading);
// alert(data.title);
// $('#titleError').text(data.errors.title);
// alert('Error:',data);
$('#store_user_submit_button').html('Store user ');
}
});
}
})
}
</script>
@endsection