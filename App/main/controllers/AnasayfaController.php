<?php
	namespace Controllers;
	use MS\MSController;
	use MS;
	class Anasayfa extends MSController{
		function __construct(){
			parent::__construct();
		}
		function before(){
			$this->setLang("en");
		}
		function actionIndex(){
			$this->model("Anasayfa")->veriler();
			/*if(@$this->url[1]){
				$this->setLang($this->url[1]);
			}
			echo '<!DOCTYPE html>
			<html>
			<head>
				<meta charset="utf-8" />
				<title>Language Test</title>
			</head>
			<body>
			';
			echo MS::t("Monday")."<br />";
			echo MS::t("Tuesday")."<br />";
			echo MS::t("Wednesday")."<br />";
			echo MS::t("Thursday")."<br />";
			echo MS::t("Friday")."<br />";
			echo MS::t("Saturday")."<br />";
			echo MS::t("Sunday")."<br />";
			if($_SESSION["lang"]=="en"){
			?>
			<a href="<?php echo $this->site; ?>/Anasayfa/tr">TR</a>
			<?php
			}
			else{
			?>
			<a href="<?php echo $this->site; ?>/Anasayfa/en">EN</a>
			<?php
			}
			echo '
			</body>
			</html>';*/
		}
	}
?>