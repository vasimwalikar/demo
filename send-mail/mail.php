<?php 

	$to = 'vasim@freenet.zone, shreeshreedhar@gmail.com,sridhar.rajaram@justbooksclc.com';
	       
	$subject = 'test email for signup';

	$msg = '' ;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, 'api:key-1-j3498psszetjazh3-e1o5c6qgn60v4');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_URL,
	    'https://api.mailgun.net/v3/mail.freenet.zone/messages');
	curl_setopt($ch, CURLOPT_POSTFIELDS,
	    array('from' => 'auto-confirmation@freenet.zone <auto-confirmation@freenet.zone>',
	            'to' => '' . $to . '',
	            'subject' => '' . $subject . '',
	            'html' => '' . $msg . ''));
	$result1 = curl_exec($ch);
	//echo json_encode($result1);
	curl_close($ch);

?>
