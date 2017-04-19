@extends('home.layout.index')
   @section('bt')
      <title>{{$post['0']->ptitle}}</title>
      @show
@section('con')

<div class="container main-container ">     
<div class="col-md-9 topics-show main-col">
  <!-- Topic Detial -->

  <div class="topic panel panel-default">
    <div class="infos panel-heading">
      <h1 class="panel-title topic-title">{{$post['0']->ptitle}}</h1>
      <div class="meta inline-block" >
  <a class="remove-padding-left">
    <i class="fa fa-folder text-md" aria-hidden="true"></i>{{$typename->tname}}
  </a>
  ⋅
  <a class="author" {{$post[0]->vip =='y' ? "style=color:red" : "" }}>
  {{$post['0']->nickname}}
  </a>
  于 <abbr title="2017-03-20 11:12:44" class="timeago">{{date('Y-m-d H:i:s',$post['0']->pctime)}}</abbr>
  
 {{$post['0']->click}} 阅读

</div>
<div class="clearfix"></div>
    </div>

    <div class="content-body entry-content panel-body ">

        <div class="markdown-body" id="emojify">

        {!! $post['0']->pcontent !!}

        </div>
    </div>
  </div>
  <!-- 收藏开始 -->
  <div class="votes-container panel panel-default padding-md">

      <div class="panel-body vote-box text-center">

          <div class="btn-group">
          <!-- disabled="disabled"  -->
              <a uid="{{$sid}}" pid="{{$postid = $posts[0]->id}}" data-ajax="post" href="" data-url="" title=""  style="" data-content="点赞相当于收藏，可以在个人页面的「赞过的话题」导航里查看" id="up-vote" class="vote btn btn-primary cang" data-original-title="Up Vote">
                  <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                  收藏本帖
              </a >
          </div>

          <div class="voted-users">
              <div class="user-lists">
              @if(empty($person))
              <div id='hshshs'>暂时还没有人关注。</div>
              @else

              @foreach($person as $k => $v)
                <a href="/home/user/otheruserinfo?id={{$v->uid}}" data-userid="uid">
                  <img class="img-thumbnail avatar avatar-middle" src="{{$v->photo}}" style="width:48px;height:48px;">
                </a>
              @endforeach
              @endif
              </div>
          </div>

      </div>
    </div>
  <!-- 收藏结束 -->


  <!-- Reply List -->
  <div class="replies panel panel-default list-panel replies-index" id="replies">

    <div class="panel-heading">
        <div class="total">回复数量: <b>{{ $replynum }}</b> </div>
    </div>
<!-- 这里面 -->
@if($replynum!==0)
    <div class="panel-body">
      <ul class="list-group row">

                                                                              
                                                                             
        @foreach($reply as $keys=>$values)
         <li class="list-group-item media" style="margin-top: 0px;">
          <div class="avatar avatar-container pull-left">
            <a href="/home/user/otheruserinfo?id={{$values->uid}}">
                      <!--  回帖用户头像 -->
              <img class="media-object img-thumbnail avatar avatar-middle" alt="{{$values->nickname}}" src="{{$values->photo}}"  style="width:55px;height:55px;"/>
            </a>  
          </div>

          <div class="infos">

            <div class="media-heading">
            
              <a href="/home/user/otheruserinfo?id={{$values->uid}}" title="{{$values->nickname}}" class="remove-padding-left author" {{$values->vip =='y' ? "style=color:red" : "" }} >
                 {{$values->nickname}}
              </a>

              <div class="meta">
                <a name="reply21888" id="reply21888" class="anchor" href="#reply21888" aria-hidden="true">#{{$keys+1}}</a>

                  <span> ⋅  </span>
                  <abbr class="timeago" title="2017-03-20 12:39:46">{{date('Y-m-d H:i:s',$values->rctime)}}</abbr>
                                                          
               </div>   
               
              </div>
              <?php if($values->uid == $sid){ ?>
                <a href="/home/card/del?id={{$values->id}}" style="display:block;Float:right">删除</a>
                <?php }else{ ?>
                
                <?php } ?>
            <div class="media-body markdown-reply content-body">
              <p>{{$values->rcontent}}</p>
            </div>

          </div>

        </li>
        
        <a name="last-reply" class="anchor" href="#last-reply" aria-hidden="true"></a>
            
        @endforeach
      {!! $reply->appends(['id'=>$id])->render() !!}
      </ul>
        
    </div>
    @else
    <div class="panel-body">

              <ul class="list-group row"></ul>
        <div id="replies-empty-block" class="empty-block">暂无评论~~</div>
      
      <!-- Pager -->
      <div class="pull-right" style="padding-right:20px">
        
      </div>
    </div>


    @endif
<!-- 到这里 -->
<!-- 判断是否有回帖 -->
  </div>

  <!-- Reply Box -->
  <div class="reply-box form box-block">

    
    <form method="post" action=" {{url('/home/card/reply')}}" validator(); id="reply" name="reply">

        <div class="form-group">
    
            <textarea class="form-control"  id="textarea" rows="5" name="body" cols="50" style="resize:none" ></textarea>
            <input type="hidden" name="id" value="{{$posts['0']->id}}">

        </div>
        <li style="list-style-type:none;" id="xx"></li>
        <div class="form-group reply-post-submit" >
            <button class="btn btn-primary" id="displayBtn" >回复</button>
        </div>
      {{ csrf_field() }}  

    </form>
  </div>

</div>

<script type="text/javascript">
      var textarea = document.getElementById('textarea');

        var oBtn = document.getElementById('displayBtn');
       if('{{$status}}'!='0'){
          oBtn.disabled = 'disabled';
          textarea.disabled="readonly";
          textarea.innerHTML = '您已被禁言';
        };

        if('{{$sid}}' =='0'){

          oBtn.disabled = 'disabled';
          textarea.disabled="readonly";
          textarea.innerHTML = '请登录';
        }
       
    if('{{$post1}}'!='0'){
          oBtn.disabled = 'disabled';
          textarea.disabled="readonly";
          textarea.innerHTML = '本帖禁止回复';
        };


</script>


<div class="col-md-3 side-bar">

      <div class="panel panel-default corner-radius">

      <div class="panel-heading text-center">
       <h3 class="panel-title"> 作者：<span {{$post[0]->vip =='y' ? "style=color:red" : "" }}>{{$post['0']->nickname}}</span></h3>
      </div>

    <div class="panel-body text-center topic-author-box">
        <a href="/home/user/otheruserinfo?id={{$post['0']->id}}">
        <!-- {{$post['0']->nickname}} -->
  <img src="{{$post['0']->photo}}" style="width:80px; height:80px;margin:5px;" class="img-thumbnail avatar" />
</a>


<div class="clearfix" style="word-break:break-all">{{$post[0]->content}}</div>
</div>

  </div>
  
    <div class="panel panel-default corner-radius">
    <div class="panel-heading text-center">
      <h3 class="panel-title" ><span {{$post[0]->vip =='y' ? "style=color:red" : "" }}>{{$post['0']->nickname}}</span>的其他话题</h3>
    </div>
    <div class="panel-body">
      <ul class="list">
        @foreach($all as $k=>$v)
        <li>
            <a href="/home/card/details?id={{$v->id}}" title="{{$post['0']->pcontent}}">
              {{$v->ptitle}}
            </a><br>
        </li>
        @endforeach
    </ul>
    </div>
  </div>
  {!! \App\Http\Controllers\home\HomeController::ad() !!}
</div>
</div>
@endsection
@section('js')
<script type="text/javascript">

  //给所有的收藏链接绑定事件
  $('.cang').click(function(){
    //获取收藏人的id
    var uid = $(this).attr('uid');
    //获取收藏的帖子id
    var pid = $(this).attr('pid');
    var links = $(this);
    // alert(uid)
    // alert(pid)

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });


    if(uid==0){
      //若未登录提示信息；
      $('#tishi').text('请登录后再继续操作').show(1000);
      setTimeout(function(){
      $('#tishi').hide(1000);
      },2000);
    }else{
      //登录成功后发送ajax
      $.post('/home/card/cang',{uid:uid,pid:pid},function(data){
        if(data!='repeat'){
          //提示收藏成功，
          $('#tishi').text('收藏成功').show(1000);
          setTimeout(function(){
          $('#tishi').hide(1000);
          },2000);
          //将头像插入至下方
          $('#hshshs').remove();
          var newP = createPerson();
          newP.appendTo('.user-lists')
        }else{
            //提示失败信息
            $('#tishi').text('已经收藏过本帖，如需取消，请去个人中心的[我的收藏]中进行操作').show(1000);
            setTimeout(function(){
            $('#tishi').hide(1000);
            },10000);
        }
      });

      function createPerson()
        {

          //<a href="" data-userid="uid"><img class="img-thumbnail avatar avatar-middle" src="/uploads/user/default.jpg" style="width:48px;height:48px;"></a>
          // var div = document.createElement('div');
          var person = $('<a href="/home/user/otheruserinfo?id={{$sid}}" data-userid="uid"><img class="img-thumbnail avatar avatar-middle" src="{{$photo}}" alt="加载失败" style="width:48px;height:48px;"></a>');

          //返回创建的人物
          return person;
        }





    }

    return false;
  })
</script>
@endsection