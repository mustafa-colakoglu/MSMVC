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
	use MS\CacheAdapter;
	use Memcache;
	class MSMemcache extends CacheAdapter{
		function __construct($settings = false){
			if(isset($settings) and is_array($settings)){
				//$this->connect();
			}
			else{
				//$this->connect();
			}
		}
	}
?>