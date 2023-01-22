
@extends('admin.admin_master')
@include('admin.include.support',['data'=>['data_table','validation_jquery']])
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header" style="background:#f46f22;color:white">
            <div class="row">
                <div class="col-md-12">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong class="text-white" style="color:white">{{ $message }}</strong>
                    </div>
                    @endif

                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="fw-bold   font-weight-bold">User Change Password Page Section</h5>
                </div>
                <div class="col-md-6">
                    <div class="row ">
                        <div class="col-md-9 col-sm-12">

                        </div>
                        <div class="col-md-3 col-sm-12 text-center">
                            <a href="{{ route('show.user') }}" class="btn btn-info float-end  mx-auto" >
                            User List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
     		<div class="row justify-content-center">
     			<div class="col-md-6">
     		<form method="post" action="{{url('admin/update-user-password')}}" enctype="multipart/form-data" id="update-password-form">
		@csrf
		<input type="hidden" name="id" value="{{$select_user_table->id}}" id="id">
				<div class="form-group">
			<label class="form-label"  for="">User Password <span class="text-danger"> : {{$select_user_table->first_name}}  {{$select_user_table->last_name}}</span></label>
			<input value="" type="password" name="password" id="password" class="form-control " placeholder="Enter Password" autocomplete="off">
			 <font style="color:red">{{($errors)->has('password')?($errors->first('password')):''}}</font>
		</div>
		
	
		<button type="Submit" class="btn btn-primary">Update User Password</button>
		<button type="reset" class="btn btn-danger">Reset</button>
	</form>
     			</div>
     		</div>
        </div>
    </div>


</div>

<script>
    $(function () {
  // $.validator.setDefaults({
  //   submitHandler: function () {
  //     alert( "Form successful submitted!" );
  //   }
  // });
  $('#update-password-form').validate({
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