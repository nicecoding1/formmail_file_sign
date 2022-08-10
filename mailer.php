<?php

include('./class.phpmailer.php');

function mailer($from, $from_email, $to, $to_email, $subject, $content, $files) {
	$content = nl2br($content);

	$mail = new PHPMailer(true);
	$mail->IsSendmail();

	try {
		$mail->CharSet    = "utf-8";
		$mail->Encoding   = "base64";
		$mail->AddAddress($to_email, $to);
		$mail->SetFrom($from_email, $from);
		$mail->AddReplyTo($from_email, $from);
		$mail->Subject = $subject;
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		$mail->MsgHTML($content);
		if($files[1] != "") $mail->AddAttachment("./temp/".$files[1]);
		if($files[2] != "") $mail->AddAttachment("./temp/".$files[2]);
		if($files[3] != "") $mail->AddAttachment("./temp/".$files[3]);
	
		$mail->Send();
		return true;
	} catch (phpmailerException $e) {
		echo $e->errorMessage();
		return false;
	} catch (Exception $e) {
		echo $e->getMessage();
		return false;
	}
}

?>

