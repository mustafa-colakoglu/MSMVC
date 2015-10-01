<?php
	class MS{
		static function t($string = false,$array = false){
			if(!isset($_SESSION["lang"])){
				return $string;
			}
			else{
				$lang = $_SESSION["lang"];
			}
			if(file_exists(APPLICATION_PATH."Languages/".$lang.".php")){
				$langArray = include APPLICATION_PATH."Languages/".$lang.".php";
			}
			if($string){
				if($array){
					$string = $langArray[$string];
					foreach($array as $key=>$value){
						$string = str_replace("[".$key."]",$value,$string);
					}
					return $string;
				}
				else{
					if(isset($langArray[$string])){
						return $langArray[$string];
					}
					else{
						return $string;
					}
				}
			}
		}
	}
?>