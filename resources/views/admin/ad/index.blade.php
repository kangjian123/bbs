@extends('admin.layout.index')
@section('title','广告列表')
@section('header','广告列表')
@section('path','广告列表')
@section('con')
  <br>
  <div class="col-xs-10">
          <div class="box">
            <div class="box-header">,
              <h3 class="box-title">广告列表</h3>

              <div class="box-tools">

              <form action="/admin/ad/index" method='get'>
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input name="keyword" class="form-control pull-right" placeholder="广告名称名称" type="text">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
              </form>

                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>广告名称</th>
                  <th>广告地址</th>
                  <th>广告图片</th>
                  <th>操作</th>
                </tr>

			@foreach($info as $k=>$v)
                <tr>
                  <td>{{$v->id}}</td>
                  <td>{{$v->adname}}</td>
                  <td>{{$v->adlink}}</td>
                  <td><img src="{{$v->adpic}}" height="30" alt="加载失败"></td>
                  <td>
	             		<a href="" class="delad" did="{{$v->id}}">删除</a> | 
	             		<a href="/admin/ad/update?id={{$v->id}}">修改</a> | 
	             		<a href="">待定</a>
                  </td>
                </tr>
			@endforeach

              </tbody></table>
            </div>
            <div style="margin-left:450px;">
            	{!! $info->appends($all)->render() !!}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
@endsection
@section('js')

<!-- ajax删除广告 -->
<script type="text/javascript">
  
  //给所有的删除链接绑定事件
  $('.delad').click(function(){
    //获取id
    var id = $(this).attr('did');
    var links = $(this);

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    //发送ajax
    $.post('/admin/ad/delad',{id:id},function(data){
        if(data == 1){
          //获取提醒信息
          $('#successMessage').text('广告删除成功').show(1000);
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