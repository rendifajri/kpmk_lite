@extends('../template')
@section('title', $title)
@section('content_css')
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}vendor/bower_components/bootstrap-toggle/css/bootstrap-toggle.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/daterangepicker/daterangepicker.css">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/summernote/summernote-bs4.css">
@endsection
@section('content')
<script type="text/javascript">
function cekform(mode){
  if($('#'+mode+'_'+'facebook').val()==""){
    alert('Facebook Id is empty.');
    $('#'+mode+'_'+'facebook').focus();
    return false;
  }
  else if($('#'+mode+'_'+'instagram').val()==""){
    alert('Instagram is empty.');
    $('#'+mode+'_'+'instagram').focus();
    return false;
  }
  else if($('#'+mode+'_'+'youtube').val()==""){
    alert('Youtube is empty.');
    $('#'+mode+'_'+'youtube').focus();
    return false;
  }
  else if($('#'+mode+'_'+'whatsapp').val()==""){
    alert('Whatsapp is empty.');
    $('#'+mode+'_'+'whatsapp').focus();
    return false;
  }
  else if($('#'+mode+'_'+'email').val()==""){
    alert('Email is empty.');
    $('#'+mode+'_'+'email').focus();
    return false;
  }
  else {
    $('#'+mode+'_frm').submit();
  }
}
</script>
<div class="col-12">
  <div class="card">
    <!-- /.card-header -->
    <div class="card-body">
      @if (Session::get('message'))
      <div class="alert alert-error alert-block" style="padding: 5px">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ Session::get('message') }}</strong>
      </div>
      @endif
      <div class="col-6">
        <form class="form-horizontal" name="add_frm" id="add_frm" method="post" enctype="multipart/form-data" name="frm" action="{{ url('/') }}/backend/setting/add/post">
        {{ csrf_field() }}
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Facebook</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="facebook" id="add_facebook" placeholder="Facebook" value="{{ $setting ? $setting->facebook : '' }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Instagram</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="instagram" id="add_instagram" placeholder="Instagram" value="{{ $setting ? $setting->instagram : '' }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Youtube</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="youtube" id="add_youtube" placeholder="Youtube" value="{{ $setting ? $setting->youtube : '' }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Whatsapp</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="whatsapp" id="add_whatsapp" placeholder="Whatsapp" value="{{ $setting ? $setting->whatsapp : '' }}">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="email" id="add_email" placeholder="Email" value="{{ $setting ? $setting->email : '' }}">
            </div>
          </div>
          <div class="row">
            <div class="col-sm-8">
              <button type="button" class="btn btn-primary" onclick="cekform('add')">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('content_js')
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}vendor/bower_components/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/moment/moment.min.js"></script>
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/select2/js/select2.full.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!--<script src="{{ asset('/') }}assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{ asset('/') }}assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="{{ asset('/') }}assets/dist/js/adminlte.min.js"></script>
<script src="{{ asset('/') }}assets/dist/js/demo.js"></script>
<script src="{{ asset('/') }}assets/dist/js/chosen.jquery.js"></script>
<script src="{{ asset('/') }}assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="{{ asset('/') }}assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>-->
<script>
  $('.select2').select2();
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  });
  $('.textarea').summernote({
                              toolbar: [
                                ['para', ['ul']]
                              ]
                            });

  $(function () {
    $('#example1').DataTable({
      "order": [[ 0, "asc" ]]
    })
  })
  $('.datetimepicker-input').datetimepicker({
    format : "YYYY-MM-DD"
  });
</script>
@endsection