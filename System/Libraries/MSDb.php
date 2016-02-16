<?php
/**
	* MSMVC
	* @package MSMVC
	* @author Mustafa Çolakoğlu
	* @since Version 1.0

//---------------------------------------------------------------------------

	* MSMVC MSDb
	* @package MSMVC
	* @author Mustafa Çolakoğlu
**/
	namespace MS;
	use get;
	use MS\MSLoad;
	class MSDb extends MSLoad{
		// Variables
		public $Config;
		private $Database;
		
		function __construct(){
			parent::__construct();
			spl_autoload_register("MS\MSDb::AutoloadDriver");
			$this->Config = get::Config("Database");
			if($this->Config["databaseType"] == "mysql"){
				if($this->Config["driver"] === "pdo"){
					$this->Database = new MSPdo();
					$this->Database->connect($this->Config["server"],$this->Config["username"],$this->Config["password"],$this->Config["dbname"],$this->Config["port"]);
				}
				else if($this->Config["driver"] === "mysql"){
					$this->Database = new MSMysql();
					$this->Database->connect($this->Config["server"],$this->Config["username"],$this->Config["password"],$this->Config["dbname"],$this->Config["port"]);
				} 
			}
		}
		public static function AutoloadDriver($ClassName){
			$ClassMap = self::ClassMap();
			if(isset($ClassMap[$ClassName])){
				include $ClassMap[$ClassName];
			}
			else{
			
				$ClassName = ltrim($ClassName, '\\');
				$parts=explode("\\",$ClassName);
				
				$fileName  = '';
				$namespace = '';
					if ($lastNsPos = strrpos($ClassName, '\\')) {
						$namespace = substr($ClassName, 0, $lastNsPos);
						$ClassName = substr($ClassName, $lastNsPos + 1);
						$fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
						$fileName  = SYSTEM_PATH.str_replace($parts[0], "", $fileName) ;
						
					}
					$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $ClassName) . '.php';
					
					if(is_file($fileName))
						require $fileName;
			}
		}
		public static function ClassMap(){
			return array(
				"MS\MSPdo" => SYSTEM_PATH."Libraries/MSDb/MSPdo.php",
				"MS\MSMysql" => SYSTEM_PATH."Libraries/MSDb/MSMysql.php"
			);
		}
		function select($table, $where="", $column="", $other=""){
			return $this->Database->select($table, $where, $column, $other);
		}
		function insert($tablo,$satirlar=false,$degerler){
			return $this->Database->insert($tablo, $satirlar, $degerler);
		}
		function update($tablo,$set,$where=false,$diger=false){
			return $this->Database->update($tablo,$set,$where,$diger);
		}
		function delete($tablo,$where=false){
			return $this->Database->delete($tablo,$where);
		}
		function lastInsertId(){
			return $this->Database->lastInsertId();
		}
	}
//---------------------------------------------------------------------------
/* End of file MSDb.php */
/* Location : ./System/Libraries/MSDb.php*/
?>