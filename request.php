<?php
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ItemList;
use PayPal\Api\PayerInfo;


require 'config.php';

if (empty($_POST['item_number'])) {
    throw new Exception('This script should not be called directly, expected post data');
}
// Set some example data for the payment.
$email = $_POST['email'];
$currency = 'USD';
$item_qty = 1;
$amountPayable = $_POST['amount'];
$product_name = $_POST['item_name'];
$item_code = $_POST['item_number'];
$description = 'Paypal transaction';
$invoiceNumber = uniqid();
$my_items = array(
    array('name' => $product_name, 'quantity' => $item_qty, 'price' => $amountPayable, 'sku' => $item_code, 'currency' => $currency)
);

// Create a new payer object
$payer = new Payer();
$payer->setPaymentMethod('paypal');

// Set the payer's email
$payerInfo = new PayerInfo();
$payerInfo->setEmail($email); // Replace $email with the actual email from your session
$payer->setPayerInfo($payerInfo);

$amount = new Amount();
$amount->setCurrency($currency)
    ->setTotal($amountPayable);

$items = new ItemList();
$items->setItems($my_items);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription($description)
    ->setInvoiceNumber($invoiceNumber)
    ->setItemList($items);

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl($paypalConfig['return_url'])
    ->setCancelUrl($paypalConfig['cancel_url']);

$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions([$transaction])
    ->setRedirectUrls($redirectUrls);


try {
    $payment->create($apiContext);
} catch (Exception $e) {
    throw new Exception('Unable to create link for payment');
}

header('location:' . $payment->getApprovalLink());
exit(1);