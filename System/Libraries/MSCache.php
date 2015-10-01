<?php
/**
	* msMVC
	* @package MSmvc
	* @author Mustafa Çolakoğlu
	* @since Version 1.0

//---------------------------------------------------------------------------

	* msMVC MSCache
	* @package msMVC
	* @subpackage libs
	* @author Mustafa Çolakoğlu
	
**/
	namespace MS;
	use MS\MSCore;
	class MSCache extends MSCore{
		private $timer;
		private $getUrl;
		private $fileName;
		private $runCache;
		function __construct($timer,$controller){
			parent::__construct();
			if($controller){
				if(is_array($this->url)){
					$this->getUrl = $controller.implode("/",$this->url);
				}
				else{
					$this->getUrl = $controller;
				}
			}
			else{
				$this->getUrl = implode("/",$this->url);
			}
			$this->runCache=true;
			$this->timer = $timer;
			$this->fileName = APPLICATION_PATH."Cache/MSCacheFiles/".md5($this->getUrl).".php";
		}
		function runCache(){
			if($this->runCache){
				if(file_exists($this->fileName)){
					if(time() - $this->timer < filemtime($this->fileName)){}
					else{
						unlink($this->fileName);
						$openFile = fopen($this->fileName,"w+");
						fwrite($openFile,ob_get_contents());
					}
				}
				else{
					$openFile = fopen($this->fileName,"w+");
					fwrite($openFile,ob_get_contents());
				}
			}
		}
		function control(){
			if(file_exists($this->fileName)){
				if(time() - $this->timer < filemtime($this->fileName)){
					return true;
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
		function read(){
			require $this->fileName;
		}
	}
//---------------------------------------------------------------------------
/* End of file MSCache.php */
/* Location : ./system/core/libs/MSCache.php*/
?>