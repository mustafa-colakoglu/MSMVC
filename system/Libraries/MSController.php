<?php
/**
 *
 * @author Mustafa Çolakoğlu
 * @link http://www.mcolak.net/
 * @copyright 2015 MSMVC
 * @github https://github.com/mustafa220/MSMVC
 */
	namespace MS;
	use MS\MSLoad;
	class MSController extends MSLoad{
		public $Cache=false;
		public $CacheType="MSCache";
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
	}
/* End of file MSController.php */
/* Location : ./system/Libraries/MSController.php*/
?>