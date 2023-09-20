<?php
require_once "vendor/autoload.php";

use Omnipay\Omnipay;

define('CLIENT_ID', 'ATHwBeH162fRC3PkhQdW3kvcPEuRwAoMNXzoBUmqXjeqwuFbWsmi0TFmVGUz3BeG_aIYMT1yjbDdJNjY');
define('CLIENT_SECRET', 'EJRtNeJQSS5h-83BODuYMS2HcHS8ecOZo-KdL8sgwiOUjR-naGTASDz2IPRTxYBqAFnGQ499j0EiX6TX');

define('PAYPAL_RETURN_URL', 'http://localhost/paypal/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/paypal/cancel.php');
define('PAYPAL_CURRENCY', 'USD'); // set your currency here

// Connect with the database
$db = new mysqli('localhost', 'root', '', 'paypal'); 

if ($db->connect_errno) {
    die("Connect failed: ". $db->connect_error);
}

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live