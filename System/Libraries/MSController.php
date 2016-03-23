<?php
/**
	* MSMVC
	* @package MSMVC
	* @author Mustafa Çolakoğlu
	* @since Version 1.0

//---------------------------------------------------------------------------

	* MSMVC MSCache
	* @package MSMVC
	* @author Mustafa Çolakoğlu
**/
	namespace MS;
	use MS\MSLoad;
	use get;
	class MSController extends MSLoad{
		public $Cache;
		public $CacheType;
		public $ControllerArray;
		function __construct(){
			$this->load = new MSLoad();
			parent::__construct();
		}
		function setLang($lang="en"){
			$_SESSION["lang"] = $lang;
		}
		function isSetLang(){
			if(isset($_SESSION["lang"])){
				return true;
			}
			else{
				return false;
			}
		}
		function redirect($ControllerName = false){
			if($ControllerName){
				header("Location:".get::site()."/".$ControllerName);
			}
		}
	}
/* End of file MSController.php */
/* Location : ./system/Libraries/MSController.php*/
?>