@extends('../template')
@section('title', $title)
@section('sub_title', $sub_title)
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
<style>
.widget-user .widget-user-header{
  height: 200px
}
</style>
<script>
function show_preview(folder, file, width){
  $('#preview_modal_name').html(file);
  $('#preview_modal_iframe').attr("src", '{{ asset('/') }}files/'+folder+'/'+file);
  $('#preview_modal_iframe').attr("width", width);
  $('#preview_modal').modal({ show: false });
  $('#preview_modal').modal('show');
}
</script>
<div class="col-12">
  <div class="card">
    <!--<h5 class="card-title p-3" style="padding-bottom: 0px!important;">{{$program->name}}</h5>-->
    <div class="card-body">
      <div class="row">
        <div class="col-12" style="line-height: 1;">
          <h4><b>{{$program->name}}</b></h4>
          <p>
            @if($program->image != null)
              <div class="float-left mr-3 rounded" style="background: url('{{ asset('/') }}images/program/{{$program->image}}')center center/cover;width: 300px;height: 200px;border: 3px solid #AAA"></div>
            @endif
            <?=$program->description?>
            Files :
            <?php
            $files = explode(',', $program->files);
            natcasesort($files);
            foreach($files as $file){
              $ext = pathinfo($file)['extension'];
              if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg')
                echo ' <a href="javascript:show_preview(\'program\', \''.$file.'\', null)">'.$file.'</a>';
              else if($ext == 'pdf')
                echo ' <a href="javascript:show_preview(\'program\', \''.$file.'\', \'100%\')">'.$file.'</a>';
              else
                echo ' <a href="'.asset('/').'files/program/'.$file.'".>'.$file.'</a>';
            }
            ?>
          </p>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-12" style="line-height: 1;">
          <h5>Topic</h5>
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Assignment</th>
                <th style="width:50px">Assign</th>
              </tr>
            </thead>
            <tbody>
              @foreach($program->topic as $row)
              <tr>
                <td>{{date('j M Y', strtotime($row->created_at))}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->assignment()->where(['user_id' => Session::get('id')])->count()}}</td>
                <td><a href="{{ url('/') }}/program/detail/assignment/{{$row->id}}/{{$request->session()->get('id')}}" class="btn btn-sm btn-primary">Assign</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="preview_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-name" id="preview_modal_name"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
          <embed src="" id="preview_modal_iframe" width="100%" height="400px"></embed>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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