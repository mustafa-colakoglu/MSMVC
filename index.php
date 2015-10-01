<?php
/**
	* msMVC
	* @package msMVC
	* @author Mustafa Çolakoğlu
	* @since Version 1.0
**/
	define("SYSTEM_PATH","./System/");
	define("APPLICATION_PATH","./App/");
	define("ENVIRONMENT","development");
	if (defined('ENVIRONMENT'))
	{
		switch (ENVIRONMENT)
		{
			case 'development':
				error_reporting(E_ALL);
			break;
		
			case 'testing':
			case 'production':
				error_reporting(0);
			break;

			default:
				exit('The application environment is not set correctly.');
		}
	}
	require_once SYSTEM_PATH."/Core/MSCore.php";
//---------------------------------------------------------------------------
/* End of file index.php */
/* Location : ./index.php*/
?>