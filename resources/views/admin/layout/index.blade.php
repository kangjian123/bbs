<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('header')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="/admincss/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
    <link rel="stylesheet" href="/admincss/dist/dfonts/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/admincss/dist/dfonts/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/admincss/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/admincss/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/admincss/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="/admincss/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="/admincss/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="/admincss/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/admincss/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="/admincss/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="/admincss/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="/admincss/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-purple sidebar-mini" id='here'>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>牛逼</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>牛逼闪闪管理系统</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="/admincss/#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="/admincss/#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="/admincss/#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="/admincss/#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="/admincss/#">View all tasks</a>
              </li>
            </ul>
          </li>

          <!-- 通过session存入的信息查找数据库中相应字段信息 -->
      <?php
         $res = DB::table('user')
            ->join('userdetail', 'user.id', '=', 'userdetail.uid')
            ->where('username',$_SESSION['username'])
            ->first()
          ?>
      
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="/admincss/#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{$res->photo}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{$res->nickname}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{$res->photo}}" class="img-circle" alt="User Image">

                <p>
                  {{$res->nickname}} - 欢迎你!
                  <small id="timezone"></small>
                  <small id="">{{$res->content}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/admin/user/update?id={{$res->uid}}" class="btn btn-default btn-flat">资料修改</a>
                </div>
                <div class="pull-right">
                  <a href="/adlogin/logout" class="btn btn-default btn-flat" type="button">登 出</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

      
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{$res->photo}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{$res->nickname}}</p>
          <a href=""><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

        <li class="treeview">
          <a href="/admincss/#">
            <i class="fa fa-user text-blue"></i> <span>用户管理</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/user/index')}}"><i class="fa fa-list"></i>用户列表</a></li>
            <li><a href="{{url('/admin/user/add')}}"><i class="fa fa-list"></i>用户添加</a></li>
            <li><a href="{{url('/admin/user/shenqing')}}"><i class="fa fa-list"></i>管理申请列表</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="/admincss/#">
            <i class="fa fa-pie-chart text-yellow"></i> <span>板块管理</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/cate/index')}}"><i class="fa fa-list"></i>板块列表</a></li>
            <li><a href="{{url('/admin/cate/add')}}"><i class="fa fa-list"></i>板块添加</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="/admincss/#">
            <i class="fa fa-fw fa-file-text-o"></i> <span>帖子管理</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/card/index')}}"><i class="fa fa-fw fa-th-list"></i> 帖子列表</a></li>
            <li><a href="{{url('/admin/card/recycle')}}"><i class="fa fa-fw fa-th-list"></i> 回收站</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="/admincss/#">
            <i class="fa fa-fw fa-heart text-red "></i> <span>友情链接</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/friend/index')}}"><i class="fa fa-fw fa-th-list"></i> 查看友情链接</a></li>
            <li><a href="{{url('/admin/friend/add')}}"><i class="fa fa-fw fa-plus-square"></i> 添加友情链接</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="/admincss/#">
            <i class="fa fa-fw fa-money text-green"></i> <span>广告管理</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('/admin/ad/index')}}"><i class="fa fa-fw fa-th-list"></i> 广告列表</a></li>
            <li><a href="{{url('/admin/ad/add')}}"><i class="fa fa-fw fa-plus-square"></i> 添加广告</a></li>
          </ul>
        </li>

       <li><a href="{{url('/admin/config/update')}}"><i class="fa fa-fw fa-warning text-red"></i> <span>网站配置</span></a></li>
       <li><a href="{{url('/admin/vip/index')}}"><i class="fa fa-fw fa-diamond text-info"></i> <span>会员大人</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('header')
        <small>@yield('small')</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i> 主页</a></li>
        <li class="active">@yield('path')</li>
      </ol>
    </section>

 <!-- 显示 闪存信息 -->
  <div id="successMessage" class="alert alert-success alert-dismissable" style="display:none">
    
  </div>
  @if(session('success'))
      <div class="alert alert-success alert-dismissable">
          {{session('success')}}
      </div>
  @endif

  @if(session('error'))
      <div class="alert alert-danger  alert-dismissable">
          {{session('error')}}
      </div>
  @endif
@section('con')
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">

      <!-- 用户模块 -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{DB::table('user')->count()}}</h3>

              <p>用户管理</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('/admin/user/index')}}" class="small-box-footer">查看详细<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

      <!-- 板块模块 -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3>{{DB::table('type')->count()}}</h3>

              <p>版块管理</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('/admin/cate/index')}}" class="small-box-footer">查看详细 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
  
        <!-- 帖子模块 -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{DB::table('post')->count()}}</h3>

              <p>帖子管理</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-align-justify"></i>
            </div>
            <a href="{{url('/admin/card/index')}}" class="small-box-footer">查看详细<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
        <!-- 友情链接 -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{DB::table('friendlink')->count()}}</h3>

              <p>友情链接</p>
            </div>
            <div class="icon">
              <i class="glyphicon glyphicon-heart"></i>
            </div>
            <a href="{{url('/admin/friend/index')}}" class="small-box-footer">查看详细<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
      <!-- 广告模块 -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <h3>{{DB::table('ad')->count()}}</h3>

              <p>广告管理</p>
            </div>
            <div class="icon">
              <i class="fa fa-thumbs-o-up"></i>
            </div>
            <a href="{{url('/admin/ad/index')}}" class="small-box-footer">查看详细<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
       
      <!-- 会员模块 -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{DB::table('userdetail')->where('vip','=','y')->count()}}</h3>

              <p>会员管理</p>
            </div>
            <div class="icon">
              <i class="fa fa-star-o"></i>
            </div>
            <a href="{{url('/admin/vip/index')}}" class="small-box-footer">查看详细<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

      <!-- 轮播图 -->
      <div class="col-md-6" style="width:900px;margin-left:100px;">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Tenno</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="/admincss/bootstrap/1.jpg" alt="First slide">

                    <div class="carousel-caption">
                      We
                    </div>
                  </div>
                  <div class="item">
                    <img src="/admincss/bootstrap/2.jpg" alt="Second slide">

                    <div class="carousel-caption">
                      Are
                    </div>
                  </div>
                  <div class="item">
                    <img src="/admincss/bootstrap/3.jpg" alt="Third slide">

                    <div class="carousel-caption">
                      Tenno
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

      </div>
    <!-- /.content -->
  </div> 
   </section>
   
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.2
    </div>
    <strong>Copyright &copy; 2014-2015 <a href="/admincss/http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
  <!-- Control Sidebar -->
@show
  <!-- /.content-wrapper -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="/admincss/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/admincss/plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="/admincss/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="/admincss/plugins/ajax/raphael-min.js"></script>
<!-- <script src="/admincss/plugins/morris/morris.min.js"></script> -->
<!-- Sparkline -->
<script src="/admincss/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/admincss/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/admincss/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/admincss/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="/admincss/plugins/ajax/moment.min.js"></script>
<script src="/admincss/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/admincss/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/admincss/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/admincss/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/admincss/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/admincss/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="/admincss/dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="/admincss/dist/js/demo.js"></script>

<script type="text/javascript">
    $(function(){
         $('.alert-success').fadeOut(1500);
         $('.alert-danger').fadeOut(3000);
         // $('.alert-info').fadeOut(1500);
    })
</script>

  <!-- 一个显示系统时间的js代码 -->
<script type="text/javascript">
  var time = document.getElementById('timezone');
  //启动定时器
  setInterval(function(){
    var d = new Date();//创建一个本机时间 
    //获取四位数的年
    //获取四位数的年
    var year = d.getFullYear();
    //获取月份 (0-11)
    var month = d.getMonth()+1;
    if(month < 10)
    {
      month = '0'+month;
    }
    //获取天数
    var date = d.getDate();
    if(date < 10)
    {
      date = '0'+date;
    }
    //获取小时
    var hours = d.getHours();
    //获取分钟
    var minutes = d.getMinutes();
    if(minutes < 10)
    {
      minutes = '0'+minutes;
    }
    //获取秒
    var seconds = d.getSeconds();
    if(seconds < 10)
    {
      seconds = '0'+seconds;
    }
    //获取星期
    var day = d.getDay();

    var str = year+'-'+month+'-'+date+' '+hours+':'+minutes+':'+seconds;
    //修改文本
    time.innerHTML = str;
  },1000)
  </script>
 @section('js')
    

    @show
</body>
</html>
