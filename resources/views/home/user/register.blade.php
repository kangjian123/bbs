@extends('home.layout.index')
@section('title', '用户注册')
@section('con')
@section('bt')
<title>注册</title>
@endsection
  		<div class="col-md-4 col-md-offset-4"> 
   			<div class="panel panel-default"> 
    			<div class="panel-heading"> 
    	 			<h3 class="panel-title">创建新账号</h3> 
    			</div> 
    			<div class="panel-body"> 
     				<form method="POST" action="{{url('/home/user/regist')}}" accept-charset="UTF-8"> 
      					<div class="form-group "> 
					       	<label class="control-label" for="username">用户名</label> 
					       	<input class="form-control" name="username" type="text"required value="" placeholder="请填写 3-8位用户名" /> 
				      	</div> 
      					<div class="form-group "> 
					       	<label class="control-label" for="email">邮 箱</label> 
					       	<input class="form-control" name="email" type="text"required value="" placeholder="请填写 邮箱" /> 
				      	</div> 
      					<div class="form-group "> 
					       	<label class="control-label" for="password">密 码</label> 
					       	<input class="form-control" name="password" type="password" required value="" placeholder="请填写 6-18位密码" /> 
      					</div> 
				      	<div class="form-group "> 
                  <label class="control-label" for="surepassword">确认密码</label> 
                  <input class="form-control" name="surepassword" type="password"required value="" placeholder="请填写 6-18位确认密码" /> 
                </div>
                <div class="form-group ">
                  <label class="control-label" for="code">验证码</label>&nbsp;
                  <img src="/homecss/code/code.php" onclick="this.src='/homecss/code/code.php?id='+Math.random(0,1);" />  
                  <input class="form-control" name="code" type="text"required value="" placeholder="请填写 验证码" /> 
				      	</div>
                
      					<input class="btn btn-lg btn-success btn-block" type="submit" value="确 定" /> 
                {{ csrf_field() }}
     				</form> 
    			</div> 
   			</div> 
      </div>
  		</div>
@endsection