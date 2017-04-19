@extends('home.layout.index')
@section('con')
@section('bt')
<title>修改头像</title>
@endsection
  		<div class="users-show"> 
   			<div class="col-md-3 main-col "> 
    			<div class="box"> 
     				<div class="padding-md "> 
      					<div class="list-group text-center"> 
       						<a href="/home/user/information" class="list-group-item "> <i class="text-md fa fa-list-alt" aria-hidden="true"></i> &nbsp;个人信息 </a> 
                  <a href="/home/user/changephoto" class="list-group-item active"> <i class="text-md fa fa-picture-o" aria-hidden="true"></i> &nbsp;修改头像 </a> 
                  <a href="/home/user/changepass" class="list-group-item "> <i class="text-md fa fa-lock" aria-hidden="true"></i> &nbsp;修改密码 </a> 
				      	</div> 
     				</div> 
    			</div> 
   			</div> 
   			<div class="main-col col-md-9 left-col"> 
    			<div class="panel panel-default padding-md"> 
     				<div class="panel-body padding-bg"> 
      					<h2><i class="fa fa-picture-o" aria-hidden="true"></i> 请选择图片</h2> 
      							<hr/> 
      					<form method="POST" action="{{url('/home/user/changephoto')}}" enctype="multipart/form-data" accept-charset="UTF-8"> 
       						<div id="image-preview-div"> 
        						<label for="exampleInputFile">请选择图片：</label> 
        						<br/> 
        						<img id="preview-img" class="avatar-preview-img" src="" /> 
       						</div> 
       						<div class="form-group"> 
        						<input type="file" name="photo" id="file" required="" /> 
       						</div> 
       						<br/> 
       						<button class="btn btn-lg btn-primary" id="upload-button" >上传头像</button> 
                  {{ csrf_field() }}
      					</form> 
     				</div> 
    			</div> 
        </div> 
   			</div> 
  		</div>
@endsection