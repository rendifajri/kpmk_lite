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
@endsection
@section('content')
<script type="text/javascript">
function cekform(mode){
  /*if($('#'+mode+'_'+'type').val()==""){
    alert('Type is empty.');
    $('#'+mode+'_'+'type').focus();
    return false;
  }*/
  /*if($('#'+mode+'_'+'username').val()==""){
    alert('Username is empty.');
    $('#'+mode+'_'+'username').focus();
    return false;
  }
  else if($('#'+mode+'_'+'password').val()=="" && mode=="add"){
    alert('Password is empty.');
    $('#'+mode+'_'+'password').focus();
    return false;
  }
  else if($('#'+mode+'_'+'password').val()!=$('#'+mode+'_'+'password_confirm').val()){
    alert('Password not match.');
    $('#'+mode+'_'+'password_confirm').focus();
    return false;
  }
  else */if($('#'+mode+'_'+'name').val()==""){
    alert('Name is empty.');
    $('#'+mode+'_'+'name').focus();
    return false;
  }
  /*else if($('#'+mode+'_'+'image').val()=="" && mode=="add"){
    alert('Image is empty.');
    $('#'+mode+'_'+'image').focus();
    return false;
  }
  else if($('#'+mode+'_'+'email').val()==""){
    alert('Email is empty.');
    $('#'+mode+'_'+'email').focus();
    return false;
  }
  else if($('#'+mode+'_'+'phone').val()==""){
    alert('Phone is empty.');
    $('#'+mode+'_'+'phone').focus();
    return false;
  }*/
  else {
    $('#'+mode+'_frm').submit();
  }
}
function show_modal(mode, data_arr) {
  if(mode == 'add'){
    $('#add_modal').modal({ show: false });
    $('#add_modal').modal('show');
  }
  else{
    $('#edit_modal').modal({ show: false });
    $('#edit_id').val(data_arr['id']);
    //$('#edit_type').val(data_arr['type']);
    //$('#edit_type').trigger('change');
    $('#edit_username').val(data_arr['username']);
    $('#edit_name').val(data_arr['name']);
    $('#edit_email').val(data_arr['email']);
    $('#edit_phone').val(data_arr['phone']);
    if(data_arr['active'] == '1')
      $('#edit_active').prop('checked', true).change();
    else
      $('#edit_active').prop('checked', false).change();
    var var_dis = false;
    if(mode == 'edit'){
      var_dis = false;
      $('#edit_image').show();
      $('#edit_image_img').hide();
      $('#edit_modal_name').html('Edit {{ $title }}');
      $('#edit_modal_footer').show();
    }
    else{
      var_dis = true;
      $('#edit_image').hide();
      $('#edit_image_img').show();
      //$('#edit_image_img').prop('src', '{{ asset('/') }}images/user/'+data_arr['image']);
      $('#edit_image_img').css('background-image', 'url({{ asset('/') }}images/user/'+data_arr['image']+')');
      $('#edit_modal_name').html('View {{ $title }}');
      $('#edit_modal_footer').hide();
    }
    $('#edit_id').prop('disabled', var_dis);
    //$('#edit_type').prop('disabled', var_dis);
    $('#edit_username').prop('disabled', var_dis);
    $('#edit_password').prop('disabled', var_dis);
    $('#edit_password_confirm').prop('disabled', var_dis);
    $('#edit_name').prop('disabled', var_dis);
    $('#edit_email').prop('disabled', var_dis);
    $('#edit_phone').prop('disabled', var_dis);
    $('#edit_active').prop('disabled', var_dis);
    $('#edit_modal').modal('show');
  }
}
</script>
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <p class="card-name">
        <button type="button" class="btn btn-primary" class="btn btn-primary" onclick="show_modal('add', null)">Add</button>
      </p>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      @if (Session::get('message'))
      <div class="alert alert-error alert-block" style="padding: 5px">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ Session::get('message') }}</strong>
      </div>
      @endif
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Name</th>
          <th>Temp Pass</th>
          <th>Phone</th>
          <th>Status</th>
          <th style="width:80px"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($user as $row)
        <?php
        $active = "";
        if($row->active == "1")
          $active = "Active";
        else
          $active = "Inactive";
        ?>
          <tr>
              <td>{{ $row->id }}</td>
              <td>{{ $row->username }}</td>
              <td>{{ $row->name }}</td>
              <td>{{ $row->temp_password }}</td>
              <td>{{ $row->phone }}</td>
              <td>{{ $active }}</td>
              <td class="text-right">
                <a href="{{ url('/') }}/backend/user/reset_password/{{ $row->id }}" target="_blank" class="btn bg-green btn-circle btn-xs" title="Reset Password" onclick="return confirm('Are you sure want to RESET {{ $row->name }} password?')"><i class="fa fa-lock"></i></a>
                <a href="{{ url('/') }}/user/profile/{{ $row->id }}"  class="btn bg-blue btn-circle btn-xs" title="View Profile"><i class="fa fa-list"></i></a>
                <button onclick="show_modal('edit', {<?php
              echo "id : '".$row->id."',
              type : '".$row->type."',
              username : '".$row->username."',
              name : '".$row->name."',
              image : '".$row->image."',
              email : '".$row->email."',
              phone : '".$row->phone."',
              active : '".$row->active."'";
              ?>})" class="btn bg-orange btn-circle btn-xs" title="Edit Data"><i class="fa fa-edit"></i></button>
                <a href="{{ url('/') }}/backend/user/delete/{{ $row->id }}" class="btn bg-maroon btn-circle btn-xs" title="Hapus Data" onclick="return confirm('Are you sure want to DELETE user {{ $row->name }}?')"><i class="fa fa-trash"></i></a>
              </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="modal fade" id="add_modal">
  <div class="modal-dialog modal-lg">
    <form class="modal-content" name="add_frm" id="add_frm" method="post" enctype="multipart/form-data" name="frm" action="{{ url('/') }}/backend/user/add/post">
      {{ csrf_field() }}
      <div class="modal-header">
        <h4 class="modal-name" id="add_modal_name">Add {{ $title }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
          <!--<div class="form-group row">
            <label class="col-sm-4 col-form-label">Type</label>
            <div class="col-sm-8">
              <select class="form-control select2bs4" name="type" id="add_type" data-placeholder="Pilih Type..." style="width: 100%;">
                <option value=""></option>
                <option value="Administrator">Administrator</option>
                <option value="User">User</option>
              </select>
            </div>
          </div>-->
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Username</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="username" id="add_username" placeholder="Username">
            </div>
          </div>
          <!--<div class="form-group row">
            <label class="col-sm-4 col-form-label">Password</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" name="password" id="add_password" placeholder="Password">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Password Confirm</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" name="password_confirm" id="add_password_confirm" placeholder="Password Confirm">
            </div>
          </div>-->
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="name" id="add_name" placeholder="Name">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Image</label>
            <div class="col-sm-8">
              <input type="file" class="form-control-file" accept="image/*" name="image" id="add_image">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
              <input type="text" class="form-control form_number" name="email" id="add_email" placeholder="Email">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Phone</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="phone" id="add_phone" placeholder="Phone">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Status</label>
            <div class="col-sm-8">
              <input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-width="100" name="active" id="add_active" checked >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="cekform('add')">Save</button>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="edit_modal">
  <div class="modal-dialog modal-lg">
    <form class="modal-content" name="edit_frm" id="edit_frm" method="post" enctype="multipart/form-data" name="frm" action="{{ url('/') }}/backend/user/edit/post">
      <input type="hidden" name="id" id="edit_id" value="">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <div class="modal-header">
        <h4 class="modal-name" id="edit_modal_name">Edit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
          <!--<div class="form-group row">
            <label class="col-sm-4 col-form-label">Type</label>
            <div class="col-sm-8">
              <select class="form-control select2bs4" name="type" id="edit_type" data-placeholder="Pilih Type..." style="width: 100%;">
                <option value=""></option>
                <option value="Administrator">Administrator</option>
                <option value="User">User</option>
              </select>
            </div>
          </div>-->
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Username</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="username" id="edit_username" placeholder="Username">
            </div>
          </div>
          <!--<div class="form-group row">
            <label class="col-sm-4 col-form-label">Password</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" name="password" id="edit_password" placeholder="Password">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Password Confirm</label>
            <div class="col-sm-8">
              <input type="password" class="form-control" name="password_confirm" id="edit_password_confirm" placeholder="Password Confirm">
            </div>
          </div>-->
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="name" id="edit_name" placeholder="Name">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Image</label>
            <div class="col-sm-8">
              <input type="file" class="form-control-file" accept="image/*" name="image" id="edit_image">
              <div class="data_image" style="display:none" id="edit_image_img"></div>
              <!--<img style="width: 185px;height: 215px" src="" style="display:none" id="edit_image_img" />-->
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="email" id="edit_email" placeholder="Email">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Phone</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="phone" id="edit_phone" placeholder="Phone">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Status</label>
            <div class="col-sm-8">
              <input type="checkbox" data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-width="100" name="active" id="edit_active" checked >
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" id="edit_modal_footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="cekform('edit')">Save</button>
      </div>
    </form>
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