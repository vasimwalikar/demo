<?php
	$api_key = "Acd968dd554b8f2c96340776740ed9142";
	$sender = "CCMSGS";

	//get form data
	$number = $_POST['number'];
	$message = $_POST['message'];
	$vars = "method=sms&api_key=".$api_key."&to=".$number."&sender=".$sender."&message=".$message."";

	if($_POST['submitted']=="true"){
		//echo "submitted !!!";
		//$curl = curl_init('http://api-alerts.solutionsinfini.com/v3/');
		$curl = curl_init('http://alerts.campusconnect.co/api/v4/');
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $vars);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($curl);
		curl_close($curl);
		die("sms has sent");
	}

?>

<!-- http://alerts.campusconnect.co/api/v4/?api_key=Acd968dd554b8f2c96340776740ed9142&method=sms&message=Test+sms&to=919986679788&sender=CCMSGS -->

<!DOCTYPE html>
<html>
	<head>
		<title>sms integration test</title>
	</head>
	<body>
		<h1>This is sms integration sample code</h1>
		<form action="" method="post">
			Number:<br>
			<input type="text" name="number">
			<br>Message:<br>
			<textarea name="message"></textarea><br><br>
			<input type="hidden" name="submitted" value="true">
			<input type="submit" name="submit" value="send">
		</form>
	</body>
</html>