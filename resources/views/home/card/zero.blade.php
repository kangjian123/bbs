@extends('home.layout.index')
@section('bt')
<title>无人问津</title>
@endsection
@section('con')
<div class="col-md-8 topics-index main-col">

<div class="panel panel-default">

<div class="panel-heading">

  <ul class="list-inline topic-filter ">
        <li class="popover-with-html" data-content="最后发布的帖子"><a class="active">无人问津</a></li>
    </ul>

  <div class="clearfix"></div>
</div>
    <div class="jscroll">
        <div class="panel-body remove-padding-horizontal">
            <ul class="list-group row topic-list">
             <ul class="list-group row"></ul>

<?php  if($num != 0){ ?>
           @foreach($post as $k=>$v)
 <li class="list-group-item ">
      <!-- 帖子详情 -->
      <a class="reply_count_area hidden-xs pull-right" href="/home/card/details?id={{$v->id}}">
           <div class="count_set">
               <span class="count_of_visits" title="查看数">
                 {{$v->click}}
               </span>
               <span class="count_seperator">|</span>
                                                                 
                <abbr title="{{date('Y-m-d h:i:s',$v->pctime)}}" class="timeago">{{date('Y-m-d H:i:s',$v->pctime)}}</abbr>
           </div>
      </a>

      <div class="avatar pull-left">
      <!-- 头像连接 -->
          <a href="/home/user/otheruserinfo?id={{$v->uid}}" title="">
          <!-- 头像地址 -->
              <img class="media-object img-thumbnail avatar avatar-middle" alt="" src="{{$v->photo}}"/>
          </a>
      </div>

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
        </div>
            </ul>

        </div>


      </div>
    <div>
    <div class="col-xs-8"></div>
  </div>

    <!-- Nodes Listing -->
    
</div>
<div class="col-md-3 side-bar">

{!! \App\Http\Controllers\home\HomeController::ad() !!}

</div>


@endsection