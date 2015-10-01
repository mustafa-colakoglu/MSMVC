<?php
	namespace Extensions;
	use PDO;
	class MSPdo{
		var $host;
		var $user;
		var $password;
		var $database;
		function connect(){
			$this->db = new PDO("mysql:host=".$this->host.";dbname=".$this->database,$this->user,$this->password);
		}
		function select($table,$where="",$column="",$other=""){
			$data = array();
			if($where!=""){
				$where="WHERE ".$where;
			}
			if($column==""){
				$column="*";
			}
			$sql="SELECT ".$column." FROM ".$table." ".$where." ".$other;
			$get = $this->db->prepare($sql);
			$get->execute();
			$data = $get->fetchAll();
			return $data;
		}
		public function insert($tablo,$satirlar=false,$degerler){
			$sql="INSERT INTO ".$tablo."(".$satirlar.") VALUES(".$degerler.")";
			if(!$satirlar){
				$sql="INSERT INTO ".$tablo." VALUES(".$degerler.")";
			}
			return $this->db->query($sql);
		}
		public function update($tablo,$set,$where=false,$diger=false){
			if($where){
				$sql="UPDATE ".$tablo." SET ".$set." WHERE ".$where;
			}
			else{
				$sql="UPDATE ".$tablo."SET ".$set;
			}
			return $this->db->query($sql);
		}
		public function delete($tablo,$where=false){
			if($where){
				$sql="DELETE FROM ".$tablo." WHERE ".$where;
			}
			else{
				$sql="DELETE FROM ".$tablo;
			}
			return $this->db->query($sql);
		}
		function lastInsertId(){
			return $this->db->lastInsertId();
		}
	}
?>