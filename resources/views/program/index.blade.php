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
  if($('#'+mode+'_'+'name').val()==""){
    alert('Name is empty.');
    $('#'+mode+'_'+'name').focus();
    return false;
  }
  else if($('#'+mode+'_'+'description').val()==""){
    alert('Description is empty.');
    $('#'+mode+'_'+'description').focus();
    return false;
  }
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
    $('#edit_name').val(data_arr['name']);
    $('#edit_description').summernote('code', decodeURIComponent(data_arr['description']));
    if(data_arr['active'] == '1')
      $('#edit_active').prop('checked', true).change();
    else
      $('#edit_active').prop('checked', false).change();
    var var_dis = false;
    if(mode == 'edit'){
      var_dis = false;
      $('#edit_image').show();
      $('#edit_image_img').hide();
      $('#edit_files').show();
      $('#div_edit_files').hide();
      $('#edit_description').summernote('enable');
      $('#edit_modal_name').html('Edit {{ $title }}');
      $('#edit_modal_footer').show();
    }
    else{
      var_dis = true;
      $('#edit_image').hide();
      $('#edit_image_img').show();
      //$('#edit_image_img').prop('src', '{{ asset('/') }}images/program/'+data_arr['image']);
      $('#edit_image_img').css('background-image', 'url({{ asset('/') }}images/program/'+data_arr['image']+')');
      $('#edit_files').hide();
      $('#div_edit_files').show();
      $('#edit_description').summernote('disable');
      //$('#div_edit_files').prop('src', '{{ asset('/') }}files/program/'+data_arr['files']);
      $('#data_edit_files').html('');
      $.each(data_arr['files'].split(','), function(key, value){
        $('#data_edit_files').append('<a href="{{ asset('/') }}files/program/'+value+'" target="_blank">'+value+'</a>');
        //console.log(value);
      });
      //$('#data_edit_files').html('background-files', 'url({{ asset('/') }}files/program/'+data_arr['files']+')');
      $('#edit_modal_name').html('View {{ $title }}');
      $('#edit_modal_footer').hide();
    }
    $('#edit_id').prop('disabled', var_dis);
    $('#edit_name').prop('disabled', var_dis);
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
          <th>Name</th>
          <th>Status</th>
          <th style="width:80px"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($program as $row)
        <?php
        $active = "";
        if($row->active == "1")
          $active = "Active";
        else
          $active = "Inactive";
        ?>
          <tr>
              <td>{{ $row->id }}</td>
              <td>{{ $row->name }}</td>
              <td>{{ $active }}</td>
              <td>
                <button onclick="show_modal('view', {<?php
              echo "id : '".$row->id."',
              name : '".$row->name."',
              image : '".$row->image."',
              files : '".$row->files."',
              description : '".trim(rawurlencode($row->description), '"')."',
              active : '".$row->active."'";
              ?>})" class="btn bg-blue btn-circle btn-xs" title="View Data"><i class="fa fa-list"></i></button>
                <button onclick="show_modal('edit', {<?php
              echo "id : '".$row->id."',
              name : '".$row->name."',
              image : '".$row->image."',
              files : '".$row->files."',
              description : '".trim(rawurlencode($row->description), '"')."',
              active : '".$row->active."'";
              ?>})" class="btn bg-orange btn-circle btn-xs" title="Edit Data"><i class="fa fa-edit"></i></button>
                <a href="{{ url('/') }}/backend/program/delete/{{ $row->id }}" class="btn bg-maroon btn-circle btn-xs" title="Hapus Data" onclick="return confirm('Are you sure want to DELETE program {{ $row->name }}?')"><i class="fa fa-trash"></i></a>
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
    <form class="modal-content" name="add_frm" id="add_frm" method="post" enctype="multipart/form-data" name="frm" action="{{ url('/') }}/backend/program/add/post">
      {{ csrf_field() }}
      <div class="modal-header">
        <h4 class="modal-name" id="add_modal_name">Add {{ $title }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
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
            <label class="col-sm-4 col-form-label">Files</label>
            <div class="col-sm-8">
              <input type="file" class="form-control-file" name="data_files[]" id="add_files" multiple>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Description</label>
            <div class="col-sm-8">
                <textarea class="textarea" placeholder="Description" name="description" id="add_description"></textarea>
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
    <form class="modal-content" name="edit_frm" id="edit_frm" method="post" enctype="multipart/form-data" name="frm" action="{{ url('/') }}/backend/program/edit/post">
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
            <label class="col-sm-4 col-form-label">Files</label>
            <div class="col-sm-8">
              <input type="file" class="form-control-file" name="data_files[]" id="edit_files" multiple>
              <div class="data_files" style="display:none" id="div_edit_files">
                <p>
                  <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample">Detail</button>
                </p>
                <div class="collapse" id="collapseExample">
                  <div class="card card-body p-2 px-3" id="data_edit_files"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 col-form-label">Description</label>
            <div class="col-sm-8">
                <textarea class="textarea" placeholder="Description" name="description" id="edit_description"></textarea>
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
  $('.textarea').summernote({
                              toolbar: [
                                ['font', ['bold', 'underline']]
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