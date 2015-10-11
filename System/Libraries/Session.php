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
	class Session{
		static function start(){
			session_start();
		}
		static function set($key = false, $value = ""){
			if($key){
				$_SESSION[$key] = $value;
			}
		}
		static function get($key = false){
			if($key and isset($_SESSION[$key])){
				return $_SESSION[$key];
			}
			else{
				return false;
			}
		}
		static function selectAll(){
			return $_SESSION;
		}
		static function delete($key = false){
			if($key){
				if(isset($_SESSION[$key])){
					unset($_SESSION[$key]);
				}
			}
		}
		static function destroy(){
			session_destroy();
		}
	}
?>