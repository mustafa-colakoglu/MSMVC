<?php

/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/imadige/SMCEframework-MVC
 */

namespace MS;
class MSAutoload 
{
	private static $config;
	
	
	/**
	 * @param $className
	 * 
	 * include class
	 */
	function loadMSStatic(){
		require SYSTEM_PATH."Libraries/get.php";
		require SYSTEM_PATH."Libraries/MS.php";
		require SYSTEM_PATH."Libraries/Uselib.php";
		require SYSTEM_PATH."Libraries/Session.php";
	}
	private static  function autoloadFramework($className)
	{
		$classMap=self::classMap();
		
		if(isset($classMap[$className]))
		{
			include $classMap[$className];
		}
		else{
		
			$className = ltrim($className, '\\');
			$parts=explode("\\",$className);
			
			$fileName  = '';
			$namespace = '';
				if ($lastNsPos = strrpos($className, '\\')) {
					$namespace = substr($className, 0, $lastNsPos);
					$className = substr($className, $lastNsPos + 1);
					$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
					$fileName  = SYSTEM_PATH.str_replace($parts[0], "", $fileName) ;
					
				}
				$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
				
				if(is_file($fileName))
					require $fileName;
		}
		
	}
	
	
	
	/**
	 * autoload register
	 * 
	 * @param $config
	 */
	
	public function register($config=array()){
		self::$config=$config;
		spl_autoload_register(array($this, 'autoloadFramework'),true,true);
	}
	
	/**
	 * composer autoload register
	 * 
	 * 
	 */
	
	public function registerComposer(){
		spl_autoload_register(array($this, 'autoloadComposer'),true,true);
	}
	
	
	
	/**
	 * class map
	 * 
	 * @return array
	 */
	
	
	private static function classMap(){
		return array(
			"MS\Acl" => SYSTEM_PATH."Libraries/MSAcl.php",
			"MS\CacheAdapter" => SYSTEM_PATH."Libraries/CacheAdapter.php",
			"MS\MSCache" => SYSTEM_PATH."Libraries/MSCache.php",
			"MS\MSController" => SYSTEM_PATH."Libraries/MSController.php",
			"MS\MSDb" => SYSTEM_PATH."Libraries/MSDb.php",
			"MS\MSLoad" => SYSTEM_PATH."Libraries/MSLoad.php",
			"MS\MSGet" => SYSTEM_PATH."Libraries/MSGet.php",
			"MS\MSMemcache" => SYSTEM_PATH."Libraries/MSMemcache.php",
			"MS\MSModel" => SYSTEM_PATH."Libraries/MSModel.php",
			"MS" => SYSTEM_PATH."Libraries/MS.php",
			"MS\MSUselib" => SYSTEM_PATH."Libraries/MSUselib.php",
			"MS\Redis" => SYSTEM_PATH."Libraries/Redis.php",
			"MS\Upload" => SYSTEM_PATH."Libraries/Upload.php"
		);
	}
}
	session_start();
	$MSAutoload = new MSAutoload();
	$MSAutoload->loadMSStatic();
	$MSAutoload->register();
	use MS\MSLoad;
	$load = new MSLoad();
	$load->first();
?>