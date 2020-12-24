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
  if($('#'+mode+'_'+'username').val()==""){
    alert('Username is empty.');
    $('#'+mode+'_'+'username').focus();
    return false;
  }
  else if($('#'+mode+'_'+'name').val()==""){
    alert('Name is empty.');
    $('#'+mode+'_'+'name').focus();
    return false;
  }
  else if($('#'+mode+'_'+'phone').val()==""){
    alert('Phone is empty.');
    $('#'+mode+'_'+'phone').focus();
    return false;
  }
  else if($('#'+mode+'_'+'email').val()==""){
    alert('Email is empty.');
    $('#'+mode+'_'+'email').focus();
    return false;
  }
  else if($('#'+mode+'_'+'password').val()!=$('#'+mode+'_'+'password_confirm').val()){
    alert('Password not match.');
    $('#'+mode+'_'+'password_confirm').focus();
    return false;
  }
  else {
    $('#'+mode+'_frm').submit();
  }
}
</script>
<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="card">
      <div class="card-body box-profile">
        <div class="text-center">
          <div class="profile-user-img img-fluid img-circle" style="background: url('{{ asset('/') }}images/user/{{$user->image}}')center center/cover;height: 100px;width: 100px"></div>
        </div>
        <h3 class="profile-username text-center">{{$user->name}}</h3>
        <p class="text-muted text-center">{{$user->type}}</p>
        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Username</b> <a class="float-right">{{$user->username}}</a>
          </li>
          <li class="list-group-item">
            <b>Avg Grade</b> <a class="float-right">{{$assignment->avg('grade')}}</a>
          </li>
        </ul>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <div class="col-md-9">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
          <li class="nav-item"><a class="nav-link" href="#assignment" data-toggle="tab">Assignment</a></li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="active tab-pane" id="activity">
            @if (Session::get('message'))
            <div class="alert alert-error alert-block" style="padding: 5px">
              <button type="button" class="close" data-dismiss="alert">×</button> 
              <strong>{{ Session::get('message') }}</strong>
            </div>
            @endif
            <div class="col-lg-8 col-md-10 col-sm-12">
              <form class="form-horizontal" name="add_frm" id="add_frm" method="post" enctype="multipart/form-data" name="frm" action="{{ url('/') }}/user/profile/post">
              <input type="hidden" name="id" id="add_id" value="{{ $user->id }}">
              {{ csrf_field() }}
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Username</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="username" id="add_username" placeholder="Username" value="{{ $user->username }}" <?= $user->id != Session::get('id') ? 'disabled':''?>>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" id="add_name" placeholder="Name" value="{{ $user->name }}" <?= $user->id != Session::get('id') ? 'disabled':'' ?>>
                  </div>
                </div>
                <div class="form-group row <?= $user->id != Session::get('id') ? 'd-none':'' ?>">
                  <label class="col-sm-4 col-form-label">Image</label>
                  <div class="col-sm-8">
                    <input type="file" class="form-control-file" accept="image/*" name="image" id="add_image" placeholder="Image">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Phone</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="phone" id="add_phone" placeholder="Phone" value="{{ $user->phone }}" <?= $user->id != Session::get('id') ? 'disabled':'' ?>>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Email</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="email" id="add_email" placeholder="Email" value="{{ $user->email }}" <?= $user->id != Session::get('id') ? 'disabled':'' ?>>
                  </div>
                </div>
                <div class="form-group row <?= $user->id != Session::get('id') ? 'd-none':'' ?>">
                  <label class="col-sm-4 col-form-label">Password</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" id="add_password" placeholder="Password">
                  </div>
                </div>
                <div class="form-group row <?= $user->id != Session::get('id') ? 'd-none':'' ?>">
                  <label class="col-sm-4 col-form-label">Password Confirm</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="password_confirm" id="add_password_confirm" placeholder="Password Confirm">
                  </div>
                </div>
                <div class="row <?= $user->id != Session::get('id') ? 'd-none':'' ?>">
                  <div class="col-sm-8">
                    <button type="button" class="btn btn-primary" onclick="cekform('add')">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="tab-pane" id="assignment">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Program</th>
                      <th>Topic</th>
                      <th>Grade</th>
                      <th style="width:20px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($assignment as $row)
                      <tr>
                          <td>{{ $row->topic->program->name }}</td>
                          <td>{{ $row->topic->name }}</td>
                          <td>{{ $row->grade }}</td>
                          <td class="text-right">
                            <a href="{{ url('/') }}/program/detail/assignment/{{$row->topic->id}}/{{$row->user->id}}" class="btn bg-green btn-circle btn-xs" title="See Assignment"><i class="fa fa-paper-plane"></i></a>
                          </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
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