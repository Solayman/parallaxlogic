<!-- support section -->
<script src="{{ asset('assets/admin_asset') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/admin_asset') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
{{--  
        {!! Toastr::message() !!} --}}
@if($data)
<!-- css plugging start -->
@section('app_styles')

@if(in_array('summernote',$data))
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('assets/admin_asset/plugins/summernote/summernote-bs4.min.css')}}">
@endif
@if(in_array('dashboard_pluggin',$data))
<link rel="stylesheet" href="{{asset('assets/admin_asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('assets/admin_asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{asset('assets/admin_asset/plugins/jqvmap/jqvmap.min.css')}}">

<!-- Daterange picker -->
<link rel="stylesheet" href="{{asset('assets/admin_asset/plugins/daterangepicker/daterangepicker.css')}}">
@endif
@if(in_array('data_table',$data))
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" src="{{asset('assets/admin_asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" src="{{asset('assets/admin_asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" src="{{asset('assets/admin_asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
 <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@endif
@endsection
<!-- css pluggin end -->
<!-- js pluggins start -->
@section('app_scripts')
@if(in_array('summernote',$data))
<!-- Summernote -->
<script src="{{asset('assets/admin_asset/plugins/summernote/summernote-bs4.min.js')}}"></script>
@endif
@if(in_array('data_table',$data))
<!-- DataTables  & Plugins -->
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{asset('assets/admin_asset/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
jQuery.fn.dataTable.ext.errMode = function (settings, helpPage, message) {
console.log(message);
console.log(helpPage);
console.log(settings);
};
jQuery.extend(true, $.fn.dataTable.defaults, {
paging: true,
pageLength: 10,
processing: true,
serverSide: true,
bStateSave: true,
search: {
"regex": true
},
searching: {
"regex": true
},
lengthMenu: [
[5,10,25, 50, 100, -1],
[5,10,25, 50, 100, "All"]
],
language: {
paginate: {next: '&#62;', previous: '&#60;'},
emptyTable: "<i class='d-block my-4 fas fa-box-open' style='font-size: 120px'></i>",
processing: "<i class='fas fa-spinner fa-pulse' style='font-size: 80px'></i>",
},
oLanguage: {
sZeroRecords: "<i class='d-block my-4 fas fa-box-open' style='font-size: 120px'></i>"
},
});

</script>
@endif

@if(in_array('validation_jquery',$data))
<script src="{{ asset('assets/admin_asset') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="{{ asset('assets/admin_asset') }}/plugins/jquery-validation/additional-methods.min.js"></script>
@endif

@if(in_array('dashboard_pluggin',$data))
<!-- ChartJS -->
<!-- overlayScrollbars -->
<script src="{{asset('assets/admin_asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('assets/admin_asset/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('assets/admin_asset/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('assets/admin_asset/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/admin_asset/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('assets/admin_asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="{{asset('assets/admin_asset/dist/js/demo.js')}}"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/admin_asset/dist/js/pages/dashboard.js')}}"></script>
@endif
@endsection
<!-- js pluggin end -->
@endif
