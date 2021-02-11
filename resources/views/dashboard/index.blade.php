@extends('../template')
@section('title', $title)
@section('content_css')
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/jqvmap/jqvmap.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/summernote/summernote-bs4.css">
@endsection
@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>150</h3>
        <p>New Orders</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>53<sup style="font-size: 20px">%</sup></h3>
        <p>Bounce Rate</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>44</h3>
        <p>User Registrations</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>65</h3>
        <p>Unique Visitors</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
  <section class="col-lg-12 connectedSortable">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fa fa-camera-retro mr-1"></i>
          Our Gallery
        </h3>
      </div>
      <div class="card-body">
        <div class="row" id="instagram-feed1">
        </div>
      </div>
    </div>
  </section>
  <!-- Left col -->
  <section class="col-lg-7 connectedSortable">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-pie mr-1"></i>
          Sales
        </h3>
        <div class="card-tools">
          <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
            </li>
          </ul>
        </div>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content p-0">
          <!-- Morris chart - Sales -->
          <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>                         
           </div>
          <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
            <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>                         
          </div>  
        </div>
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.Left col -->
  <!-- right col (We are only adding the ID to make the widgets sortable)-->
  <section class="col-lg-5 connectedSortable">
    <!-- Map card -->
    <div class="card bg-gradient-primary">
      <div class="card-header border-0">
        <h3 class="card-title">
          <i class="fas fa-map-marker-alt mr-1"></i>
          Visitors
        </h3>
        <!-- card tools -->
        <div class="card-tools">
          <button type="button" class="btn btn-primary btn-sm daterange" data-toggle="tooltip" title="Date range">
            <i class="far fa-calendar-alt"></i>
          </button>
          <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
        <!-- /.card-tools -->
      </div>
      <div class="card-body">
        <div id="world-map" style="height: 250px; width: 100%;"></div>
      </div>
      <!-- /.card-body-->
      <div class="card-footer bg-transparent">
        <div class="row">
          <div class="col-4 text-center">
            <div id="sparkline-1"></div>
            <div class="text-white">Visitors</div>
          </div>
          <!-- ./col -->
          <div class="col-4 text-center">
            <div id="sparkline-2"></div>
            <div class="text-white">Online</div>
          </div>
          <!-- ./col -->
          <div class="col-4 text-center">
            <div id="sparkline-3"></div>
            <div class="text-white">Sales</div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
    <!-- /.card -->
  </section>
  <!-- right col -->
</div>
<!-- /.row (main row) -->
@endsection
@section('content_js')
<!-- ChartJS -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/moment/moment.min.js"></script>
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/') }}vendor/almasaeed2010/adminlte/dist/js/demo.js"></script>

<script async src="//platform.instagram.com/en_US/embeds.js"></script>
<script src="{{ asset('/') }}third_party/jquery.instagramFeed-master/jquery.instagramFeed.min.js"></script>
<script>
    (function($){
        $(window).on('load', function(){
            $.instagramFeed({
                'username': '_kpmk_',
                'callback': function(data){insta_loop(data)}
                /*'callback': function(data){console.log(data)},
                'container': "#instagram-feed1",
                'display_profile': true,
                'display_biography': true,
                'display_gallery': true,
                'display_captions': true,
                'styling': true,
                'items': 8,
                'items_per_row': 4,
                'margin': 1,
                'lazy_load': true,
                'on_error': console.error,
                'on_succes': console.log(data)*/
            });
        });
    })(jQuery);
function insta_loop(data){
  //console.log(data.edge_owner_to_timeline_media.edges);
  var arr_feed = data.edge_owner_to_timeline_media.edges;
  for(var i=0;i<arr_feed.length;i++){
    console.log(arr_feed[i].node);
    $('#instagram-feed1').append('<div class="col-lg-3 col-6">'+
                    '<iframe src="https://www.instagram.com/p/'+arr_feed[i].node.shortcode+'/embed" class="border rounded" height="450" width="100%" frameborder="0" scrolling="no" allowtransparency="true"></iframe>'+
                  '</div>');
  }
  /*setTimeout(function() {
      var head_ID = document.getElementsByTagName("head")[0]; 
      var script_element = document.createElement('script');
      script_element.type = 'text/javascript';
      script_element.src = '//platform.instagram.com/en_US/embeds.js';
      head_ID.appendChild(script_element);
      console.log('//platform.instagram.com/en_US/embeds.js');
    }, 3000);*/
}
function insta_loop1(data){
  //console.log(data.edge_owner_to_timeline_media.edges);
  var arr_feed = data.edge_owner_to_timeline_media.edges;
  for(var i=0;i<arr_feed.length;i++){
    let calc_height = (arr_feed[i].node.dimensions.height*100)/arr_feed[i].node.dimensions.width;
    let modif_height = Math.floor(calc_height*0.18);
    console.log(modif_height);
    console.log(arr_feed[i]);
    //console.log($('#instagram-feed1')[0].clientWidth);
    $('#instagram-feed1').append('<div class="col-md-3 col-lg-6 col-12">'+
                    '<iframe src="https://www.instagram.com/p/'+arr_feed[i].node.shortcode+'/embed" style="margin-bottom:calc('+modif_height+'vw - 230px);height:calc('+modif_height+'vw + 210px);"  width="100%" frameborder="0" scrolling="no" allowtransparency="true"></iframe>'+
                  '</div>');
  }
}
function insta_loop2(data){
  //console.log(data.edge_owner_to_timeline_media.edges);
  var arr_feed = data.edge_owner_to_timeline_media.edges;
  for(var i=0;i<arr_feed.length;i++){
    let calc_height = (arr_feed[i].node.dimensions.height*100)/arr_feed[i].node.dimensions.width;
    let modif_height = Math.floor(calc_height*0.39);
    console.log(modif_height);
    console.log(arr_feed[i]);
    //console.log($('#instagram-feed1')[0].clientWidth);
    $('#instagram-feed1').append('<div class="col-lg-3 col-6">'+
                    '<iframe src="https://www.instagram.com/p/'+arr_feed[i].node.shortcode+'/embed" style="margin-bottom:calc('+modif_height+'% + 250px);height:calc('+modif_height+'% + 200px);"  width="100%" frameborder="0" scrolling="no" allowtransparency="true"></iframe>'+
                  '</div>');
  }
}
</script>
@endsection