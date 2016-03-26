<?php
	class System{
		public $Message = "";
		function System(){
			
		}
		function newApplication(){
			$AppName = Form::get("AppName");
			if($AppName){
				// klasörleri oluştursun
			}
		}
		function deleteApplication(){
			
		}
		function updateMvc(){
			$UpdateArray = @file_get_contents("http://localhost/MSMVC/Updates/1.0.0.php","r");
			$MkDir = array();
			$SourceFiles = array();
			$AppDirs = array();
			$SystemDirs = array();
			$AppFiles = array();
			$SystemFiles = array();
			if(!empty($UpdateArray)){
				$UpdateArray = json_decode($UpdateArray,1);
				if(isset($UpdateArray["MkDir"])){
					$MkDir = $UpdateArray["MkDir"];
				}
				if(isset($UpdateArray["SourceFiles"])){
					$SourceFiles = $UpdateArray["SourceFiles"];
				}
				if(isset($MkDir["AppDirs"])){
					$AppDirs = $MkDir["AppDirs"];
				}
				if(isset($MkDir["SystemDirs"])){
					$SystemDirs = $MkDir["SystemDirs"];
				}
				if(isset($SourceFiles["AppFiles"])){
					$AppFiles = $SourceFiles["AppFiles"];
				}
				if(isset($SourceFiles["SystemFiles"])){
					$SystemFiles = $SourceFiles["SystemFiles"];
				}
				for($i = 0; $i<count($AppDirs);$i++){
					$NewDir = @mkdir(APPLICATION_PATH."/".$AppDirs[$i]);
					if($NewDir){
						$this->Message.= '<font color="green">'.APPLICATION_PATH."/".$AppDirs[$i]." dir created </font><br/>";
					}
					else{
						$this->Message.='<font color="red">'.APPLICATION_PATH."/".$AppDirs[$i]." dir can't created</font><br/>";
					}
				}
				for($i = 0; $i<count($SystemDirs);$i++){
					$NewDir = @mkdir(SYSTEM_PATH."/".$SystemDirs[$i]);
					if($NewDir){
						$this->Message.= '<font color="green">'.SYSTEM_PATH."/".$AppDirs[$i]." dir created </font><br/>";
					}
					else{
						$this->Message.='<font color="red">'.SYSTEM_PATH."/".$AppDirs[$i]." dir can't created</font><br/>";
					}
				}
				for($i = 0;$i<count($AppFiles);$i++){
					$copy = copy($AppFiles[$i]["Source"],APPLICATION_PATH."/".$AppFiles[$i]["Target"]);
					if($copy){
						$this->Message.= '<font color="green">'.APPLICATION_PATH."/".$AppFiles[$i]["Target"]." file created </font><br/>";
					}
					else{
						$this->Message.='<font color="red">'.APPLICATION_PATH."/".$AppFiles[$i]["Target"]." file can't created</font><br/>";
					}
				}
				for($i = 0;$i<count($SystemFiles);$i++){
					$copy = copy($SystemFiles[$i]["Source"],SYSTEM_PATH."/".$SystemFiles[$i]["Target"]);
					if($copy){
						$this->Message.= '<font color="green">'.SYSTEM_PATH."/".$AppFiles[$i]["Target"]." file created </font><br/>";
					}
					else{
						$this->Message.='<font color="red">'.SYSTEM_PATH."/".$AppFiles[$i]["Target"]." file can't created</font><br/>";
					}
				}
			}
		}
	}
?>