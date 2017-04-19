<?php 
	session_start();
	//绘制验证
	
	//测试函数
	$type = 1;
	$length = 4;
	$code = getCode($type,$length);
	
	$_SESSION['code']=$code;
	// session(['code.id'=>$code]);
	
	//0. 设置响应头
	header("Content-Type:image/png");
	
	//1. 准备画布、画笔、颜料
	$im = imagecreatetruecolor(20*$length,30);
	
	//准备背景色
	$bg = imagecolorallocate($im,240,240,240);
	
	//准备前景色
	$hb = imagecolorallocate($im,255,0,0);
	
	//2. 开始绘画
	imagefill($im,0,0,$bg);
	
	//绘制文本
	for($i=0;$i<$length;$i++){
		$tc = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
		imagettftext($im,20,rand(-30,30),5+17*$i,25,$tc,'msyhbd.ttf',$code[$i]);
	}
	
	//绘制像素点
	for($j=1;$j<=200;$j++){
		$pc = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
		imagesetpixel($im,rand(0,20*$length),rand(0,30),$pc);
	}
	
	//绘制线条
	for($z=1;$z<=4;$z++){
		$lc = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
		imageline($im,rand(0,20*$length),rand(0,30),rand(0,20*$length),rand(0,30),$lc);
	}
	
	//3. 输出图像
	imagepng($im);
	
	//4. 释放资源
	imagedestroy($im); 
	
	
	//生成随机字符
	// $str = "abcdefghijklmn";
	// $length = strlen($str)-1;
	// echo $str[rand(0,$length)];
	
	
	/**
	 *作者：XXX
	 *时间：2016年12月22日10:00:52
	 *功能：定义一个生成指定长度的验证码函数
	 *参数：
	 * @param   integer    $type     用户所指定的验证码类型(1.纯数字,2.数字+小写字母,3.数字+大小写字母)
	 * @param   integer    $length   用户所指定的验证码长度(整数类型的长度，不要超过6位)
	 * @return  string     $code     验证码生成的指定为长度的随机内容
	 */
	function getCode($type,$length){
		
		//1.定义字符源
		$str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
		//2.判断用户选择的验证码类型
		if($type==1){
			$m = 9;
		}elseif($type==2){
			$m = 35;
		}elseif($type==3){
			$m = strlen($str)-1;
		}
		
		//3.随机指定长度字符
		$code = "";
		for($i=0;$i<$length;$i++){
			$code.=$str[rand(0,$m)];
		}
		
		//4.将生成的验证码返回到调用出
		return $code;
	}
?>