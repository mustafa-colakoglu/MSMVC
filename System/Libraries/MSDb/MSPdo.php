<?php
	namespace MS;
	use MS\MSLoad;
	use PDO;
	class MSPdo extends MSLoad{
		var $db;
		function __construct(){
			parent::__construct();
			require APPLICATION_PATH."Config/Database.php";
			if($config["Database"]["port"]){
				$config["Database"]["server"]=$config["Database"]["server"].":".$config["Database"]["port"];
			}
			$this->db = new PDO("mysql:host=".$config["Database"]["server"].";dbname=".$config["Database"]["dbname"],$config["Database"]["username"],$config["Database"]["password"]);
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
			$this->sql = $sql;
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
			return $this->db->query($sql);
		}
		function lastInsertId(){
			return $this->db->lastInsertId();
		}
	}
?>