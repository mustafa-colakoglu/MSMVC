<?php
	namespace MS;
	use MS\MSLoad;
	use SQLite3;
	class MSSQLite extends MSLoad{
		function __construct(){
			parent::__construct();
			require APPLICATION_PATH."Config/Database.php";
			$this->db = new SQLite3(APPLICATION_PATH."Databases/SQLite/".$fileName);
		}
		function create($tableName,$columns = array()){
			$query = "CREATE TABLE IF NOT EXISTS ".$tableName."(";
			for($i = 0;$i<count($columns);$i++){
				if($i === count($columns)-1){
					$query.= $columns[$i]." ".$columnsDetails[$i];
				}
				else{
					$query.= $columns[$i]." ".$columnsDetails[$i].",";
				}
			}
		}
		function select(){
			return array();
		}
	}
?>