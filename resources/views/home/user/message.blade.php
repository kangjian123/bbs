@extends('home.layout.index')
@section('con')
@section('bt')
<title>信息</title>
@endsection
<html>
  <body>
      <div class="users-show"> 
        <div class="col-md-3 main-col "> 
          <div class="box"> 
            <div class="padding-md "> 
                <div class="list-group text-center"> 
                  <a href="/home/user/information" class="list-group-item "> <i class="text-md fa fa-list-alt" aria-hidden="true"></i> &nbsp;个人信息 </a> 
                  <a href="/home/user/changephoto" class="list-group-item "> <i class="text-md fa fa-picture-o" aria-hidden="true"></i> &nbsp;修改头像 </a> 
                  <a href="/home/user/message" class="list-group-item active"> <i class="text-md fa fa-bell" aria-hidden="true"></i> &nbsp;消息通知 </a> 
                  <a href="/home/user/bind" class="list-group-item "> <i class="text-md fa fa-flask" aria-hidden="true"></i> &nbsp;账号绑定 </a> 
                  <a href="/home/user/changepass" class="list-group-item "> <i class="text-md fa fa-lock" aria-hidden="true"></i> &nbsp;修改密码 </a> 
                </div> 
            </div> 
          </div> 
        </div> 
        <div class="main-col col-md-9 left-col"> 
          <div class="panel panel-default padding-md"> 
            <div class="panel-body padding-bg"> 
                <h2><i class="fa fa-exclamation-circle" aria-hidden="true"></i> 抱歉，该功能尚未实现</h2> 
                    <hr/> 
                 <h1><i class="fa glyphicon-fire" aria-hidden="true"></i>程序猿在努力</h1>
            </div> 
          </div> 
        </div> 
      </div>
  </body>
</html>
@endsection