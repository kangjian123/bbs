@extends('home.layout.index')
@section('con')
@section('bt')
<title>个人资料</title>
@endsection
<div class="users-show">
  <div class="col-md-3 main-col">
    <div class="box">
    <div class="padding-md ">
        <div class="list-group text-center">
          <a href="/home/user/information" class="list-group-item active"> <i class="text-md fa fa-list-alt" aria-hidden="true"></i> &nbsp;个人信息 </a> 
          <a href="/home/user/changephoto" class="list-group-item "> <i class="text-md fa fa-picture-o" aria-hidden="true"></i> &nbsp;修改头像 </a> 
          <a href="/home/user/changepass" class="list-group-item "> <i class="text-md fa fa-lock" aria-hidden="true"></i> &nbsp;修改密码 </a> 
        </div>
    </div>

</div>
  </div>

  <div class="col-md-9  left-col ">

    <div class="panel panel-default padding-md">

      <div class="panel-body ">

        <h2><i class="fa fa-cog" aria-hidden="true"></i> 编辑个人资料</h2>
        <hr>
        <form class="form-horizontal" method="POST" action="{{url('/home/user/upinformation')}}" accept-charset="UTF-8">
            
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">昵称</label>
                <div class="col-sm-6">
                    <input class="form-control" name="nickname" type="text" required placeholder="请填写 用户名" value="{{$resm['0']->nickname}}">
                </div>
                <div class="col-sm-4 help-block">
                  如:李小明(个人中心页显示)
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">性别</label>
                <div class="col-sm-6">
                    <select class="form-control" name="sex">
                      <option value="m" {{ ($resm[0]->sex)=='m' ? 'selected' : '' }} >男</option>
                      <option value="w" {{ ($resm[0]->sex)=='w' ? 'selected' : '' }} >女</option>
                    </select>
                </div>

                <div class="col-sm-4 help-block"></div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-2 control-label">邮 箱</label>
                <div class="col-sm-6">
                    <input class="form-control" name="email" type="text" value="{{$resm['0']->email}}">
                </div>
                <div class="col-sm-4 help-block">
                    如:name@qq.com
                </div>
            </div>


          <div class="form-group">
              <label for="" class="col-sm-2 control-label">QQ</label>
              <div class="col-sm-6">
                  <input class="form-control" name="qq" type="text" value="{{$resm['0']->qq}}">
              </div>
              <div class="col-sm-4 help-block">
                    如:123123123
              </div>
          </div>

          
          <div class="form-group">
              <label for="" class="col-sm-2 control-label">个人简介</label>
              <div class="col-sm-6">
                  <textarea class="form-control" rows="3" name="content" cols="50">{{$resm['0']->content}}</textarea>
              </div>
              <div class="col-sm-4 help-block">
                    请一句话介绍你自己
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