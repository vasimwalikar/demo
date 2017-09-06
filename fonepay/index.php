<?php
require_once('fonepaisa.php');

fonepaisa_forward(array(
			'id'=>'FPTEST',
			'merchant_id'=>'FPTEST',
			'merchant_display'=>'fonePaisa Test Merchant',
			'invoice_amt' => '10.00',
			'amount' => '10.00',
			'email'=> 'vasim@freenet.zone',
			'mobile_no'=> '8792241961',
			'callback_url'=>'http://localhost/fonepay/success.php',
			'callback_failure_url'=>'https://test.fonepaisa.com/pgt/fail.jsp',
			'invoice'=>time().rand(1000,99999),
			'api_key'=>'08Z1782051U62BY9OUGW4XM67GF2004',
			'private_key'=>'file://priv.pem',
			'public_key'=>'',
		));

exit
?>
