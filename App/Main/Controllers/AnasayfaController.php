<?php
	namespace Controllers;
	use MS\MSController;
	use MS;
	class Anasayfa extends MSController{
		function __construct(){
			parent::__construct();
		}
		function actionIndex(){
			$this->model("Anasayfa")->veriler();
			echo "Welcome to MS!";
		}
	}
?>