<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('Location:index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Money</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="text-success mb-4">💰 Add Money to Wallet</h2>

    <form method="post" action="create-upi-order.php">
        <div class="mb-3">
            <label class="form-label">Choose Amount:</label><br>
            <button name="amount" value="500" class="btn btn-success m-1">₹500</button>
            <button name="amount" value="1000" class="btn btn-success m-1">₹1000</button>
            <button name="amount" value="1500" class="btn btn-success m-1">₹1500</button>
            <button name="amount" value="2000" class="btn btn-success m-1">₹2000</button>
        </div>

        <div class="my-4">
            <label for="customAmount" class="form-label">Or Enter Custom Amount:</label>
            <input type="number" name="amount" id="customAmount" class="form-control" min="1" step="1" placeholder="Enter amount (e.g. 500)">
            <button type="submit" class="btn btn-primary mt-3">Proceed to Payment</button>
        </div>
    </form>

    <a href="dashboard.php" class="btn btn-outline-secondary mt-4">⬅ Back to Dashboard</a>
</div>
</body>
</html>
