@extends('bz.layout.index')
@section('title','帖子详情页')
@section('header','帖子详情页')
@section('path','帖子详情页')
@section('con')
<br><br>
  <div class='box box-success'>
  <div class="box-header ui-sortable-handle" style="cursor: move;">
    <i class="fa fa-comments-o"></i>

    <h3 class="box-title">{{$card[0]->ptitle}}  [所属板块：{{$card[0]->tname}}]</h3>

    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
      
    </div>
  </div>
  <div class="slimScrollDiv" style="position: relative; width: auto; height: auto;">
  <div class="box-body chat" id="chat-box" style="width: auto; height: auto;">
    <!-- chat item -->
    <div class="item">
      <img src="/admincss/dist/img/user4-128x128.jpg" alt="user image" class="online">

      <p class="message">
        <a href="#" class="name">
          <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{date("Y-m-d H:i:s",$card[0]->pctime)}}</small>
          {{$card[0]->nickname}}
        </a>
        {{$card[0]->pcontent}}	
      </p>
		
	@foreach($reply as $k=>$rv)
      <div class="attachment">
        <h4>{{$rv->nickname}}</h4>

        <p class="filename" style="margin-top:10px;">
          {{$rv->rcontent}}

        </p>

        <div class="pull-right">
          <button ajax='delReply' type="button" class="btn btn-danger btn-sm btn-flat" rid="{{$rv->id}}">删除回复</button>
        </div>
      </div>
	  <br>
	@endforeach

    </div>
    <!-- /.item -->
  </div><div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 187.126px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;"></div></div>
  <!-- /.chat -->
  <div class="box-footer">
    <div class="input-group">

      <div class="input-group-btn">
        <button type="button" class="btn btn-block btn-info btn-lg" onclick="javascript:document.getElementById('here').scrollIntoView()">回到顶部</button>
      </div>
    </div>
  </div>
  </div>
@endsection
@section('js')
<!-- ajax删除回复 -->
<script type="text/javascript">

	//给所有的删除链接绑定事件
	$("[ajax='delReply']").click(function(){
	  //获取id
	  var id = $(this).attr('rid');
	  var links = $(this);

	  $.ajaxSetup({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	  });

	  //发送ajax
	  $.post('/bz/card/delreply',{id:id},function(data){
	      if(data == 1){
	        //获取提醒信息
	        $('#successMessage').text('回复删除成功').show(1000);
	        setTimeout(function(){
	          $('#successMessage').hide(1000);
	        },2000);
	        links.parent('div').parent('div').remove();
	      }
	  });

	  return false;
	})
</script>
@endsection