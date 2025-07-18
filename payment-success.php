<?php
session_start();
include 'config.php';
if (!isset($_SESSION['uid'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Payment Success</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">
  <h3 class="text-success">✅ Payment Successful!</h3>
  <p>Your wallet has been updated.</p>
  <a href="dashboard.php" class="btn btn-success mt-3">Go to Dashboard</a>
</body>
</html>
