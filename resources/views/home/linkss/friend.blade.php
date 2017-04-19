@extends('home.index')
@section('bt')
     <title>{{$configtitle['0']->configtitle}}</title>
@endsection

@section('con')
<div class="box text-center site-intro rm-link-color">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        欢迎交换友链，优先考虑  搞笑、开心 相关话题的站点。请联系 <a href="mailto:tenno@sina.cn">tenno</a>
    </div>
<div class="panel panel-default">
  <div class="panel-heading">
    <i class="fa fa-flag text-md"></i>推荐网站
  </div>
  <div class="panel-body row">
    @foreach($friend as $k=>$v)
    <div class="col-md-2 site">
      <a class="popover-with-html" target="_blank" href="http://{{$v->flink}}" data-content="" data-original-title="" title="">
        {{$v->fname}}
      </a>
    </div>
      @endforeach
  </div>
</div>
</div>
<!--  网站介绍  -->
@endsection

