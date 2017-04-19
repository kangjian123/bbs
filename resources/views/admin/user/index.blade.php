@extends('admin.layout.index')
@section('title','用户列表')
@section('path','用户列表')
@section('con')
  <div class="col-xs-12">
  <!-- 操作提示信息 -->
    <div class="box" style="width:100%;margin:0 auto">
      <div class="box-header">
        <h3 class="box-title">用户列表</h3>
        <!-- 通过用户名查找 -->
        <div class="box-tools">
      <form action="/admin/user/index" method="get">
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
            <th>用户权限</th>
            <th>电子邮件</th>
            <th>性别</th>
            <th>QQ</th>
            <th>头像</th>
            <th>VIP</th>
            <th>积分</th>
            <th>最后登录</th>
            <th>操作</th>
          </tr>
          <!-- 遍历users中的内容 -->
        @foreach($users as $k=>$v)
          <tr>
            <td>{{$v->uid}}</td>
            <td>{{$v->username}}</td>
            <td>{{$v->nickname}}</td>
            <td>
            	@if($v->auth=='y')
					<span class="label label-info">
					管理员
					</span>
                @endif
                @if($v->auth=='n')
					<span class="label label-danger">
					普通用户
					</span>	
                @endif
	        </td>
            <td><span class="label label-success">{{$v->email}}</span></td>
            <td>{{$v->sex=='m'?'男':'女'}}</td>
            <td>{{$v->qq==0?'未填写':$v->qq}}</td>
            <td><img src="{{$v->photo}}" height="30" alt="加载失败"></td>
            <td>
                @if($v->vip=='y')
            <span class="label label-danger">
            荣誉会员
            </span>
                @endif
                @if($v->vip=='n')
            <span class="label label-success">
            辣鸡用户
            </span> 
                @endif</td>
            <td>{{$v->integral}}</td>
            <td>{{date("Y-m-d H:i:s",$v->lastlogin+6*3600)}}</td>
            <td>
            <a href="" class="aAuth" sid="{{$v->uid}}" once="{{$v->auth}}">
                <span class="label bg-blue">权限</span>
            </a>
            <a href="" class="qVip" sid="{{$v->uid}}" once="{{$v->vip}}">
              	<span class="label label-info">会员</span>
			      </a>
          <br>
            <a href="" class="userDel" sid="{{$v->uid}}">
                <span class="label bg-red">删除</span>
			      </a>
            <a href="/admin/user/update?id={{$v->uid}}">
            <span class="label bg-yellow">修改</span>
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

	<!-- ajax用户删除 -->
  <script type="text/javascript">

  //给所有的删除链接绑定事件
  $('.userDel').click(function(){
    //获取id
    var id = $(this).attr('sid');
    var links = $(this);

     $.ajaxSetup({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	  });

    //发送ajax
    $.post('/admin/user/delete',{id:id},function(data){
        if(data == 1){
          //获取提醒信息
          $('#successMessage').text('删除成功').show(1000);
          setTimeout(function(){
            $('#successMessage').hide(1000);
          },2000);
          links.parent('td').parent('tr').remove();
        }
    });

    return false;
  })
  </script>

  <!-- ajax限制用户登录 -->
  <script type="text/javascript">
  $('.aAuth').click(function(){
    //获取id
    var id = $(this).attr('sid');
    var auth = $(this).attr('once');
    var links = $(this);

     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

     if(auth == 'y'){
      //发送ajax
      auth = 'n';
        $.post('/admin/user/auth',{id:id,auth:auth},function(data){
          if(data == 1){
            //获取提醒信息
           links.attr('once','n');
           links.parents('tr').children('td:eq(3)').html('<span class="label label-danger">普通用户</span>');
            $('#successMessage').text('取消管理').show(1000);
            setTimeout(function(){
              $('#successMessage').hide(1000);
            },2000);
          }
      });
    }else{
    auth = 'y';
    $.post('/admin/user/auth',{id:id,auth:auth},function(data){
          if(data == 1){
            //获取提醒信息
            links.attr('once','y');
          links.parents('tr').children('td:eq(3)').html('<span class="label label-info">管理员</span>');
            $('#successMessage').text('成为管理').show(1000);
            setTimeout(function(){
              $('#successMessage').hide(1000);
            },2000);
          }
      });
     }
    return false;
  })
  </script> 

	<!-- ajax给予会员 -->
  <script type="text/javascript">
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

     if(vip == 'y'){
     	//发送ajax
     	vip = 'n';
        $.post('/admin/user/qvip',{id:id,vip:vip},function(data){
	        if(data == 1){
	          //获取提醒信息
		       links.attr('once','n');
		       links.parents('tr').children('td:eq(8)').html('<span class="label label-success">辣鸡用户</span>');
	          $('#successMessage').text('取消会员').show(1000);
	          setTimeout(function(){
	            $('#successMessage').hide(1000);
	          },2000);
       		}
   		});
    }else{
		vip = 'y';
		$.post('/admin/user/qvip',{id:id,vip:vip},function(data){
	        if(data == 1){
	          //获取提醒信息
	          links.attr('once','y');
		      links.parents('tr').children('td:eq(8)').html('<span class="label label-danger">荣誉会员</span>');
	          $('#successMessage').text('成为会员').show(1000);
	          setTimeout(function(){
	            $('#successMessage').hide(1000);
	          },2000);
       		}
    	});
     }
    return false;
  })
  </script>
@endsection
