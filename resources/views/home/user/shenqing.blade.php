@extends('home.layout.index')
@section('con')
@section('bt')
<title>申请</title>
@endsection
<table class="table  table-hover">
      <caption>论坛注意事项</caption>
      <thead>
        <tr>
          <th>您当前的积分为:{{$integral}}</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">注意事项：</td>
        </tr>
        <tr>
          <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;第一，必须支持和热爱论坛，有责任感，能与论坛荣誉与共，为论坛和会员们付出的精神。</td>
        </tr>
        <tr>
          <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;第二，积极参与和支持论坛的活动。并能积极，正确，文明，理性的发贴回贴。</td>
        </tr>
        <tr>
          <th scope="row">&nbsp;&nbsp;&nbsp;&nbsp;申请成功后可至<a href="/bz">这里</a>登陆进行帖子管理</td>
        </tr>
        <tr>
          <th scope="row">若同意以上条件，请点击'我要申请按钮'</td>
        </tr>
        <tr>
        	<th>
      			<a href="/" style="text-decoration:none;color:#333;"><button class="btn btn-default">back</button></a>
        		<a href="/home/user/shenqing" style="text-decoration:none;color:#333;"><button class="btn btn-info">我要申请</button></a>
      		</th>
        </tr>
      </tbody>
      
    </table>
    </div>
@endsection