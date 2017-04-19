@extends('admin.layout.index')
@section('title','回收站')
@section('header','回收站')
@section('path','回收站')
@section('con')
	  <!-- /.box-header --> 
	  <br> <div class='box box-success'>
	  <div class="box-body"> 
	   <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
	    
		<!-- 分页表单 -->
		<form action="/admin/card/index" method='get'>
		    <div class="row">
		     <div class="col-sm-6">
		      <div class="dataTables_length" id="example1_length">
		       <label>每页显示： <select name="num" aria-controls="example1" class="form-control input-sm">
		       <option value="10">10</option>
		       <option value="25">25</option>
		       <option value="50">50</option>
		       <option value="100">100</option>
		       </select> 页

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
	         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="CSS grade: activate to sort column ascending">是否可回复</th>
	         <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 200px;" aria-label="CSS grade: activate to sort column ascending">操作</th>
	        </tr> 
	       </thead> 
	       <tbody> 

		@foreach($card as $k=>$v)
	        <tr role="row" class="odd"> <!--class='even'-->
	         <td class="sorting_1">{{$v->id}}</td> 
	         <td>{{$v->nickname}}</td> 
	         <td>{{$v->ptitle}}</td> 
	         <td>{{$v->pctime}}</td>
	         <td>{{$v->click}} 次</td>
	         <td>{{$v->creply=='0'? '是':'否'}}</td>
	         <td>

	         	<a href="/admin/card/update?id={{$v->id}}">修改主贴</a> |
	         	<a href="/admin/card/huifu?id={{$v->id}}" class="huifu" sid="{{$v->id}}" data='n'>恢复帖子</a> |
	         	<a href="/admin/card/del?id={{$v->id}}" class="del" sid="{{$v->id}}">删除帖子</a>
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
	  </div> 
	  </div>
	  <!-- /.box-body -->
@endsection
@section('js')
<!-- ajax恢复帖子 -->
<script type="text/javascript">
	
	//给所有的删除链接绑定事件
	$('.huifu').click(function(){
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
	  $.post('/admin/card/dorecycle',{id:id,recycle:recycle},function(data){
	      if(data == 1){
	        //获取提醒信息
	        $('#successMessage').text('帖子恢复成功').show(1000);
	        setTimeout(function(){
	          $('#successMessage').hide(1000);
	        },2000);
	        links.parents('tr').remove();
	      }
	  });

	  return false;
	})
</script>
<!-- ajax删除帖子 -->
<script type="text/javascript">
	
	//给所有的删除链接绑定事件
	$('.del').click(function(){
	  //获取id
	  var id = $(this).attr('sid');
	  var links = $(this);

	  $.ajaxSetup({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	  });

	  //发送ajax
	  $.post('/admin/card/del',{id:id},function(data){
	      if(data == 1){
	        //获取提醒信息
	        $('#successMessage').text('帖子删除成功').show(1000);
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