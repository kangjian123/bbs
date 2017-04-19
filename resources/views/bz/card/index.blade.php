@extends('bz.layout.index')
@section('title','版主后台帖子管理')
@section('header','查看全部帖子')
@section('path','版主后台帖子管理')
@section('con')
	  <!-- /.box-header --> 
	  <br> <div class='box box-success'>
	  <div class="box-body"> 
	   <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
	    
		<!-- 分页表单 -->
		<form action="/bz/card/index" method='get'>
		    <div class="row">
		     <div class="col-sm-6">
		      <div class="dataTables_length" id="example1_length">
		       <label>请选择板块： 

		       <select name="tid" aria-controls="example1" class="form-control input-sm">
				<option value="" selected='selected'>请选择</option>
				@foreach($type as $tk=>$tv)
		       <option value="{{$type[$tk]->id}}">{{$type[$tk]->tname}}</option>
		       	@endforeach

		       </select>

		       </label>
		      </div>
		     </div>
		     <div class="col-sm-6">
		      <div id="example1_filter" class="dataTables_filter">
		       <label>帖子标题 : <input name='keyword' class="form-control input-sm" placeholder="" aria-controls="example1" type="search" /></label>
		       &nbsp;<button class="btn btn-primary">搜索</button>
		      </div>
		     </div>
		    </div>
	    </form>
	    <div class="row">
	     <div class="col-sm-12">
	      <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info"> 
	       <thead> 
	        <tr role="row">
	         <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">帖子id</th>
	         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 150px;" aria-label="Engine version: activate to sort column ascending">发帖人</th>
	         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 200px;" aria-label="CSS grade: activate to sort column ascending">标题</th>
	         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 150px;" aria-label="Browser: activate to sort column ascending">发帖时间</th>
	         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="Browser: activate to sort column ascending">点击数</th>
	         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="Platform(s): activate to sort column ascending">是否精华</th>
	         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="Engine version: activate to sort column ascending">是否置顶</th>
	         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">是否可回复</th>
	         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 200px;" aria-label="CSS grade: activate to sort column ascending">操作</th>
	        </tr> 
	       </thead> 
	       <tbody> 
	<hr>


		@foreach($card as $k=>$v)
	        <tr role="row" class="odd"> <!--class='even'-->
	         <td class="sorting_1">{{$v->id}}</td> 
	         <td>{{$v->nickname}}</td> 
	         <td>{{$v->ptitle}}</td> 
	         <td>{{date("Y-m-d H:i:s",$v->pctime)}}</td>
	         <td>{{$v->click}} 次</td>
	         <td>{{$v->elite=='y'? '是':'否'}}</td>
	         <td>{{$v->top=='y'? '是':'否'}}</td>
	         <td>{{$v->creply=='0'? '是':'否'}}</td>
	         <td>
	         	<a href="/bz/card/elite?id={{$v->id}}" class="Elite" sid="{{$v->id}}" data='{{$v->elite}}'>加精</a> |
	         	<a href="/bz/card/top?id={{$v->id}}" class="Top" sid="{{$v->id}}" data='{{$v->top}}'>置顶</a> |
	         	<a href="/bz/card/top?id={{$v->id}}" class="Reply" sid="{{$v->id}}" data='{{$v->creply}}'>禁回</a> |
	         	<a href="/bz/card/dorecycle?id={{$v->id}}" class="Recycle" sid="{{$v->id}}" data='y'>加入回收站</a> |
	         	<a href="/bz/card/info?id={{$v->id}}">详情</a>
	         </td> 
	        </tr>
		@endforeach



	       </tbody>
	      </table>
	     </div>
	    </div>
	    <div class="row">
	     <div class="col-sm-5">
	      <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
	       Showing 1 to 10 of 57 entries
	      </div>
	     </div>
	     <div class="col-sm-7">
	     	{!! $card->appends($all)->render() !!}
	     </div>
	    </div>
	   </div> 
	  </div> </div>
	  <!-- /.box-body -->
@endsection
@section('js')
<!-- ajax加入回收站 -->
<script type="text/javascript">

	//给所有的删除链接绑定事件
	$('.Recycle').click(function(){
	  //获取id
	  var id = $(this).attr('sid');
	  var recycle = $(this).attr('data');
	  var links = $(this);

	  $.ajaxSetup({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	  });

	  //发送ajax
	  $.post('/bz/card/dorecycle',{id:id,recycle:recycle},function(data){
	      if(data == 1){
	        //获取提醒信息
	        $('#successMessage').text('加入回收站成功').show(1000);
	        setTimeout(function(){
	          $('#successMessage').hide(1000);
	        },2000);
	        links.parents('tr').remove();
	      }
	  });

	  return false;
	})
</script>

<!-- ajax加精 -->
<script type="text/javascript">

	//给所有的删除链接绑定事件
	$('.Elite').click(function(){
	  //获取id
	  var id = $(this).attr('sid');
	  var elite = $(this).attr('data');
	  var links = $(this);

	  $.ajaxSetup({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	  });


	  	if(elite=='n'){
	  		//加精区间

		  //发送ajax
		  elite = 'y'
		  $.post('/bz/card/elite',{id:id,elite:elite},function(data){
		      if(data == 1){
		        //获取提醒信息
		        links.attr('data','y')
		        links.parents('tr').children('td:eq(5)').html('是')
		        $('#successMessage').text('加精成功').show(1000);
		        setTimeout(function(){
		          $('#successMessage').hide(1000);
		        },2000);
		        // links.parents('tr').remove();
		      }
		  });
		}else{
			//取消加精

			//发送ajax
			elite = 'n'
		  $.post('/bz/card/elite',{id:id,elite:elite},function(data){
		      if(data == 1){
		        //获取提醒信息
		        links.attr('data','n')
		        links.parents('tr').children('td:eq(5)').html('否')
		        $('#successMessage').text('取消加精').show(1000);
		        setTimeout(function(){
		          $('#successMessage').hide(1000);
		        },2000);
		        // links.parents('tr').remove();
		      }
		  });
		}

	  return false;
	})
</script>

<!-- ajax置顶 -->
<script type="text/javascript">

	//给所有的删除链接绑定事件
	$('.Top').click(function(){
	  //获取id
	  var id = $(this).attr('sid');
	  var top = $(this).attr('data');
	  var links = $(this);

	  $.ajaxSetup({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	  });

	  	if(top=='n'){
		  //发送ajax
		  top = 'y'
		  $.post('/bz/card/top',{id:id,top:top},function(data){
		      if(data == 1){
		        //获取提醒信息
		        links.attr('data','y')
		        links.parents('tr').children('td:eq(6)').html('是')
		        $('#successMessage').text('置顶成功').show(1000);
		        setTimeout(function(){
		          $('#successMessage').hide(1000);
		        },2000);
		        // links.parents('tr').remove();
		      }
		  });
		}else{
			//发送ajax
			top = 'n'
		  $.post('/bz/card/top',{id:id,top:top},function(data){
		      if(data == 1){
		        //获取提醒信息
		        links.attr('data','n')
		        links.parents('tr').children('td:eq(6)').html('否')
		        $('#successMessage').text('取消置顶').show(1000);
		        setTimeout(function(){
		          $('#successMessage').hide(1000);
		        },2000);
		        // links.parents('tr').remove();
		      }else{
		      	$('#successMessage').text('置顶失败').show(1000);
		        setTimeout(function(){
		          $('#successMessage').hide(1000);
		        },2000);
		      }
		  });
		}

	  return false;
	})
</script>

<!-- ajax禁止回复 -->
<script type="text/javascript">

	//给所有的删除链接绑定事件
	$('.Reply').click(function(){
	  //获取id
	  var id = $(this).attr('sid');
	  var creply = $(this).attr('data');
	  var links = $(this);

	  $.ajaxSetup({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	  });

	  	if(creply=='1'){
		  //发送ajax
		  creply = '0'
		  $.post('/bz/card/reply',{id:id,creply:creply},function(data){
		      if(data == 1){
		        //获取提醒信息
		        links.attr('data','0')
		        links.parents('tr').children('td:eq(7)').html('是')
		        $('#successMessage').text('允许回复成功').show(1000);
		        setTimeout(function(){
		          $('#successMessage').hide(1000);
		        },2000);
		        // links.parents('tr').remove();
		      }
		  });
		}else{
			//发送ajax
			creply = '1'
		  $.post('/bz/card/reply',{id:id,creply:creply},function(data){
		      if(data == 1){
		        //获取提醒信息
		        links.attr('data','1')
		        links.parents('tr').children('td:eq(7)').html('否')
		        $('#successMessage').text('禁止回复成功').show(1000);
		        setTimeout(function(){
		          $('#successMessage').hide(1000);
		        },2000);
		        // links.parents('tr').remove();
		      }
		  });
		}

	  return false;
	})
</script>

@endsection
