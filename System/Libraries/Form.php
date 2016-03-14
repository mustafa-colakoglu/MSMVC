<?php
	class Form{
		public static function post($SubScript = false){
			if($SubScript){
				if(isset($_POST[$SubScript])){
					return $_POST[$SubScript];
				}
				return false;
			}
			return false;
		}
		public static function get($SubScript = false){
			if($SubScript){
				if(isset($_GET[$SubScript])){
					return $_GET[$SubScript];
				}
				return false;
			}
			return false;
		}
		public static function files($SubScript = false){
			if($SubScript){
				if(isset($_FILES[$SubScript])){
					return $_FILES[$SubScript];
				}
				return false;
			}
			return false;
		}
	}
?>