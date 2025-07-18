<?php
include 'config.php';
$data = json_decode(file_get_contents('php://input'), true);
if (!$data) { http_response_code(400); exit; }

$orderId = $data['order']['order_id'] ?? '';
$status = $data['order']['order_status'] ?? '';
$amount = $data['order']['order_amount'] ?? 0;

if ($orderId && $status == 'PAID') {
    $res = $conn->query("SELECT user_id FROM pending_orders WHERE order_id='$orderId'");
    if ($res->num_rows > 0) {
        $uid = $res->fetch_assoc()['user_id'];
        $conn->query("UPDATE users SET wallet_balance = wallet_balance + $amount WHERE id = $uid");
        $conn->query("INSERT INTO transactions(user_id, type, amount, note) VALUES ($uid, 'credit', $amount, 'Cashfree Order:$orderId')");
        $conn->query("DELETE FROM pending_orders WHERE order_id='$orderId'");
    }
}
http_response_code(200);
echo "OK";
