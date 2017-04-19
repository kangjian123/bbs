@extends('home.layout.index')
@section('title', '用户登录')
@section('con')
@section('bt')
<title>登录</title>
@endsection
	  	<div class="col-md-4 col-md-offset-4 floating-box"> 
	   		<div class="panel panel-default"> 
	    		<div class="panel-heading"> 
	     			<h3 class="panel-title">请登录</h3> 
	    		</div> 
		    	<div class="panel-body"> 
				    <form method="POST" action="{{url('/home/user/userinfo')}}" accept-charset="UTF-8"> 
				      	<div class="form-group "> 
				      		<label class="control-label" for="username">用户名</label> 
				       		<input class="form-control" name="username" type="text" value="" required placeholder="请填写 用户名" /> 
				      	</div> 
				      	<div class="form-group "> 
				       		<label class="control-label" for="password">密 码</label> 
				       		<input class="form-control" name="password" type="password" value="" required placeholder="请填写密码" /> 
				      	</div> 
				      	<div class="form-group ">
		                  <label class="control-label" for="code">验证码</label>&nbsp;
		                  <img src="/homecss/code/code.php" onclick="this.src='/homecss/code/code.php?id='+Math.random(0,1);"/>  
		                  <input class="form-control" name="code" type="text"required value="" placeholder="请填写 验证码" /> 
				      	</div>
				      	<button type="submit" class="btn btn-lg btn-success btn-block"><i class="fa fa-btn fa-sign-in"></i> 登录 </button> 
				      	<hr/> 
				      	<fieldset class="form-group"> 
				       	<div class="alert alert-info">使用以下方法注册或登录。</div>
						{{ csrf_field() }}
				       	<a class="btn btn-lg btn-default btn-block" id="login-required-submit" href="/home/user/register"><i class="fa fa-linkedin-square"></i> 加入我们</a> 
				       	<a class="btn btn-lg btn-default btn-block" id="login-required-submit" href=""><i class="fa fa-github-alt"></i> GitHub 登录</a> 
				       	<a class="btn btn-lg btn-default btn-block" href=""> <i class="fa fa-weixin"></i> 使用微信登录</a> 
				      	</fieldset> 
				     </form> 
		    	</div> 
	   		</div> 
	  	</div>
	  	</div>

@endsection