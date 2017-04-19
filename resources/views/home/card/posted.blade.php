@extends('home.layout.index')
@section('con')

   <script type="text/javascript" charset="utf-8" src="/homecss/texteatecss/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/homecss/texteatecss/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/homecss/texteatecss/lang/zh-cn/zh-cn.js"></script>
 
    

		<meta http-equiv="x-pjax-version" content="./pub/css/styles-2bd546149e.css">

	</head>
	<body id="body" class="articles-create">


		<div id="wrap">



		<div class="container main-container blog-container">

				
				
				
<div class="blog-pages">

  <div class="col-md-10 panel">

      <div class="panel-body">

            <h2 class="text-center"> 创作文章</h2>
            <hr>
  <script type="text/javascript">

  </script>
           
    <form method="post" action="{{url('home/card/posted')}}" accept-charset="UTF-8" id="article-create-form">
    	

    <div class="form-group">
        <input class="form-control" id="article-title" placeholder="请填写标题" name="title" type="text" value="" required="require">
    </div>
    <hr>
   <h4 class="text-center">选择发送的板块</h4> 
    <select name="types" class="form-control">
    @foreach($type as $k=>$v)
        <option value="{{$v->id}}" {{$v->id==$typeid ? 'selected="selected"' : ''}}>{{$v->tname}}</option>
    @endforeach
    </select>
    <hr>

 <textarea name="editorValue" id="editor" style="width:920px;height:500px;" ></textarea>
    <div class="form-group status-post-submit">
      	<button onclick="pd();">发 布</button>
    </div>

      {{ csrf_field() }}   
</form>
<script type="text/javascript">
 var ue = UE.getEditor('editor',{
      allowDivTransToP: false
  });


</script>
           
      </div>

  </div>
</div>
</div>

</div></div>
  @endsection
