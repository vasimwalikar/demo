<?php
require_once('fonepaisa.php');

function verify_confirmpayment(){
/*Code for verifying the confirmation*/
	$retval=fonepaisa_verifymsg(array(
			'invoice'=>'',
			'payment_reference'=>'',
			'sign' => '',
			'public_key' => 'file://fonepaisa.pub'
		));
	if ($retval == true) {
		echo "Message is verified";
	}
	else {
		echo "Message is un verified";
	}
	
}
exit
?>
