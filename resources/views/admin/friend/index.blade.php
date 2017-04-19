@extends('admin.layout.index')
@section('title','友情链接列表')
@section('header','友情链接列表')
@section('path','友情链接列表')
@section('con')
<br>
  <div class="col-xs-10">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">友情链接列表</h3>

              <div class="box-tools">

              <form action="/admin/friend/index" method='get'>
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input name="keyword" class="form-control pull-right" placeholder="友情链接名称" type="text">

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
                  <th>名称</th>
                  <th>链接地址</th>
                  <th>状态</th>
                  <th>操作</th>
                </tr>

			@foreach($info as $k=>$v)
                <tr>
                  <td>{{$v->id}}</td>
                  <td>{{$v->fname}}</td>
                  <td>{{$v->flink}}</td>
                  <td >
	                  <!-- <span class="label label-{{$v->open=='y'?'success':'danger'}} test" >
	                  	{{$v->open=='y'?'开启':'关闭'}}
	                  </span> -->
	                  @if($v->open=='y')
							<span class="label label-success test" >
							开启
							</span>
	                  @endif
	                  @if($v->open=='n')
							<span class="label label-danger test">
							关闭
							</span>	
	                  @endif
	              </td>
                  <td>
                  	<a href="" cid="{{$v->id}}" class='copen' copen='{{$v->open}}'>开启/关闭</a>&nbsp; |&nbsp;
                  	<a href="" did="{{$v->id}}" class='delf'>删除链接</a>&nbsp; |&nbsp;
                  	<a href="/admin/friend/update?id={{$v->id}}">修改</a>
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
<!-- ajax开启关闭显示友情链接 -->
<script type="text/javascript">

	//给所有的删除链接绑定事件
	$('.copen').click(function(){
		var id = $(this).attr('cid');
		var open = $(this).attr('copen')
		var links = $(this);

		$.ajaxSetup({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	  	});

		if(open=='n'){
			open = 'y';
			$.post('/admin/friend/open',{id:id,open:open},function(data){
				if(data == 1){
					//成功
					links.attr('copen','y')
					links.parents('tr').children('td:eq(3)').html('<span class="label label-success test" >开启</span>')
					$('#successMessage').text('开启成功').show(1000);
					setTimeout(function(){
					  $('#successMessage').hide(1000);
					},2000);
				}
			});
		}else{
			open = 'n';
			$.post('/admin/friend/open',{id:id,open:open},function(data){
				if(data == 1){
					//成功
					links.attr('copen','n')
					links.parents('tr').children('td:eq(3)').html('<span class="label label-danger test" >关闭</span>')
					$('#successMessage').text('关闭成功').show(1000);
					setTimeout(function(){
					  $('#successMessage').hide(1000);
					},2000);
				}
			});
		}

		return false;
	})
</script>

<!-- ajax删除友情链接 -->
<script type="text/javascript">
	$('.delf').click(function(){
		var id = $(this).attr('did');
		var links = $(this);

		$.ajaxSetup({
		      headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		      }
		});

		//发送ajax
		$.post('/admin/friend/del',{id:id},function(data){
		  if(data == 1){
		    //获取提醒信息
		    $('#successMessage').text('友情链接删除成功').show(1000);
		    setTimeout(function(){
		      $('#successMessage').hide(1000);
		    },2000);
		    links.parent('td').parent('tr').remove();
		  }
		});

		return false;
		})
</script>
@endsection