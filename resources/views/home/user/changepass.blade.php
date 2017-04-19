@extends('home.layout.index')
@section('con')
@section('bt')
<title>修改密码</title>
@endsection
<div class="users-show">
  <div class="col-md-3 main-col">
    <div class="box">
    <div class="padding-md ">
        <div class="list-group text-center">
          <a href="/home/user/information" class="list-group-item "> <i class="text-md fa fa-list-alt" aria-hidden="true"></i> &nbsp;个人信息 </a> 
            <a href="/home/user/changephoto" class="list-group-item "> <i class="text-md fa fa-picture-o" aria-hidden="true"></i> &nbsp;修改头像 </a> 
            <a href="/home/user/changepass" class="list-group-item active"> <i class="text-md fa fa-lock" aria-hidden="true"></i> &nbsp;修改密码 </a> 
        </div>
    </div>

</div>
  </div>

  <div class="col-md-9  left-col ">

    <div class="panel panel-default padding-md">

      <div class="panel-body ">

        <h2><i class="fa fa-lock" aria-hidden="true"></i> 修改密码</h2>
        <hr>
        <form class="form-horizontal" method="POST" action="{{url('/home/user/changepass')}}" accept-charset="UTF-8">

            <div class="form-group">
              <label class="col-md-2 control-label">原密码：</label>
              <div class="col-md-6">
                <input name="ypass" class="form-control" type="password" value="" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">新密码：</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">确认密码：</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="surepassword" required>
              </div>
            </div>

          <div class="form-group">
              <div class="col-sm-offset-2 col-sm-6">
                <input class="btn btn-primary" id="user-edit-submit" type="submit" value="应用修改">
              </div>
            </div>
          {{ csrf_field() }}
      </form>
      </div>

    </div>
  </div>
  </div>



</div>
@endsection