<?php
	namespace Controllers;
	use MS\MSController;
	class MSCaptchaImage extends MSController{
		function __construct(){
			parent::__construct();
		}
		function actionIndex(){
			$text = @$_SESSION["MSCaptchaText"];
			$imageWidth = $_SESSION["MSCaptchaWidth"];
			$imageHeight = $_SESSION["MSCaptchaHeight"];
			$rs = imagecreate($imageWidth,$imageHeight);
			$yellow = imagecolorallocate($rs,255,255,0);
			$red = imagecolorallocate($rs,255,0,0);
			$size = $imageHeight/3;
			$left = ($imageWidth-strlen($text)*$size)/2;
			imagettftext($rs,$size,0,$left,$size*2,$red,SYSTEM_PATH."fonts/GraublauWeb.ttf",$text);
			header("Content-type: image/png");
			imagepng($rs);
		}
	}
?>