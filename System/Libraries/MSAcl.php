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
	use MS\MSCore;
	class Acl extends MSCore{
		function setAccess($array = array()){
			$this->array = $array;
		}
	}
?>