<!DOCTYPE html>

<html lang="zh">
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

      @section('bt')
      <title>帖子列表</title>
      @show 
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

      <link rel="stylesheet" href="/homecss/css/styles-2bd546149e.css">
      <link rel="shortcut icon" href="">

      <meta http-equiv="x-pjax-version" content="/homecss/css/styles-2bd546149e.css">
    </head>
    <body id="body" class="home">

            <div id="wrap">

      <div role="navigation" class="navbar navbar-default topnav">
        <div class="container">
           <div class="navbar-header">

              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

              <a href="" class="navbar-brand">
                  <!-- 网站logo -->
                  <!-- <img src="" alt="Laravel China"> -->
              </a>
           </div>

        <div id="top-navbar-collapse" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class=""><a href="/">主页</a></li>
            <li class=""><a href="/home/card/elite">精品</a></li>
            <li class=""><a href="/home/card/zero">无人问津</a></li>
            <li><a href="/home/user/vip" class="no-pjax" target="_blank">成为会员</a></li>
            <li class=""><a href="javascript:;" class="toolsbar" id="addFavorite" onclick="addFavorite(this);">加入收藏</a></li>
          </ul>

          <div class="navbar-right">

            <form method="GET" action="{{url('/home/card/search')}}" accept-charset="UTF-8" class="navbar-form navbar-left">
              <div class="form-group">
               <input class="form-control search-input mac-style" placeholder="搜索" name="keyword" type="text" value="">
    
            </div>
            </form>
            
          {!! \App\Http\Controllers\home\UserController::hea() !!}
          <!-- 登陆后的显示-->
              @section('dl')
              @show

          </div>
        </div>

       </div>
      </div>

      <div id="tishi" class="alert alert-info alert-dismissable" style="display:none">
      <!-- 提示滚去登录 -->

      </div>

     <div class="container main-container ">
     @section('error')
        @if(session('error'))
          <div class="alert alert-danger "style="display:none">
              {{session('error')}}
          </div>
        @endif
     @show
        @if(session('success'))
          <div class="alert alert-success "style="display:none">
              {{session('success')}}
          </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger"style="display:none">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    

    @section('con') 
                    
               	<!--  网站介绍  -->
    <div class="box text-center site-intro rm-link-color">
       网站介绍
    </div>

    <div class="row grid topbanner">
      <div class="col-md-3 col-sm-6 col-xs-6 projects-card grid-item">
        <div class="thumbnail">
          <a href="" class="no-pjax">
          	<!-- 板块logo -->
            <img src="">
          </a>
         <div class="caption">
           <h3 style="font-size:1.1em;font-weight:bord" class="card-title">
	          <!-- 板块标题 -->
            <a href="/home/card/details" class="no-pjax">板块标题</a>
          </h3>
             <!-- 板块简介 -->
           <p class="card-description hidden-xs">板块简介</p>
         </div>
        </div>
      </div>
      </div>
      <!-- 原网页有12个 -->
      <div class="panel panel-default list-panel home-topic-list">
        <div class="panel-heading">
          <h3 class="panel-title text-center">
            精华帖 
          </h3>
        </div>

        <div class="panel-body ">
          <ul class="list-group row topic-list">
                  <li class="list-group-item media col-md-6" style="margin-top: 0px;">
                    <!-- 点击赞 或者回复 会跳转到此贴 -->
                   <a class="reply_last_time hidden-xs meta" href="">
                       X 点赞
                       <span> ⋅ </span>
                       X 回复
                    </a>

                  <div class="avatar pull-left">
                    <!-- 点击头像进入这个人的资料 -->
                      <a href="">
                      		<!-- 用户id  头像 -->
                          <img class="media-object img-thumbnail avatar avatar-middle" alt="" src="">
                      </a>
                  </div>

                  <div class="infos">

                    <div class="media-heading">
      										<!-- 加精或置顶 -->
                                          <span class="hidden-xs label label-default">加精或置顶</span>
                      <!-- 帖子简介 -->
                      <a href="" title="">
                          帖子简介
                      </a>
                    </div>

                  </div>

              </li>
          </ul>

        </div>
        <div class="panel-footer text-right">
      	<!-- 所有精华帖 -->
          <a href="" class="more-excellent-topic-link">
              查看更多精华帖 
          </a>
        </div>
      </div>
      </div>
       @show

      {!! \App\Http\Controllers\home\HomeController::foot() !!}
          <script type="text/javascript" src="/homecss/js/scripts-1adf94fbb7.js"></script>
         <script src="/homecss/bower_components/jquery/dist/jquery.min.js"></script>
         <script type="text/javascript">
         //设置提示信息2秒后隐藏
         $(function(){
          $('.alert-success').show(1000);
          $('.alert-danger').show(1000);
          setTimeout(function(){
            $('.alert-success').hide(1000);
            $('.alert-danger').hide(1000);
          },2200)
        })

        //加入收藏函数
        function addFavorite(obj) {
            var aUrls = document.URL.split("/");
            var vDomainName = "http://" + aUrls[2] + "/";
            var description = obj.title;
            try {//IE
                window.external.AddFavorite(vDomainName, description);
            } catch (e) {//Firefox
                window.sidebar.addPanel(description, vDomainName, "");
            }
            return false; //阻止a标签继续执行
        }
         </script>
        
            @section('js')
              
            @show
      </div>

    </body>
</html>
