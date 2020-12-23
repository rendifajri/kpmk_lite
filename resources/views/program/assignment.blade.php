@extends('../template')
@section('title', $title)
@section('sub_title', $sub_title)
@section('sub_sub_title', $sub_sub_title)
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
.fa_numb{
  font-size: 18px!important;
  font-family: 'Source Sans Pro';
}
.form-group{
  margin-bottom: 0.5rem;
}
.form-group p{
  margin-bottom: 0rem;
}
</style>
<script type="text/javascript">
function cekform(mode){
  if(document.getElementById(mode+'_'+'files').files.length==0){
    alert('Files is empty.');
    $('.'+mode+'_'+'files').focus();
    return false;
  }
  else if($('#'+mode+'_'+'comment').val()==""){
    alert('Comment is empty.');
    $('#'+mode+'_'+'comment').focus();
    return false;
  }
  else {
    //$('#'+mode+'_frm').submit();
  }
}
function cekuserform(mode, div_id){
  if($('#'+mode+'_'+div_id+'_comment').val()==""){
    alert('Comment is empty.');
    $('#'+mode+'_'+div_id+'_comment').focus();
    return false;
  }
  else {
    $('#'+mode+'_'+div_id+'_frm').submit();
  }
}
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
    <!--<h5 class="card-title p-3" style="padding-bottom: 0px!important;">{{$topic->name}}</h5>-->
    <div class="card-body">
      <div class="row">
        <div class="col-12" style="line-height: 1;">
          <h4><b>{{$topic->program()->first()->name}} - {{$topic->name}}</b></h4>
          <p>
            <!--if($topic->image != null)
              <div class="float-left mr-3 rounded" style="background: url('{{ asset('/') }}images/program/{{$topic->image}}')center center/cover;width: 300px;height: 200px;border: 3px solid #AAA"></div>
            endif-->
            <?=$topic->description?>
            Files :
            <?php
            $files = explode(',', $topic->files);
            natcasesort($files);
            foreach($files as $file){
              $ext = pathinfo($file)['extension'];
              if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg')
                echo ' <a href="javascript:show_preview(\'topic\', \''.$file.'\', null)">'.$file.'</a>';
              else if($ext == 'pdf')
                echo ' <a href="javascript:show_preview(\'topic\', \''.$file.'\', \'100%\')">'.$file.'</a>';
              else
                echo ' <a href="'.asset('/').'files/topic/'.$file.'".>'.$file.'</a>';
            }
            ?>
          </p>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-12">
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-12 pb-1">
  <div class="timeline">
    <?php
    $i = 0;
    $id_link = $i == 0 ? 'inisial' : 'r'.$i;
    ?>
    @foreach($topic->assignment()->where(['user_id' => $user_id])->get() as $row)
      <!--<div class="time-label">
        <span class="bg-red">10 Feb. 2014</span>
      </div>-->
      <div id="{{$id_link}}">
        @if($i == 0)
        <i class="fa fa-info bg-primary mt-1"></i>
        @else
        <i class="fa fa_numb bg-primary mt-1">{{ucfirst($id_link)}}</i>
        @endif
        <form class="timeline-item" name="add_<?=$id_link?>_frm" id="add_<?=$id_link?>_frm" method="post" enctype="multipart/form-data" action="{{ url('/') }}/assignment/comment/add/post">
          {{ csrf_field() }}
          <input type="hidden" name="topic_id" id="add_topic_id" value="{{$topic->id}}">
          <input type="hidden" name="user_id" id="add_user_id" value="{{$row->user->id}}">
          <input type="hidden" name="div_id" id="add_div_id" value="{{$id_link}}">
          <input type="hidden" name="assignment_id" id="add_assignment_id" value="{{$row->id}}">
          <span class="time"><i class="fas fa-clock"></i> {{date('j M Y H:i:s', strtotime($row->created_at))}}</span>
          <h3 class="timeline-header">
            @if($i == 0)
            <a href="#{{$id_link}}">Inisial Assignment</a>
            @else
            <a href="#{{$id_link}}">Revisi {{$i}}</a>
            @endif
            @if($request->session()->get('type') == 'Administrator')
              @if($row->locked == 1)
                <a href="{{ url('/') }}/backend/assignment/lock/{{$row->id}}/0/{{$id_link}}" title="Locked. Click to unlock"><i class="fa fa-unlock bg-primary p-1 rounded-circle" style="font-size: 12px"></i></a>
              @else
                <a href="{{ url('/') }}/backend/assignment/lock/{{$row->id}}/1/{{$id_link}}" title="Unlocked. Click to lock"><i class="fa fa-lock bg-primary p-1 rounded-circle" style="font-size: 12px"></i></a>
              @endif
            @endif
          </h3>
          <div class="timeline-body">
            <div class="form-horizontal px-3">
              <div class="form-group row">
                <label class="col-lg-1 col-md-2 col-sm-2 col-3 col-form-label">Files</label>
                <div class="col-lg-11 col-md-10 col-sm-10 col-9 pt-2">
                  @if($request->session()->get('type') == 'Administrator' || $row->user->id == $request->session()->get('id') || $row->locked == 1)
                  <?php
                  if($row->files != null){
                    $files = explode(',', $row->files);
                    natcasesort($files);
                    foreach($files as $file){
                      $ext = pathinfo($file)['extension'];
                      if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg')
                        echo ' <a href="javascript:show_preview(\'assignment\', \''.$file.'\', null)">'.$file.'</a>';
                      else if($ext == 'pdf')
                        echo ' <a href="javascript:show_preview(\'assignment\', \''.$file.'\', \'100%\')">'.$file.'</a>';
                      else
                        echo ' <a href="'.asset('/').'files/assignment/'.$file.'".>'.$file.'</a>';
                    }
                  }
                  ?>
                  @else
                  Hidden
                  @endif
                </div>
              </div>
              @foreach($row->comment as $row_comment)
              <?php
              $row_comment->user->image = $row_comment->user->image == null ? 'no_image.jpg' : $row_comment->user->image;
              ?>
              <div class="form-group row">
                <div class="col-lg-1 col-md-2 col-sm-2 col-3">
                  <div class="profile-user-img img-fluid img-circle" style="background: url('{{ asset('/') }}images/user/{{$row_comment->user->image}}')center center/cover;padding-bottom: 90%;height: 0px;width: 100%"><img src="{{ asset('/') }}images/user/{{$row_comment->user->image}}" style="width: 100%;opacity: 0"></div>
                </div>
                <div class="col-lg-11 col-md-10 col-sm-10 col-9 text-sm">
                  <p><span class="text-secondary text-xs float-right"><i class="fas fa-clock"></i> {{date('j M Y H:i:s', strtotime($row_comment->created_at))}}</span><b>{{$row_comment->user->name}}</b></p>
                  <?=$row_comment->comment?>
                  <hr>
                </div>
              </div>
              @endforeach
              @if($request->session()->get('type') == 'Administrator' || $row->user->id == $request->session()->get('id'))
              <div class="form-group row">
                <div class="col-lg-1 col-md-2 col-sm-2 col-3">
                  <div class="profile-user-img img-fluid img-circle" style="background: url('{{ asset('/') }}images/user/{{Session::get('image')}}')center center/cover;padding-bottom: 90%;height: 0px;width: 100%">
                    <img src="{{ asset('/') }}images/user/{{Session::get('image')}}" style="width: 100%;opacity: 0">
                  </div>
                </div>
                <div class="col-lg-11 col-md-10 col-sm-10 col-9">
                  <textarea class="textarea" placeholder="Comment" name="comment" id="add_<?=$id_link?>_comment"></textarea>
                </div>
              </div>
              @endif
            </div>
          </div>
          <div class="timeline-footer text-right mt-n4 pr-4">
            @if($request->session()->get('type') == 'Administrator' || $row->user->id == $request->session()->get('id'))
            <a class="btn btn-primary btn-sm" onclick="cekuserform('add', '<?=$id_link?>')">Submit</a>
            @endif
          </div>
        </form>
      </div>
      <?php
      $i++;
      $id_link = $i == 0 ? 'inisial' : 'r'.$i;
      ?>
    @endforeach
    @if(Session::get('id') == $user_id)
      <!--<div class="time-label">
        <span class="bg-red">10 Feb. 2014</span>
      </div>-->
      <div id="{{$id_link}}">
        @if($i == 0)
        <i class="fa fa-info bg-primary mt-1"></i>
        @else
        <i class="fa fa_numb bg-primary mt-1">{{ucfirst($id_link)}}</i>
        @endif
        <form class="timeline-item" name="add_frm" id="add_frm" method="post" enctype="multipart/form-data" action="{{ url('/') }}/assignment/add/post">
          {{ csrf_field() }}
          <input type="hidden" name="topic_id" id="add_topic_id" value="{{$topic->id}}">
          <input type="hidden" name="user_id" id="add_user_id" value="{{$request->session()->get('id')}}">
          <input type="hidden" name="div_id" id="add_div_id" value="{{$id_link}}">
          <span class="time"><!--<i class="fas fa-clock"></i> 12:05--></span>
          <h3 class="timeline-header">
          @if($i == 0)
            <a href="#{{$id_link}}">Inisial Assignment</a>
            @else
            <a href="#{{$id_link}}">Revisi {{$i}}</a>
            @endif
          </h3>
          <div class="timeline-body">
            <div class="form-horizontal px-3">
              <div class="form-group row">
                <label class="col-lg-1 col-md-2 col-sm-2 col-3 col-form-label">Files</label>
                <div class="col-lg-11 col-md-10 col-sm-10 col-9">
                  <input type="file" class="form-control-file" name="data_files[]" id="add_files" multiple>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-1 col-md-2 col-sm-2 col-3 col-form-label">Comment</label>
                <div class="col-lg-11 col-md-10 col-sm-10 col-9">
                    <textarea class="textarea" placeholder="Comment" name="comment" id="add_comment"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="timeline-footer text-right mt-n4 pr-4">
            <a class="btn btn-primary btn-sm" onclick="cekform('add')">Submit</a>
          </div>
        </form>
      </div>
    @endif
    <!--<div class="time-label">
      <span class="bg-red">10 Feb. 2014</span>
    </div>
    <div>
      <i class="fa fa-check bg-primary"></i>
      <div class="timeline-item">
        <span class="time"><i class="fas fa-clock"></i> 12:05</span>
        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
        <div class="timeline-body">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
          weebly ning heekya handango imeem plugg dopplr jibjab, movity
          jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
          quora plaxo ideeli hulu weebly balihoo...
        </div>
        <div class="timeline-footer">
          <a class="btn btn-primary btn-sm">Read more</a>
          <a class="btn btn-danger btn-sm">Delete</a>
        </div>
      </div>
    </div>
    <!--<div class="time-label">
      <span class="bg-red">10 Feb. 2014</span>
    </div>
    <div>
      <i class="fas fa-comments bg-yellow"></i>
      <div class="timeline-item">
        <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
        <div class="timeline-body">
          Take me to your leader!
          Switzerland is small and neutral!
          We are more like Germany, ambitious and misunderstood!
        </div>
        <div class="timeline-footer">
          <a class="btn btn-warning btn-sm">View comment</a>
        </div>
      </div>
    </div>-->
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
                                ['font', ['bold', 'italic', 'underline']]
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