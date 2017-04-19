<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>牛逼闪闪后台登录系统</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="/admincss/plugins/iCheck/square/blue.css">

</head>
 <body class="hold-transition login-page" style="background-position: 0px 0px; background:url('/admincss/bootstrap/css/adminbg.jpg'); background-repeat: repeat; background-attachment: scroll;">
<div class="login-box">
  <div class="login-logo">
    <p style="color:#CEE6F2;font-family:微软雅黑;text-shadow:10px 10px 50 #272822;">后台登录</p>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="border-radius:5%">
    <p class="login-box-msg">请开始你的表演</p>
	    <!-- 操作提示信息 -->
@if (count($errors) > 0)
<div class="alert alert-info alert-dismissible">
    @foreach ($errors->all() as $error)
    <h4><i class="icon fa fa-ban"></i>{{ $error }}</h4>
    @endforeach
</div>
@endif
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

    <!-- 开始用户登录表单 -->
    <form action="{{url('/adlogin/dologin')}}" method="post">
      <div class="form-group has-feedback" >
        <input class="form-control" placeholder="请输入用户名" type="text" name="username" style="border-radius:7%">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback" >
        <input class="form-control" placeholder="请输入密码" type="password" name="password" style="border-radius:7%">
        <input  type='hidden' name='lastlogin' value='<?php echo time()+28800?>' />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
         <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
        </div>
        <!-- /.col -->
         <!-- 防跨站攻击 -->
    {{ csrf_field() }}
        <div class="col-xs-4">
          <button type="reset" class="btn btn-primary btn-block btn-flat">重置</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<script src="/admincss/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="/admincss/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/admincss/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

  <!-- 提示隐藏 -->
 <script type="text/javascript">
    $(function(){
         $('.alert-success').fadeOut(1500);
         $('.alert-danger').fadeOut(3000);
         $('.alert-info').fadeOut(1500);
    })
</script>

</body>
</html>