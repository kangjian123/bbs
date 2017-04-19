@if(session('uid'))
  @section('dl')
    <ul class="nav navbar-nav github-login">
      <li class="">
        <a aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" type="button" href="#">
          <i class="fa fa-plus text-md"></i>
        </a>
        <ul aria-labelledby="dLabel" class="dropdown-menu">
          <li>
            <a href="/home/card/posted" class="button no-pjax">
                <i class="fa fa-paint-brush text-md"></i> 创作文章
            </a>
          </li>
        </ul>
      </li>

      <li class="">
        <a id="dLabel" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" type="button" href="#" >
          <img src="{{$resm['0']->photo}}" alt="" class="avatar-topnav" >
            <span {{$resm[0]->vip =='y' ? "style=color:red" : "" }}>{{$resm['0']->nickname}}</span>
          <span class="caret"></span>
        </a>

        <ul aria-labelledby="dLabel" class="dropdown-menu">
          <li>
            <a href="/home/user/userinfo" class="button">
              <i class="fa fa-user text-md"></i> 个人中心
            </a>
          </li>
          <li>
            <a href="/home/user/information" class="button">
              <i class="fa fa-cog text-md"></i> 编辑资料
            </a>
          </li>
          <li>
            <a href=" {{url('/home/user/exit')}} " class="button" id="login-out" data-lang-loginout="你确定要退出吗?" >
              <i class="fa fa-sign-out text-md"></i> 退出
            </a>
          </li>
        </ul>
      </li>
    </ul>
  @endsection
@else
  @section('dl')
    <ul class="nav navbar-nav github-login">
      <a href="/home/user/login" class="btn btn-primary login-btn">
        <i class="fa fa-user"></i>
          登 录
      </a>
    </ul>
  @endsection
@endif