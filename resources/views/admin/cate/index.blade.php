@extends('admin.layout.index')
@section('title','板块列表')
@section('path','板块列表')
@section('con')
  <div class="col-xs-12">
  <!-- 操作提示信息 -->
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">板块列表</h3>

        <!-- 通过用户名查找 -->
        <div class="box-tools">
      <form action="/admin/cate/index" method="get">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input name="keyword" class="form-control pull-right" placeholder="Search" type="search">
            <div class="input-group-btn">
              <button class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
      </form>
        </div>
      </div>
      <!-- 用户信息 -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tbody><tr>
            <th>ID</th>
            <th>板块名</th>
            <th>版块介绍</th>
            <th>板块logo</th>
            <th>操作</th>
          </tr>
        @foreach($types as $k=>$v)
          <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->tname}}</td>
            <td>{{$v->tcontent}}</td>
            <td><img src="{{$v->tlogo}}" height="30" alt="加载失败"></td>
            <td>
              <a href="/admin/cate/del?id={{$v->id}}" class="bdel" bid="{{$v->id}}"><span class="label bg-red">删除</span></a>
              <a href="/admin/cate/update?id={{$v->id}}"><span class="label bg-yellow">修改</span></a>
            </td>
          </tr>        
        @endforeach
        </tbody></table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
          {!! $types->appends($all)->render() !!}
  </div>
@endsection
