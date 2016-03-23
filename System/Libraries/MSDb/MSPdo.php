<?php
	namespace MS;
	use MS\MSLoad;
	use PDO;
	use MS\MSLog;
	class MSPdo{
		public $db;
		function __construct(){
			$this->MSLog = new MSLog();
		}
		function connect($server = "localhost", $username = false, $password = "", $dbname = false, $port = false){
			if($username and $dbname){
				if($port){
					$server = $server.":".$port;
				}
				$this->db = new PDO("mysql:host=".$server.";dbname=".$dbname,$username,$password);
				
			}
		}
		function select($table, $where="", $column="", $other=""){
			$data = array();
			if($where!=""){
				$where="WHERE ".$where;
			}
			if($column==""){
				$column="*";
			}
			$sql="SELECT ".$column." FROM ".$table." ".$where." ".$other;
			$this->sql = $sql;
			$this->MSLog->insert("Sorgu Yapıldı : ".$this->sql);
			$get = $this->db->query($sql);
			$get->execute();
			$data = $get->fetchAll();
			return $data;
		}
		public function insert($tablo,$satirlar=false,$degerler){
			$sql="INSERT INTO ".$tablo."(".$satirlar.") VALUES(".$degerler.")";
			if(!$satirlar){
				$sql="INSERT INTO ".$tablo." VALUES(".$degerler.")";
			}
			$this->sql = $sql;
			$this->MSLog->insert("Sorgu Yapıldı : ".$this->sql);
			return $this->db->query($sql);
		}
		public function update($tablo,$set,$where=false,$diger=false){
			if($where){
				$sql="UPDATE ".$tablo." SET ".$set." WHERE ".$where;
			}
			else{
				$sql="UPDATE ".$tablo." SET ".$set;
			}
			$this->sql = $sql;
			$this->MSLog->insert("Sorgu Yapıldı : ".$this->sql);
			return $this->db->exec($sql);
		}
		public function delete($tablo,$where=false){
			if($where){
				$sql="DELETE FROM ".$tablo." WHERE ".$where;
			}
			else{
				$sql="DELETE FROM ".$tablo;
			}
			$this->sql = $sql;
			$this->MSLog->insert("Sorgu Yapıldı : ".$this->sql);
			return $this->db->query($sql);
		}
		function query($query = false){
			if(is_string($query)){
				$this->db->query($query);
			}
		}
		function exec($query = false){
			if(is_string($query)){
				$this->db->exec($query);
			}
		}
		function lastInsertId(){
			$this->MSLog->insert("Son insert id çekildi : ".$this->db->lastInsertId());
			return $this->db->lastInsertId();
		}
	}
?>