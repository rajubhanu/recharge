<?php
session_start();
include 'config.php';
if (!isset($_SESSION['uid'])) {
    header("Location: index.php");
    exit;
}

if (!isset($_POST['amount']) || !is_numeric($_POST['amount']) || $_POST['amount'] <= 0) {
    die("❌ Invalid amount");
}

$amount = number_format($_POST['amount'], 2, '.', '');
$orderId = "ORD" . time();
$customerId = "UID" . $_SESSION['uid'];

$conn->query("INSERT INTO pending_orders(order_id, user_id) VALUES('$orderId', " . $_SESSION['uid'] . ")");

$postData = [
    "order_id" => $orderId,
    "order_amount" => (float)$amount,
    "order_currency" => "INR",
    "order_meta" => [
        "return_url" => "http://brmrecharge.in/payment-success.php?order_id={order_id}",
        "notify_url" => "http://brmrecharge.in/payment-callback.php",
        "payment_methods" => "upi"
    ],
    "customer_details" => [
        "customer_id" => $customerId,
        "customer_email" => "demo@example.com",
        "customer_phone" => "9959416483"
    ]
];

$ch = curl_init("https://api.cashfree.com/pg/orders");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "x-client-id: 102029458ad184d09cc55aa2eb04920201",
    "x-client-secret: cfsk_ma_prod_7210d476d060bab1e9c843296f516e4f_ec34a081",
    "x-api-version: 2022-09-01"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
$response = curl_exec($ch);
curl_close($ch);

$res = json_decode($response, true);

if (isset($res['payment_link'])) {
    header("Location: " . $res['payment_link']);
    exit;
} else {
    echo "<h3>❌ Failed to create order</h3><pre>";
    print_r($res);
    echo "</pre>";
}
