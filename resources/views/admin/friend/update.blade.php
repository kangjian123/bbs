@extends('admin.layout.index')
@section('title','友情链接修改')
@section('header','友情链接修改')
@section('path','友情链接修改')
@section('con')
<br><br>
<div class="box box-solid" style="width:40%;margin:0 auto;">
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
	<form action="/admin/friend/doupdate" method="post">
		<div class="box-header with-border">
			<i class="fa fa-text-width"></i>

			<h3 class="box-title"><input type="text" name="fname" value="{{$info->fname}}"></h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<small>当前状态：<cite title="Source Title">{{$info->open=='y'?'开启':'关闭'}}</cite></small>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<blockquote>
				<p><textarea name="flink" cols="60" rows="5" style="resize: none;">{{$info->flink}}</textarea></p>
			</blockquote>
			<hr>
				<!-- <div style="float:left;"><button>123</button></div>
				<div><button>123</button></div>
				<div><button>123</button></div> -->
				
				<input type="hidden" name='id' value='{{$info->id}}'>
				<p><button id="hiddensession" type="submit" class="btn btn-block btn-success btn-lg" style="width:10%;float:left;margin-left:350px;">修改</button></p>
				<p><button type="reset"class="btn btn-block btn-info btn-lg" style="width:10%;float:left;margin-left:20px;">重置</button></p>
				<p><button class="btn btn-block btn-danger btn-lg" style="width:10%;float:left;margin-left:20px;" onclick="javascript:window.history.back(-1);">离开</button></p>
		</div>
		{{ csrf_field() }}
	</form>
		<!-- /.box-body -->


</div>
@endsection