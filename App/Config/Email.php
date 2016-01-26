<?php
/************************************************************/
/*                      EMAIL(E-POSTA)                      */
/************************************************************/
/*

Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* EMAIL SETTINGS                                    									  *
*******************************************************************************************
| E-posta ile ilgili ayarlar yer almaktadır.					                          |
|          																				  |
******************************************************************************************/
$config['Email'] = array
(
	'SmtpHost'			=> '',
	'SmtpUsername'			=> '',
	'SmtpPassword'		=> '',
	'SmtpPort'			=> 587,
	'SmtpKeepAlive'		=> false,
	'SmtpTimeout'		=> 10,
	'SmtpSecure'		=> 'tls',	// tls, ssl
	'SenderMail'		=> '',
	'SenderName'		=> '',
	'WordWrap'			=> true,
	'CharWrap'			=> 80,
	'Validate'			=> true,
	'Eol'				=> "\n",
	'Dsn'				=> false,
	'Priority'	   		=> 3,		// 1, 2, 3, 4, 5
	'ProtocolType' 		=> 'mail',  // mail, smtp
	'ContentType'		=> 'text',  // text, html
	'Charset'			=> 'UTF-8',
	'MultiPart'			=> 'mixed', // mixed, related
	'SendMultiPart'		=> true,
	'MailPath'			=> '/usr/sbin/sendmail',
	'BccStackMode'		=> false,
	'BccStackSize'		=> 200,
	'AltContent'		=> '',
	'MbEnabled'			=> true,
	'IconvEnabled'		=> true,
	'XMailer'			=> 'ZN',
);
