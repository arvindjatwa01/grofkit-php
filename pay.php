<?php

// $price = $finalAMount;

$whole = intval($finalAMount)*100; // 1234
$decimal1 = $finalAMount*100 - $whole;
$descimal2 = round($decimal1);
require('./pay_config.php');
require('./razorpay-php/Razorpay.php');
// session_start();
use Razorpay\Api\Api;
$api = new Api($keyId, $keySecret);
$orderData = [
    'receipt'         => 3456,
    'amount'          => $whole + $descimal2,
    'currency'        => 'INR',
    'payment_capture' => 1
];
$razorpayOrder = $api->order->create($orderData);


$razorpayOrderId = $razorpayOrder['id'];
$_SESSION['razorpay_order_id'] = $razorpayOrderId;
$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR') {
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}
$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "Grocery Order",
    "description"       => "Grocery Order From grofkit.in",
    "image"             => "",
    "prefill"           => [  
    "name"              => "",
    "email"             => "$userEmailId",
    "contact"           => "$userMobileNo",
    ],
    "notes"             => [
    "address"           => "Bapu Nagar",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];
if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

?>