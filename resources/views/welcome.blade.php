@extends('home.index')
@section('bt')
     <title>{{$configtitle['0']->configtitle}}</title>
@endsection

@section('con')
@section('friend')
@show
<!--  网站介绍  -->
<div class="box text-center site-intro rm-link-color">
 欢迎来到本论坛,在论坛里你可以畅所欲言! 
</div>
<div class="row grid topbanner">
<!-- 遍历板块 -->
@foreach($type as $kk=>$vv)      
               <div class="col-md-3 col-sm-6 col-xs-6 projects-card grid-item">
              <div class="thumbnail">
                  <a href="home/card/card?id={{$vv->id}}" class="no-pjax">
                      <!-- 板块logo -->
                      <img src="{{$vv->tlogo}}">
                  </a>
                <div class="caption">
                  <h3 style="font-size:1.1em;font-weight:bord" class="card-title">
          <!-- 板块标题 -->
                  <a href="home/card/card?id={{$vv->id}}" class="no-pjax">{{$vv->tname}}</a></h3>
                  <!-- 板块简介 -->
                  <p class="card-description hidden-xs">{{$vv->tcontent}}</p>
                </div>
              </div>
            </div>
  @endforeach
            </div>
<!-- 原网页有12个 -->
<div class="panel panel-default list-panel home-topic-list">
  <div class="panel-heading">
    <h3 class="panel-title text-center">
      精华帖
      <a style="color: #E5974E; font-size: 14px;" target="_blank">
      <i class="fa fa-rss"></i> 
    </h3>

  </div>
  <div class="panel-body ">
    <ul class="list-group row topic-list">

  <!-- 遍历帖子 -->
@foreach($post as $k=>$v)
            <li class="list-group-item media col-md-6" style="margin-top: 0px;">
              <!-- 点击赞 或者回复 会跳转到此贴 -->
             <a class="reply_last_time hidden-xs meta" href="">
                 {{$v->click}} 访问
              </a>
            <div class="avatar pull-left">
              <!-- 点击头像进入这个人的资料 -->
                <a href="/home/user/otheruserinfo?id={{$v->uid}}" title="{{$v->nickname}}">
                    <!-- 用户id  头像 -->
                    <img class="media-object img-thumbnail avatar avatar-middle" alt="" src="{{$v->photo}}">
                </a>
            </div>

            <div class="infos">

              <div class="media-heading">
          <!-- 加精或置顶 -->
                <span class="hidden-xs label label-warning">{{ ($v->elite)=='n' ? '' : '加精' }}</span>
                <span class="hidden-xs label label-success">{{ ($v->top)=='n' ? '' : '置顶' }}</span>
                <!-- 帖子简介 -->
                <a href="/home/card/details?id={{$v->id}}" title="{{$v->ptitle}}">
                    {{$v->ptitle}}
                </a>
              </div>

            </div>

        </li>
@endforeach
    </ul>

  </div>
  <div class="panel-footer text-right">
  <!-- 所有精华帖 -->
    <a href="/home/card/elite" class="more-excellent-topic-link">
        查看更多精华帖 
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </a>
  </div>
</div>
</div>
@endsection

