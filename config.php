<?php
$host = "dpg-d1stp83uibrs738lbtkg-a";
$user = "recharge_portal_user";
$pass = "8rp5Wou2Vu1h3jPhKOxbAKROa4lfVqrB";
$db = "recharge_portal";
$port = '5432'; // PostgreSQL port

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
// A1Topup API credentials
define("A1_URL","https://business.a1topup.com/recharge/api");
define("A1_USER","8919238651");
define("A1_PASS","bpdjsaje");

// Cashfree credentials
define("CF_ID","102029458ad184d09cc55aa2eb04920201");
define("CF_SECRET","cfsk_ma_prod_7210d476d060bab1e9c843296f516e4f_ec34a081");
?>
