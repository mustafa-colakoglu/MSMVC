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
	class Pagination{
		private $array;
		private $getPage;
		private $number;
		private $pageNumber;
		private $thisPage;
		function __construct($array = false){
			if(is_array($array)){
				$this->array = $array;
				return true;
			}
			else{
				return false;
			}
		}
		function set($number = false){
			if($number){
				$this->number = $number;
				if($this->number>0){
					$count = count($this->array);
					if($count>0){
						$pageNumber = count($this->array)/$number;
						if($pageNumber>intval($pageNumber)){
							$pageNumber = intval($pageNumber)+1;
						}
						$this->pageNumber = $pageNumber;
					}
				}
			}
			else{
				return false;
			}
		}
		function getPage($sayfa = false){
			if($sayfa or $sayfa === 0){
				$this->thisPage = $sayfa;
				$sayfa--;
				if($sayfa >= 0){
					$array = array();
					$sayac = 0;
					$start = $sayfa*$this->number;
					$finish = ($sayfa+1)*$this->number;
					foreach($this->array as $key=>$value){
						if($sayac>=$start and $sayac<$finish){
							$array[$key] = $value;
						}
						$sayac++;
					}
					return $array;
				}
				else{
					return array();
				}
			}
			else{
				return false;
			}
		}
		function getPageNumber(){
			return $this->pageNumber;
		}
		function getThisPage(){
			return $this->thisPage;
		}
		function __destruct(){
			unset($this->array);
			unset($this->getPage);
			unset($this->number);
			unset($this->pageNumber);
			unset($this->thisPage);
		}
	}
?>