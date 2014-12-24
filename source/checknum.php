<?php
	session_start();
	//生成验证码图片
	Header("Content-type: image/PNG");
	$im = imagecreate(44,18);
	$back = ImageColorAllocate($im, 245,245,245);
	$randstr = "0123456789abcdefghijklmnopqrstuvwxyz";
	$len = strlen($randstr);
	imagefill($im,0,0,$back); //背景
	srand((double)microtime()*1000000);
	//生成4位数字
	for($i=0;$i<4;$i++){
		$font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
		$p = rand() % $len;
		$str=substr($randstr,$p,1);
		$vcodes.=$str;
		imagestring($im, 5, $i*10+rand()%3, 1+rand()%3, $str, $font);
	}
	for($i=0;$i<100;$i++) //加入干扰象素
	{ 
		$randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
		imagesetpixel($im, rand()%44 , rand()%18 , $randcolor);
	} 
	ImagePNG($im);
	ImageDestroy($im);
	$_SESSION['checknum'] = $vcodes;
?>
