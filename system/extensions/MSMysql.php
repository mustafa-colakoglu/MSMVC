<?php
	namespace Extensions;
	class MSMysql{
		var $host;
		var $user;
		var $password;
		var $database;
		function connect(){
			@mysql_connect($this->host,$this->user,$this->password);
			mysql_select_db($this->database);
		}
		function select($table,$where="",$column="",$other=""){
			if($where!=""){
				$where="WHERE ".$where;
			}
			if($column==""){
				$column="*";
			}
			$sql="SELECT ".$column." FROM ".$table." ".$where." ".$other;
			$data = array();
			$columns = array();
			$get = mysql_query($sql);
			if($column==="*"){
				$columnList=mysql_query("SHOW COLUMNS FROM $table");
				while ($row = mysql_fetch_object($columnList)){
					$col=$row->Field;
					array_push($columns,$col);
				}
			}
			else{
				$columns=explode(",",$columns);
			}
			while($fetch=mysql_fetch_array($get)){
				$array=array();
				for($i=0;$i<count($columns);$i++){
					$array[$columns[$i]]=$fetch[$columns[$i]];
					$array[$i]=$fetch[$i];
				}
				array_push($data,$array);
			}
			return $data;
		}
		function insert($tablo,$satirlar=false,$degerler){
			$sql="INSERT INTO ".$tablo."(".$satirlar.") VALUES(".$degerler.")";
			if(!$satirlar){
				$sql="INSERT INTO ".$tablo." VALUES(".$degerler.")";
			}
			return mysql_query($sql);
		}
		function update($tablo,$set,$where=false,$diger=false){
			if($where){
				$sql="UPDATE ".$tablo." SET ".$set." WHERE ".$where;
			}
			else{
				$sql="UPDATE ".$tablo."SET ".$set;
			}
			return mysql_query($sql);
		}
		function delete($tablo,$where=false){
			if($where){
				$sql="DELETE FROM ".$tablo." WHERE ".$where;
			}
			else{
				$sql="DELETE FROM ".$tablo;
			}
			return mysql_query($sql);
		}
	}
?>