<?php
ob_start();
session_start();
require_once "../../admin/config.php";

$statement = $pdo->prepare("SELECT * FROM tbl_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$paypal_email = $row['paypal_email'];
}

$statement = $pdo->prepare("SELECT * FROM tbl_pricing_plan WHERE pricing_plan_id=?");
$statement->execute(array($_POST['pricing_plan_id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$item_amount = $row['pricing_plan_price'];
}

$return_url = 'http://a3devs.com/99/payment/paypal/payment_success.php';
$cancel_url = 'http://a3devs.com/99/payment/paypal/index.php';
$notify_url = 'http://a3devs.com/99/payment/paypal/verify_process.php';

$item_name = 'Cars';
//$item_amount = $_POST['item_price'];
$item_number = time();

$payment_date = $_POST['payment_date'];


// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
	$querystring = '';
	
	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";
	
	// Append amount& currency (£) to quersytring so it cannot be edited in html
	
	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "amount=".urlencode($item_amount)."&";
	$querystring .= "item_number=".urlencode($item_number)."&";
	
	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);
	
	// Append querystring with custom field
	//$querystring .= "&custom=".USERID;

	//$statement = $pdo->prepare("INSERT INTO payments (item_name, txnid, paid_amount, payment_status, payment_id) VALUES (?,?,?,?,?)");
	//$sql = $statement->execute(array($item_name,'',$item_amount,'Pending',$item_number));

	$statement = $pdo->prepare("INSERT INTO tbl_payment (seller_id,payment_date,timestamp_start,timestamp_end,txnid, paid_amount,pricing_plan_id,payment_status,payment_id) VALUES (?,?,?,?,?,?,?,?,?)");
	$sql = $statement->execute(array($_SESSION['seller']['seller_id'],$payment_date,$item_number,$item_number,'',$item_amount,$_POST['pricing_plan_id'],'Pending',$item_number));

	
	if($sql){
		// Redirect to paypal IPN
		header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
		exit();
	}
	
} else {

	// Response from Paypal

	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
		$req .= "&$key=$value";
	}
	
	// assign posted variables to local variables
	$data['item_name']			= $_POST['item_name'];
	$data['item_number'] 		= $_POST['item_number'];
	$data['payment_status'] 	= $_POST['payment_status'];
	$data['payment_amount'] 	= $_POST['mc_gross'];
	$data['payment_currency']	= $_POST['mc_currency'];
	$data['txn_id']			    = $_POST['txn_id'];
	$data['receiver_email'] 	= $_POST['receiver_email'];
	$data['payer_email'] 		= $_POST['payer_email'];
	$data['custom'] 			= $_POST['custom'];
		
	// post back to PayPal system to validate
	$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	
	$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
	
	if (!$fp) {
		// HTTP ERROR
		
	} else {
		fputs($fp, $header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);
			if (strcmp($res, "VERIFIED") == 0) {
				
				// Used for debugging
				// mail('user@domain.com', 'PAYPAL POST - VERIFIED RESPONSE', print_r($post, true));
				
			
			} else if (strcmp ($res, "INVALID") == 0) {
			

				// PAYMENT INVALID & INVESTIGATE MANUALY!
				// E-mail admin or alert user
				
				// Used for debugging
				//@mail("user@domain.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
			}
		}
	fclose ($fp);
	}
}