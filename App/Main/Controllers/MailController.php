<?php
	namespace Controllers;
	use MS\MSController;
	use MS;
	class Mail extends MSController{
		function __construct(){
			parent::__construct();
		}
		function actionIndex(){
			$this->model("Mail")->veriler();
		}
	}
?>