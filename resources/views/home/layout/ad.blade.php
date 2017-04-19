  <div class="panel panel-default corner-radius sidebar-resources">
    <div class="panel-heading text-center">
      <h3 class="panel-title">热门排行</h3>
    </div>
    <div class="panel-body">
      <ul class="list list-group ">
  @foreach($hot as $k=>$v )
          <li class="list-group-item ">
              <a href="/home/card/details?id={{$v->id}}" target="_blank" class="no-pjax" title=" ">{{$v->ptitle}}</a>
  @endforeach
          <li class="list-group-item ">
      </ul>
    </div>
  </div>

<div class="panel panel-default corner-radius sidebar-resources">
  <div class="panel-heading text-center">
    <h3 class="panel-title">最新帖子</h3>
  </div>
  <div class="panel-body">
    <ul class="list list-group ">
         @foreach($new as $k=>$v )
          <li class="list-group-item ">
              <a href="/home/card/details?id={{$v->id}}" target="_blank" class="no-pjax" title=" ">{{$v->ptitle}}</a>
        @endforeach
          <li class="list-group-item ">
    </ul>
  </div>
</div>

@foreach($ad as $k=>$v)
        <div class="panel panel-default corner-radius sidebar-resources">
          <div class="panel-heading text-center">
            <h3 class="panel-title">{{$v->adname}}</h3>
          </div>
          <div class="panel-body">
                    <a href="http://{{$v->adlink}}" target="_blank" class="no-pjax" title="{{$v->adname}}">
                        <img class="media-object inline-block " style="width:260px; margin: 3px 0;" src="{{$v->adpic}}">
                    </a>
                
          </div>
        </div>
@endforeach


<div class="panel panel-default corner-radius" style="color:#a5a5a5">
  <div class="panel-body text-center">
      <a href="mailto:tenno@sina.cn"  style="color:#a5a5a5">
          <span style="margin-top: 7px;display: inline-block;">
              <i class="fa fa-heart" aria-hidden="true" style="color: rgba(232, 146, 136, 0.89);"></i> 建议反馈？请私信 Tenno
          </span>
      </a>
  </div>
</div>
</div>
