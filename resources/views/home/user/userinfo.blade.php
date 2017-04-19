@extends('home.layout.index')
@section('con')
@section('bt')
<title>个人中心</title>
@endsection
<div class="users-show  row">
        <div class="col-md-3"> 
          <div class="box"> 
     				<div class="padding-sm user-basic-info"> 
      					<div style=""> 
       						<div class="media"> 
        						<div class="media-left"> 
         							<div class="image"> 
          								<a href="/home/user/changephoto" class="popover-with-html" data-content="修改头像"> <img class="media-object avatar-112 avatar img-thumbnail" src="{{$resm['0']->photo}}" /> </a> 
         							</div> 
        						</div> 
	        					<div class="media-body"> 
	         						<h4 class="media-heading" {{$resm[0]->vip =='y' ? "style=color:red" : "" }}> {{$resm['0']->nickname}} </h4> 
                      <div class="item"> </div> 
                      <div class="item">
                          第 {{$resm['0']->uid}} 位会员 
                      </div>  
                      <div class="item number">
                          活跃于 <span class="timeago">{{date('Y-m-d H:i:s',$resn['0']->lastlogin)}}</span> 
                      </div> 
                    </div> 
                  </div> 
                </div> 
                <hr/> 
                <div class="follow-info row"> 
                  <div class="col-xs-6"> 
                    <a class="counter" > {{$resm['0']->integral}} </a> 
                    <a class="text" >积分</a> 
                  </div> 
                </div> 
                @if($resm['0']->content)
                <div class="follow-info row"> 
                  <div class="col-xs-6">
                    <a class="text" >个人介绍</a>
                    <a class="counter" style="word-break:break-all;text-align:left;"  > {{$resm['0']->content}} </a> 
                  </div> 
                </div> 
                @endif
                <hr/> 
                <div class="topic-author-box text-center"> 
                  <ul class="list-inline"> </ul> 
                </div> 
                <a class="btn btn-primary btn-block" href="/home/user/information" id="user-edit-button"> 
                  <i class="fa fa-edit"></i> 编辑个人资料 
                </a>
                @if(($resn[0]->shenqing)=='n')
                <a class="btn btn-success btn-block" href="/home/user/bz" id="user-edit-button"> 
                  <i class="fa fa-send"></i> 申请为管理员 
                </a>
                @endif
                @if(($resn[0]->moderator)=='y')
                 <a class="btn btn-success btn-block" href="/bz" id="user-edit-button"> 
                  <i class="fa fa-home"></i> 登录后台 
                </a>
                @endif
            </div> 
          </div> 
        </div> 
        <div class="main-col col-md-9 left-col"> 
          <div class="panel panel-default"> 
            <div class="panel-heading">
                我的发帖 
            </div>
            <div class="jscroll">
        <div class="panel-body remove-padding-horizontal">
            <ul class="list-group row topic-list">
    <?php if($posts!=0){ ?>
    @foreach($post as $k=>$v)
  
 <li class="list-group-item ">
      <!-- 帖子详情 -->

     
      <a class="reply_count_area hidden-xs pull-right" href="">
           <div class="count_set">
               <span class="count_of_visits" title="查看数">
                 {{$v->click}}
               </span>
               <span class="count_seperator">|</span>
                                                                 
                <abbr title="{{date('Y-m-d h:i:s',$v->pctime)}}" class="timeago">{{date('Y-m-d H:i:s',$v->pctime)}}</abbr>
           </div>
      </a>
      <div class="infos">

        <div class="media-heading">

               <span class="hidden-xs label label-warning">{{ ($v->elite)=='n' ? '' : '加精' }}</span>
               <span class="hidden-xs label label-success">{{ ($v->top)=='n' ? '' : '置顶' }}</span>
          <!-- 帖子连接 -->
          <a class="author" href="/home/card/details?id={{$v->id}}" title="{{$v->ptitle}}">
            {{$v->ptitle}}
          </a>
        </div>
          <a href="/home/card/delpost?id={{$v->id}}"  style="Float:right">删除</a>

      </div>
  </li>
  @endforeach
  <?php if($postss>5){ ?>
  <div class="panel-footer text-right">
  <!-- 所有发帖 -->
    <a href="/home/user/allft" class="more-excellent-topic-link">
        查看全部发帖 
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </a>
  </div>
  <?php } ?>
  <?php }else{   ?>
    <div id="replies-empty-block" class="empty-block">暂无帖子~~</div>
  <?php } ?>
        </ul>
        </div>
    </div> 
    <div>
    <div class="col-xs-8"></div>
    </div>

                <div class="empty-block"> 
                  <a href="/home/card/posted" class="btn btn-primary no-pjax"> <i class="fa fa-paint-brush" aria-hidden="true"></i> 创作文章 </a> 
                </div> 
        
            
          </div> 
          <div class="panel panel-default"> 
            <div class="panel-heading">
                我的回帖 
            </div>


            <div class="jscroll">
        <div class="panel-body remove-padding-horizontal">
            <ul class="list-group row topic-list">
    <?php if($replys!=0){ ?>
    @foreach($reply as $k=>$v)

 <li class="list-group-item ">
      <!-- 帖子详情 -->
      <a class="reply_count_area hidden-xs pull-right" href="">
           <div class="count_set">
               <span class="count_of_visits" title="查看数">
                 {{$v->click}}
               </span>
               <span class="count_seperator">|</span>
                                                                 
                <abbr title="{{date('Y-m-d h:i:s',$v->pctime)}}" class="timeago">{{date('Y-m-d H:i:s',$v->pctime)}}</abbr>
           </div>
      </a>
      <div class="infos">

        <div class="media-heading">

               
          <!-- 帖子连接 -->
          <a href="/home/card/details?id={{$v->id}}" title="{{$v->ptitle}}">
            {{$v->rcontent}}
          </a>

        </div>

      </div>
  </li>
  @endforeach
  <?php if($replyss>5){ ?>
  <div class="panel-footer text-right">
    <a href="/home/user/allht" class="more-excellent-topic-link">
        查看全部回帖 
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </a>
  </div>
  <?php } ?>
  <?php }else{   ?>
    <div id="replies-empty-block" class="empty-block">暂未回帖~~</div>
  <?php } ?>
        </ul>
        </div>
    </div> 
    <div>
    <div class="col-xs-8"></div>
    </div>


          </div> 
          <div class="panel panel-default"> 
            <div class="panel-heading">
                我的收藏
            </div> 
            <div class="jscroll">
        <div class="panel-body remove-padding-horizontal">
            <ul class="list-group row topic-list">
            <?php if($pls!=0){ ?>
    @foreach($pl as $k=>$v)

 <li class="list-group-item ">
      <a class="reply_count_area hidden-xs pull-right" href="/home/card/qxsc?id={{$v->id}}">
           <div class="count_set">
               <span class="count_of_visits">
                 取消收藏
               </span>
           </div>
      </a>

      <div class="infos">

        <div class="media-heading">

              
          <!-- 帖子连接 -->
          <a href="/home/card/details?id={{$v->id}}" title="">
            {{$v->ptitle}}
          </a>

        </div>

      </div>
  </li>
  @endforeach
  <?php if($plss>5){ ?>
  <div class="panel-footer text-right">
    <a href="/home/user/allsc" class="more-excellent-topic-link">
        查看全部收藏
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </a>
  </div>
  <?php } ?>
  <?php }else{   ?>
    <div id="replies-empty-block" class="empty-block">暂无收藏~~</div>
  <?php } ?>
        </ul>
        </div>
    </div> 
    <div>
    <div class="col-xs-8"></div>
    </div> 
          </div> 
        </div> 
      </div>
      </div>
@endsection