<?php 
/*	this file is used to send mails to recipent based on the function called
	functions :
			  1. send_passcode($email); used to send passcode when forgot password
			  2. send_email($email_recipients, $email_sender, $reply_to, $subject, $content); used to send mails to actors for auditions 	 

*/	

include_once('../invite/phpmailer/PHPMailerAutoload.php');
//ini_set('display_errors', '1');
//send_passcode definition
function send_passcode($email)
{
	$mail = new PHPMailer();
	$length = 10;
	$mail->SMTPDebug = 2;                               // Enable verbose debug output
	$mail->Debugoutput = 'html';
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);//activation key                                  // Set mailer to use SMTP
	$mail->Host = 'relay-hosting.secureserver.net';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = 'false';                               // Enable SMTP authentication
	$mail->Username = 'no-reply@castiko.com';                 // SMTP username
	$mail->Password = '1q2w3e4rA';                           // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 25;                                    // TCP port to connect to

	$mail->setFrom('no-reply@castiko.com', 'Confirmation Code');
	$mail->addAddress("prasht63@gmail.com");     // Add a recipient
	$mail->addReplyTo('no-reply@stageshastra.com', 'No Reply');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'One Time Pass Code | StageShastra';
	$mail->Body    = 'Here\'s you passcode '.$randomString ;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
    	echo 'Message could not be sent.';
    	echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent'+$randomString;
}
return $randomString;
}
send_passcode("prasht63@gmail.com");
function send_thanks($email, $username)
{
	$mail = new PHPMailer();
	$length = 10;
	$mail->SMTPDebug = 2;                               // Enable verbose debug output
	$mail->Debugoutput = 'html';
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);//activation key
	//$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = '';                 // SMTP username
	$mail->Password = '';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('no-reply@stageshastra.com', 'StageShastra');
	$mail->addAddress($email);     // Add a recipient
	$mail->addReplyTo('no-reply@stageshastra.com', 'No Reply');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Thank you for Signing Up | StageShastra';
	$mail->Body    = "Hey $username, <h3>We are glad to hear from you<br>We will get back to you within 24 hours<br></h3>Team StageShastra ";
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
    	echo '403';
} else {
    echo '200';
}
}
function send_audition($subject,$message,$mailto,$replyto)
{
	$mail = new PHPMailer();
	$length = 10;
	//$mail->SMTPDebug = 2;                               // Enable verbose debug output
	$mail->Debugoutput = 'html';
	$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);//activation key
	//$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = '';                 // SMTP username
	$mail->Password = '';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('no-reply@stageshastra.com', 'StageShastra | Auditions');
	$addr = explode(',',$mailto);
	foreach ($addr as $ad) {
    	$mail->AddAddress( trim($ad) );       
	}
	//$mail->addAddress($email);     // Add a recipient
	$mail->addReplyTo($replyto, '');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = $subject;
	$mail->Body    = $message;
	$mail->AltBody = $message;

	if(!$mail->send()) {
    	echo '403';
} else {
    echo '200';
}
}


 
					
?>