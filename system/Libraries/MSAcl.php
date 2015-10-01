<?php
	namespace MS;
	use MS\MSCore;
	class Acl extends MSCore{
		function setAccess($array = array()){
			$this->array = $array;
		}
	}
?>