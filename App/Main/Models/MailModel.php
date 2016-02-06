<?php
	namespace Models;
	use MS\MSModel;
	use PHPMailer;
	class MailModel extends MSModel{
		function __construct(){
			parent::__construct();
			
		}
		function veriler(){
			/*$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPDebug = 2;
			$mail->DebugOutput = "html";
			$mail->host = "mail.mcolak.net";
			$mail->Port = 587;
			$mail->SMTPSecure = "tls";
			$mail->SMTPAuth = true;
			$mail->Username = "mustafac@mcolak.net";
			$mail->Password = "a05466329428a";
			$mail->SetFrom("mustafac@mcolak.net","Mustafa Ç.");
			$mail->AddAddress("musto_220@windowslive.com","Gönderilen?");
			$mail->Subject = "test maili";
			$mail->msgHTML('<b>Test maili geliyor :D </b>');
			if($mail->send()){
				echo '<font color=green>mail gönderildi</font>';
			}
			else{
				echo "<font color=red>mail gönderilemedi</font><br/>";
				echo "<b>".$mail->ErrorInfo."</b>";
			}
			*/
			$test = $this->select("testtablo");
			var_dump($test);
		}
	}
?>