<?php
//start session in all pages
if (session_status() == PHP_SESSION_NONE) { session_start(); } //PHP >= 5.4.0
//if(session_id() == '') { session_start(); } //uncomment this line if PHP < 5.4.0 and comment out line above

$PayPalMode 			= 'sandbox'; // sandbox or live
$PayPalApiUsername 		= 'connecttechfocus-facilitator_api1.gmail.com'; //PayPal API Username
$PayPalApiPassword 		= 'Q4FURL5NP9DQSZWW'; //Paypal API password
$PayPalApiSignature 	= 'AFcWxV21C7fd0v3bYYYRCpSSRl31AaFkiY2uy2QRJH1-idXRT4sbfPm3'; //Paypal API Signature
$PayPalCurrencyCode 	= 'USD'; //Paypal Currency Code
$PayPalReturnURL 		= 'http://cpa.local.com/payment/process.php'; //Point to process.php page
$PayPalCancelURL 		= 'http://cpa.local.com/payment/cancel_url.php'; //Cancel URL if user clicks cancel
?>