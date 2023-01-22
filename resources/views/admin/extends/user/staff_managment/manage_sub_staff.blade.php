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
              <li class="breadcrumb-item active">Sub Admin List</li>
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
                        <h5 class="fw-bold  font-weight-bold">Sub Admin Page Section</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="row ">
                            <div class="col-md-8 col-sm-12">
                            </div>
                            <div class="col-md-4 col-sm-12 text-center">
                                <button type="button" class="btn btn-info float-end  mx-auto" data-toggle="modal" data-target="#add-modal">
                                     Add Sub Admin
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-white m-0" id="staff_table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>User Type</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Created at</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('admin.extends.user.staff_managment.delete_confirmation')
    @include('admin.extends.user.staff_managment.update_model')
    @include('admin.extends.user.staff_managment.add_staff')
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
            $('#staff_table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{!! route('all_staff.list') !!}',
                columns: [
                    { data: 'id', name: 'accounts.id' },
                    { data: 'name', name: 'accounts.name' },
                    { data: 'role_name', name: 'role.name' },
                    { data: 'user_type', name: 'user_type' },
                    { data: 'email', name: 'accounts.email' },
                    { data: 'phone', name: 'accounts.phone' },
                    { data: 'status', name: 'accounts.status' },
                    { data: 'created_at', name: 'accounts.created_at' },
                    { data: 'action', name: 'action' },
                ],
                order: [
                    [0, 'desc']
                ],
            });
        });
        // start delete manufacturer------------------------
        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
// alert(dataId);
            $('#DeleteConfirmation-modal').modal('show');
        });
        $('#record-delete').click(function () {
            $.ajax({
                url: "delete_staff_api/" + dataId, //ajax execution to this url
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
                        var oTable = $('#staff_table').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    });
// alert('user successfully deleted');
// swal("User Successfully Deleted");
                    iziToast.success({ // izitoast warning
                        title: 'Staff  successfully deleted',
                        message: '{{ Session('
delete ')}}',
                        position: 'bottomRight'
                    });
                }
            })
        });
        // end delete manufacturer --------------------------------
        // start subcategory edit button update model
        $('body').on('click', '.edit-post', function () {
            var data_id = $(this).data('id');
// alert(data_id);
            $.get('single-staff-information/' + data_id, function (data) {
                $('#Update_admin_model_heading').html("Update Admin"); //this is title
                $('#update-user-btn').val("edit-post");
                $('#SubAdmin_submit_button').html("Update Admin");
                $('#edit-modal').modal('show');
//set the value of each id based on the data obtained from the ajax get request above
// alert(val(data.id));
                $('#id').val(data.id);
                $('#role_id').val(data.role_id);
                $('#status').val(data.status);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
                $('#address').val(data.address);
            })
        });
        // end subcategory edit button update model
    </script>
    <script>
        $(function () {
// $.validator.setDefaults({
//   submitHandler: function () {
//     alert( "Form successful submitted!" );
//   }
// });
            $('#add-stuff-form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    name: {
                        required:true
                    },
                    role_id: {
                        required:true
                    },
                    address: {
                        required:true
                    },
                    phone: {
                        required:true
                    },
                    status: {
                        required:true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    <script>
        $(function () {
// $.validator.setDefaults({
//   submitHandler: function () {
//     alert( "Form successful submitted!" );
//   }
// });
            $('#update-stuff-form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    name: {
                        required:true
                    },
                    role_id: {
                        required:true
                    },
                    address: {
                        required:true
                    },
                    phone: {
                        required:true
                    },
                    status: {
                        required:true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
