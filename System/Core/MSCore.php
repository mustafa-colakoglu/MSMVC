<?php
/**
	* MSMVC
	* @package MSmvc
	* @author Mustafa Çolakoğlu
	* @since Version 1.0

//---------------------------------------------------------------------------

	* msMVC MSCore
	* @package msMVC
	* @subpackage core
	* @author Mustafa Çolakoğlu
	
**/
	namespace MS;
	use Form;
	use System;
	class MSCore{
		function __construct(){
			require APPLICATION_PATH."Config/SiteInfo.php";
			if(Form::get("System")){
				$System = new System;
				$Method = Form::get("System");
				if(method_exists($System,$Method)){
					$System->$Method();
				}
				exit;
			}
			if($config["SiteInfo"]["welcomeController"]){
				$this->welcomeController = $config["SiteInfo"]["welcomeController"];
			}
			else{
				$this->welcomeController = "Main";
			}
			if(Form::get("url")){
				$url = Form::get("url");
			}
			else{
				$url = "";
			}
			$url=rtrim($url,"/");
			$url=ltrim($url,"/");
			if(strlen($url) === 0){
				$url = "";
			}
			else{
				$url=explode("/",$url);
			}
			$this->url = $url;
			$this->site = $config["SiteInfo"]["site"];
			$this->Uselib = new MSUselib();
		}
		function getMessage($title=false,$detail=false){
			if(ALERTS=="on"){
				echo '<table style="background:#bbb;" border=0>
					<tr>
						<td style="background:red;color:white;">'.$title.'</td>
					</tr>
					<tr>
						<td style="background:#bbb;color:#121212;">'.$detail.'</td>
					</tr>
				</table>';
			}
		}
	}
//---------------------------------------------------------------------------
/* End of file MSCore.php */
/* Location : ./system/core/MSCore.php*/
?>