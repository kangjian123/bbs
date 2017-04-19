<!DOCTYPE html>

<html lang="it"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>网站正在维护</title>
	<script type="text/javascript" src="/homecss/404/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="/homecss/404/jquery.parallax.js"></script>
	<script type="text/javascript" language="javascript" src="/homecss/wh/js/jquery.min.js"></script>
	<link rel="stylesheet" href="/homecss/wh/css/style.css" media="all" type="text/css">
	<link href="/homecss/404/css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="/homecss/404/500.css">
</head>
<body>
<style type="text/css">
.color{color:#808080; text-decoration:none;font-weight:bold;}
.color:visited{color:#3399CC; text-decoration:none;font-weight:bold;}
.color:hover{color:#CF0000; text-decoration:underline;font-weight:bold;}
</style>
<div id="top"><span></span></div>
<div id="container">
	<div id="content">
		<h1 id="title">500-11</h1>
		<p id="subtitle"><strong>&nbsp;&nbsp;网站正在维护</strong></p>
		<p class="wrap">如有紧急情况,请联系 <a class="color" href="mailto:tenno@qq.com"><h1>tenno</h1></a></p>
	</div>
	<span id="case" class="scroll" style="left: 303.7px;"></span>
	<span id="dino" class="reverse scroll" style="left: 368.6px;"></span>
	<span id="m1" class="scroll" style="left: 317.48px;"></span>
	<span id="m2" class="scroll" style="left: 737.4px;"></span>
	<span id="m3" class="scroll" style="left: 637.13px;"></span>
</div>
<script type="text/javascript">
$(document).ready(function() {
$("body, html").mousemove(function(e) {
		var offset = $(this).offset();
		var xPos = e.pageX - offset.left;
		var xPercent = Math.round(xPos / $(window).width() * 100);
		$(".scroll").each(function(){
			xMax = $(this).data("xMax");
			xMin = $(this).data("xMin");
			if ($(this).hasClass("reverse")) {
				xPosition = xMax-((xMax-xMin)*xPercent/100);
			} else {
				xPosition = xMin+((xMax-xMin)*xPercent/100);
			}
			$(this).css({"left":xPosition+"px"});
		});
	});
	$("#case").data("xMin",300);
	$("#case").data("xMax",310);
	$("#dino").data("xMin",356);
	$("#dino").data("xMax",376);
	$("#m1").data("xMin",316);
	$("#m1").data("xMax",320);
	$("#m2").data("xMin",730);
	$("#m2").data("xMax",750);
	$("#m3").data("xMin",619);
	$("#m3").data("xMax",668);
});
</script>

</body></html>