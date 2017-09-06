<?php
require_once('fonepaisa.php');

fonepaisa_forward(array(
			'id'=>'FPTEST',
			'merchant_id'=>'FPTEST',
			'merchant_display'=>'fonePaisa Test Merchant',
			'invoice_amt' => '10.00',
			'amount' => '10.00',
			'email'=> '',
			'mobile_no'=> '',
			'callback_url'=>'https://test.fonepaisa.com/pgt/cfm.jsp',
			'callback_failure_url'=>'https://test.fonepaisa.com/pgt/fail.jsp',
			'invoice'=>'ORDER100',
			'api_key'=>'08Z1782051U62BY9OUGW4XM67GF2004',
			'private_key'=>'file://priv.pem',
			'public_key'=>'',
		));

exit
?>
