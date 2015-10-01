<?php
	namespace Models;
	use MS\MSModel;
	class AnasayfaModel extends MSModel{
		function __construct(){
			parent::__construct();
			
		}
		function veriler(){
			$data["title"]="anasayfabaşlık";
			$data["testVeri"]=$this->select("testtablo","","id,veri");
			$veriler = $data["testVeri"];
			$json = json_encode($veriler);
			$decode = json_decode($json);
			foreach($decode as $d){
				echo $d->id."::".$d->veri."<br/>";
			}
			return $data;
		}
	}
?>