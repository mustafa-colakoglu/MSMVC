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
	require APPLICATION_PATH."Config/Database.php";
	if($config["Database"]){
		if($config["Database"]["databaseType"] === "mysql" or $config["Database"]["databaseType"] === "MYSQL"){
			if($config["Database"]["driver"] === "pdo" or $config["Database"]["driver"] === "PDO"){
				require "MSDb/MSPdo.php";
				class MSDb extends MSPdo{}
			}
			else if($config["Database"]["driver"] === "mysql" or $config["Database"]["driver"] === "MYSQL"){
				require "MSDb/MSMysql.php";
				class MSDb extends MSMysql{}
			}
		}
		else if($config["Database"]["databaseType"] === "SQLite" or $config["Database"]["databaseType"] === "sqlite"){
			if($config["Database"]["driver"] === "PDO" or $config["Database"]["driver"] ==="pdo"){
				require "MSDb/MSPdoSQLite.php";
				class MSDb extends MSPdo{}
			}
			else if($config["Database"]["driver"] === "SQLite3" or $config["Database"]["driver"] === "sqlite3"){
				require "MSDb/MSSQLite.php";
				class MSDb extends MSSQLite{}
			}
		}
	}
//---------------------------------------------------------------------------
/* End of file MSDb.php */
/* Location : ./system/core/libs/MSDb.php*/
?>