@extends('admin.layout.index')
@section('title','申请列表')
@section('path','申请列表')
@section('con')
  <div class="col-xs-12">
  <!-- 操作提示信息 -->
    <div class="box" style="width:100%;margin:0 auto">
      <div class="box-header">
        <h3 class="box-title">申请列表</h3>
        <!-- 通过用户名查找 -->
        <div class="box-tools">
      <form action="/admin/user/shenqing" method="get">
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
            	@if($v->moderator=='y')
					<span class="label label-info">
					版主
					</span>
                @endif
                @if($v->moderator=='n')
					<span class="label label-danger">
					普通用户
					</span>	
                @endif
	        </td>
            <td><img src="{{$v->photo}}" height="30" alt="加载失败"></td>
            <td>
                @if($v->vip=='y')
            <span class="label label-info">
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
            <a href="" class="agree" sid="{{$v->uid}}" once="y" twice ="n">
                <span class="label bg-blue">
                同意
                </span>
             </a>
            <a href="" class="refuse" sid="{{$v->uid}}" twice="n">
              	<span class="label label-info">
					      拒绝
      				  </span>
      			</a>
          <br>
           
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
  <!-- ajax给予管理 -->
  <script type="text/javascript">
  $('.agree').click(function(){
    //获取id
    var id = $(this).attr('sid');
    var moderator = $(this).attr('once');
    var shenqing = $(this).attr('twice');
    var links = $(this);

     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      //发送ajax
        $.post('/admin/user/agree',{id:id,moderator:moderator},function(data){
          if(data == 1){
            //获取提醒信息
            $('#successMessage').text('已同意成为版主').show(1000);
            setTimeout(function(){
              $('#successMessage').hide(1000);
            },2000);
          links.parents('tr').remove();
          }
      });
    return false;
  })
  </script>


  <!-- ajax拒绝给管理 -->
  <script type="text/javascript">
  $('.refuse').click(function(){
    //获取id
    var id = $(this).attr('sid');
    var shenqing = $(this).attr('twice');
    var links = $(this);

     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
      //发送ajax
        $.post('/admin/user/agree',{id:id,shenqing:shenqing},function(data){
          if(data == 1){
            //获取提醒信息
            $('#successMessage').text('成功拒绝').show(1000);
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
