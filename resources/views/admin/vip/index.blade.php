@extends('admin.layout.index')
@section('title','会员列表')
@section('path','会员列表')
@section('con')
  <div class="col-xs-12">
  <!-- 操作提示信息 -->
    <div class="box" style="width:100%;margin:0 auto">
      <div class="box-header">
        <h3 class="box-title">会员列表</h3>
        <!-- 通过用户名查找 -->
        <div class="box-tools">
      <form action="/admin/vip/index" method="get">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input name="keyword" class="form-control pull-right" placeholder="Search" type="search">
            <div class="input-group-btn">
              <button class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
      </form>
        </div>
      </div>
      <!-- 用户信息 -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tbody><tr>
            <th>ID</th>
            <th>用户名</th>
            <th>昵称</th>
            <th>头像</th>
            <th>VIP</th>
            <th>会员积分</th>
            <th>最后登录</th>
            <th>操作</th>
          </tr>
          <!-- 遍历users中的内容 -->
        @foreach($users as $k=>$v)
          <tr>
            <td>{{$v->uid}}</td>
            <td>{{$v->username}}</td>
            <td><span style="color:red">{{$v->nickname}}</span></td>
            <td><img src="{{$v->photo}}" height="30" alt="加载失败"></td>
            <td><span class="label label-danger">{{$v->vip=='y'?'荣誉会员':'辣鸡用户'}}</span></td>
            <td>{{$v->integral}}</td>
            <td>{{date("Y-m-d H:i:s",$v->lastlogin+6*3600)}}</td>
            <td>
              <a href="" class="qVip" sid="{{$v->uid}}" once="n">
                	<span class="label bg-green">
          					取消会员
          				</span>
  			      </a>
            </td>
          </tr>        
        @endforeach
        </tbody></table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
          {!! $users->appends($all)->render() !!}
  </div>
@endsection
@section('js')

  <!-- ajax取消会员 -->
  <script type="text/javascript">

  //给所有的删除链接绑定事件
  $('.qVip').click(function(){
    //获取id
    var id = $(this).attr('sid');
    var vip = $(this).attr('once');
    var links = $(this);

     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    //发送ajax
    $.post('/admin/vip/qvip',{id:id,vip:vip},function(data){
        if(data == 1){
            //获取提醒信息
            $('#successMessage').text('成功取消会员').show(1000);
            setTimeout(function(){
              $('#successMessage').hide(1000);
            },2000);
          links.parents('tr').remove();
          }
      });
    return false;
  })
  </script>
@endsection
