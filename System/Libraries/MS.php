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
	class MS{
		static function t($string = false,$array = false){
			if(!isset($_SESSION["lang"])){
				return $string;
			}
			else{
				$lang = $_SESSION["lang"];
			}
			if(file_exists(APPLICATION_PATH."Languages/".$lang.".php")){
				$langArray = include APPLICATION_PATH."Languages/".$lang.".php";
			}
			if($string){
				if($array){
					if(isset($langArray[$string])){
							$string = $langArray[$string];
							foreach($array as $key=>$value){
							$string = str_replace("[".$key."]",$value,$string);
						}
						return $string;
					}
					else{
						self::addKey($string);
						return $string;
					}
				}
				else{
					if(isset($langArray[$string])){
						return $langArray[$string];
					}
					else{
						self::addKey($string);
						return $string;
					}
				}
			}
		}
		static function addKey($string = ""){
			if($string != ""){
				$LanguageDir = opendir(APPLICATION_PATH."/Languages");
				while($LanguageFile = readdir($LanguageDir)){
					if($LanguageFile == "." or $LanguageFile == ".."){}
					else if(is_file(APPLICATION_PATH."/Languages/".$LanguageFile)){
						$langArray = include APPLICATION_PATH."/Languages/".$LanguageFile;
						if(is_array($langArray)){
							$count = count($langArray);
							$sayac = 0;
							$openFile = fopen(APPLICATION_PATH."/Languages/".$LanguageFile,"w+");
							fwrite($openFile,"<?php
return array(");
							foreach($langArray as $key=>$value){
								if($sayac != $count-1){
									fwrite($openFile,'
	"'.$key.'" => "'.$value.'",');
								}
								else{
									fwrite($openFile,'
	"'.$key.'" => "'.$value.'"');
								}
								$sayac++;
							}
							if(!array_key_exists($string,$langArray)){
								if($count === 0){
									fwrite($openFile,'
	"'.$string.'" => "'.$string.'"');
								}
								else{
									fwrite($openFile,',
	"'.$string.'" => "'.$string.'"');
								}
							}
							fwrite($openFile,"
);
?>");
						}
						else{
							$openFile = fopen(APPLICATION_PATH."/Languages/".$LanguageFile,"w+");
							fwrite($openFile,"<?php return array(
); ?>");
						}
					}
				}
			}
		}
	}
?>