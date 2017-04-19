@extends('home.layout.index')
@section('con')
@section('bt')
<title>{{$resm['0']->nickname}} 的个人信息</title>
@endsection
<div class="users-show  row">
        <div class="col-md-3"> 
          <div class="box"> 
            <div class="padding-sm user-basic-info"> 
                <div style=""> 
                  <div class="media"> 
                    <div class="media-left"> 
                      <div class="image"> 
                           <img class="media-object avatar-112 avatar img-thumbnail" src="{{$resm['0']->photo}}" /> </a> 
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
            </div> 
          </div> 
        </div> 
        <div class="main-col col-md-9 left-col"> 
          <div class="panel panel-default"> 
            <div class="panel-heading">
                他的最新发帖 
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
          <a href="/home/card/details?id={{$v->id}}" title="{{$v->ptitle}}">
            {{$v->ptitle}}
          </a>

        </div>

      </div>
  </li>
  @endforeach
  <?php }else{   ?>
    <div id="replies-empty-block" class="empty-block">暂无帖子~~</div>
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
                他的最新回帖 
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

               <span class="hidden-xs label label-warning">{{ ($v->elite)=='n' ? '' : '加精' }}</span>
               <span class="hidden-xs label label-success">{{ ($v->top)=='n' ? '' : '置顶' }}</span>
          <!-- 帖子连接 -->
          <a href="/home/card/details?id={{$v->id}}" title="{{$v->ptitle}}">
            {{$v->rcontent}}
          </a>

        </div>

      </div>
  </li>
  @endforeach
  <?php }else{   ?>
    <div id="replies-empty-block" class="empty-block">暂无帖子~~</div>
  <?php } ?>
        </ul>
        </div>
    </div> 
    <div>
    <div class="col-xs-8"></div>
    </div>


          </div> 
          <div class="panel panel-default"> 
            <div class="panel-heading">他的最新收藏
            </div> 
            <div class="jscroll">
        <div class="panel-body remove-padding-horizontal">
            <ul class="list-group row topic-list">
            <?php if($pls!=0){ ?>
    @foreach($pl as $k=>$v)

 <li class="list-group-item ">
      <!-- 帖子详情 -->
      <a class="reply_count_area hidden-xs pull-right" href="">
           <div class="count_set"></div>
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