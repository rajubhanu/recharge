<?php
session_start();
include 'config.php';

if (!isset($_SESSION['uid'])) {
    header('Location: index.php');
    exit;
}

// Fetch user
$u_result = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['uid']);
$u = $u_result->fetch_assoc();
if (!$u) {
    echo "<h4 class='text-danger'>❌ User not found! Please <a href='logout.php'>login again</a>.</h4>";
    exit;
}

// Fetch transactions and recharges
$txn = $conn->query("SELECT * FROM transactions WHERE user_id=" . $_SESSION['uid'] . " ORDER BY id DESC LIMIT 5");
$rechs = $conn->query("SELECT * FROM recharges WHERE user_id=" . $_SESSION['uid'] . " ORDER BY id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">
<h3 class="text-success">👋 Welcome <?php echo $u['name']; ?> </h3>
<h4>Wallet Balance: ₹<?php echo $u['wallet_balance']; ?></h4>
<a href="add-money.php" class="btn btn-success m-2">➕ Add Money</a>
<a href="recharge.php" class="btn btn-primary m-2">📱 Recharge</a>
<a href="logout.php" class="btn btn-outline-danger m-2">Logout</a>

<h5 class="mt-4">💳 Recent Transactions</h5>
<table class="table table-bordered">
    <tr><th>Type</th><th>Amount</th><th>Note</th><th>Date</th></tr>
    <?php while ($t = $txn->fetch_assoc()) {
        echo "<tr><td>{$t['type']}</td><td>₹{$t['amount']}</td><td>{$t['note']}</td><td>{$t['created_at']}</td></tr>";
    } ?>
</table>

<h5 class="mt-4">📱 Recent Recharges</h5>
<table class="table table-bordered">
    <tr><th>Number</th><th>Operator</th><th>Amount</th><th>Status</th><th>Date</th></tr>
    <?php while ($r = $rechs->fetch_assoc()) {
        echo "<tr><td>{$r['number']}</td><td>{$r['operator_code']}</td><td>₹{$r['amount']}</td><td>{$r['status']}</td><td>{$r['created_at']}</td></tr>";
    } ?>
</table>
</body>
</html>
