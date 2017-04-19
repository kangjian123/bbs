@extends('home.layout.index')
@section('con')

<div class="col-md-8 topics-index main-col">

<div class="panel panel-default">

<div class="panel-heading">

  <ul class="list-inline topic-filter ">
        <li class="popover-with-html" data-content="{{$keyword}}"><a class="active">列表</a></li>
    </ul>
  <div class="clearfix"></div>
</div>
    <div class="jscroll">
        <div class="panel-body remove-padding-horizontal">
            <ul class="list-group row topic-list">

             <ul class="list-group row"></ul>
        <div id="replies-empty-block" class="empty-block">暂无帖子~~</div>

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