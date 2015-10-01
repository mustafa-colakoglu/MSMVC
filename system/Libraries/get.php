<?php
/**
	* msMVC
	* @package MSmvc
	* @author Mustafa Çolakoğlu
	* @since Version 1.0

//---------------------------------------------------------------------------

	* msMVC MSGet
	* @package msMVC
	* @subpackage libs
	* @author Mustafa Çolakoğlu
	
**/
	class get{
		static function lang(){
			if(isset($_SESSION["lang"])){
				return $_SESSION["lang"];
			}
			else{
				return "en";
			}
		}
		static function site(){
			require APPLICATION_PATH."Config/SiteInfo.php";
			return $config["SiteInfo"]["site"];
		}
		static function controller(){
			if(isset($_GET["url"])){
				return explode("/",$_GET["url"]);
			}
			else{
				return array("");
			}
		}
		static function url(){
			return self::site()."/".implode("/",self::controller());
		}
		static function mime(){
			return include SYSTEM_PATH."/Libraries/get/mime.php";
		}
		static function symbols(){
			return include SYSTEM_PATH."/Libraries/get/symbols.php";
		}
		static function Config($Config,$indis = false){
			require APPLICATION_PATH."/Config/".$Config.".php";
			if($indis){
				return $config[$Config][$indis];
			}
			return $config["Config"];
		}
	}
//---------------------------------------------------------------------------
/* End of file MSGet.php */
/* Location : ./System/Libraries/get.php*/
?>