<?php
	namespace MS;
	use MS\MSCore;
	use get;
	class MSLog extends MSCore{
		function __construct($Log = false){
			parent::__construct();
			if($Log and get::config("Log") == "on"){
				$this->insert($Log);
			}
		}
		function ClearLog(){
			if(is_dir(APPLICATION_PATH."/Logs")){
				$opendir = opendir(APPLICATION_PATH."/Logs");
				while($file = readdir($opendir)){
					if($file != "." or $file!=".."){
						unlink(APPLICATION_PATH."/Logs/".$file);
					}
				}
			}
		}
		function insert($Log = false){
			$date = date("d.m.Y");
			if(!is_dir(APPLICATION_PATH."/Logs")){
				mkdir(APPLICATION_PATH."/Logs");
			}
			if($Log and get::config("Log") == "on"){
				if(is_array($this->url)){
					$url = implode("/",$this->url);
				}
				else{
					$url = $this->welcomeController;
				}
				$Log = date("H.i.s")."\t : ".$_SERVER["REMOTE_ADDR"]." \t ".$Log." FROM : ".$url;
				$file = APPLICATION_PATH."/Logs/".$date.".txt";
				if(file_exists($file)){
					$filetxt = file_get_contents($file,"r");
					$openfile = fopen($file,"w");
					fwrite($openfile,$filetxt.$Log."\n");
					fclose($openfile);
				}
				else{
					$openfile = fopen($file,"w");
					fwrite($openfile,$Log."\n");
					fclose($openfile);
				}
			}
			else{
				
			}
		}
	}
?>