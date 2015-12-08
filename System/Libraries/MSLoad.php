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
	use Controllers;
	use Models;
	use Extensions;
	use get;
	use MS\MSMemcache;
	class MSLoad extends MSCore{
		public $TempController;
		function __construct(){
			parent::__construct();
			$this->startDrivers();
			spl_autoload_register('MS\MSLoad::autoloadApp',true,true);
		}
		static function autoloadApp($className){
			$sp = DIRECTORY_SEPARATOR;
			$className = strtr($className, "\\", $sp);
			if(file_exists(APPLICATION_PATH."Main/".$className."Controller.php")){
				require APPLICATION_PATH."Main/".$className."Controller.php";
			}
			if(file_exists(APPLICATION_PATH."Main/".$className.".php")){
				require APPLICATION_PATH."Main/".$className.".php";
			}
			if(file_exists(SYSTEM_PATH."/".$className.".php")){
				require SYSTEM_PATH."/".$className.".php";
			}
		}
		function first(){
			if((is_array($this->url)) and ($this->url[0]=="css" or $this->url[0]=="js" or $this->url[0]=="images")){
				$file = $this->site."/".APPLICATION_PATH."Front/".implode($this->url,"/");
				header("Location:".$file);
				return false;
			}
			else{
				$this->controller($this->url);
			}
		}
		public function controller($url = false,$method = "actionIndex"){			
			if(!$url){
				$this->controller($this->welcomeController);
				return true;
			}
			else{
				if(is_array($url)){
					$url = $url;
				}
				else{
					$url = explode("/",$url);
				}
				if(!isset($this->TempController)){
					$this->TempController = $url;
				}
				$controller = implode($url,"/");
			}
			$dir = APPLICATION_PATH."Main/Controllers/".implode($url,"/");
			if(is_dir($dir)){
				$controller = "Controllers\\".implode($url,"\\")."\\".$url[count($url)-1];
			}
			else if(is_file($dir."Controller.php")){
				$controller = "Controllers\\".implode($url,"\\");
			}
			else{
				$method = $url[count($url)-1];
				unset($url[count($url)-1]);
				if(!$url){
					$controller = "Controllers\hata";
				}
				else{
					$this->controller($url,$method);
					return false;
				}
			}
			if(class_exists($controller)){
				$running = new $controller();
				$running->ControllerArray = $this->TempController;
				$done = 0;
				if(!method_exists($running,$method)){
					$method = "actionIndex";
				}
				if(isset($running->acl)){
					$boolean = true;
					for($i = 0;$i<count($running->acl->array);$i++){
						for($j = 0; $j<count($running->acl->array[$i]["actions"]);$j++){
							if($running->acl->array[$i]["actions"][$j] === $method){
								$done = 1;
								$array = $running->acl->array[$i];
								if($array["expression"] and $boolean){
									$boolean = true;
								}
								else{
									$boolean = false;
								}
								if(isset($array["ip"])){
									$ip = $array["ip"];
									if($ip == $_SERVER["REMOTE_ADDR"]){
										$true = true;
									}
									else{
										$true = false;
									}
									if($boolean and $true){
										$boolean = true;
									}
									else{
										$boolean = false;
									}
								}
								if($boolean){
									if(method_exists($running,"before")){
										$running->before();
									}
									if($running->Cache){
										$this->runCache($running,$method,$controller);
									}
									else{
										if(method_exists($running,$method)){
											$running->$method();
										}
										else if(method_exists($running,"actionIndex")){
											$running->actionIndex();
										}
									}
									if(method_exists($running,"after")){
										$running->after();
									}
								}
								else{
									if(isset($array["redirect"])){
										header("Location:".$this->site."/".$array["redirect"]);
									}
									else{
										echo '<!DOCTYPE html>
										<html>
										<head>
											<meta charset="utf-8" />
											<title>Erişim Engellendi</title>
										</head>
										<body>
											Erişim Engellendi.
										</body>
										</html>';
									}
								}
								break;
							}
						}
						if($done){
							break;
						}
					}
				}
				else{
					if(method_exists($running,$method)){
						if(method_exists($running,"before")){
							$running->before();
						}
						if(isset($running->Cache)){
							if(method_exists($running,$method)){
								$this->runCache($running,$method,$controller);
							}
						}
						else{
							if(method_exists($running,$method)){
								$running->$method();
							}
						}
						if(method_exists($running,"after")){
							$running->after();
						}
						return $running;
					}
					else if(method_exists($running,"actionIndex")){
						$running->actionIndex();
						return $running;
					}
				}
			}
			else{
				if(class_exists("Controllers\Hata")){
					$running = new Controllers\Hata();
					if(method_exists($running,$method)){
						$running->$method();
					}
					else if(method_exists($running,"actionIndex")){
						$running->actionIndex();
					}
				}
			}
		}
		public function runCache(MSController $running,$method,$controller){
			if($running->CacheType="MSCache"){
				$MSCache = new MSCache($running->Cache,$controller);
				if($MSCache->control()){
					$MSCache->read();
				}
				else{
					ob_start();
					if(method_exists($running,$method)){
						$running->$method();
					}
					$MSCache->runCache();
					ob_end_flush();
				}
			}
		}
		public function model($modelName=false){
			if($modelName){
				$modelName = explode("/",$modelName);
				$modelName = "Models\\".implode($modelName,"\\")."Model";
				if(class_exists($modelName)){
					return new $modelName;
				}
			}
		}
		public function view($viewName=false,$data=false){
			if($data){
				extract($data);
			}
			if(!$viewName){
				return false;
			}
			if(file_exists(APPLICATION_PATH."Main/Views/".$viewName."View.php")){
				include APPLICATION_PATH."/Main/Views/".$viewName."View.php";
			}
		}
		public function extension($extensionName=false){
			if($extensionName){
				$extensionName = "Extensions\\".$extensionName;
				return new $extensionName;
			}
			else{
				return false;
			}
		}
		function startDrivers(){
			$Cache = get::Config("Cache","Memcache");
			if($Cache["use"]){
				$this->Memcache = new MSMemcache;
			}
		}
	}
//---------------------------------------------------------------------------
/* End of file MSLoad.php */
/* Location : ./system/core/libs/MSLoad.php*/
?>