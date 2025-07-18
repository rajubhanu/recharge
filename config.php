<?php
$host = "db4free.net";
$user = "rajubingi";
$pass = "Rajubhanu@12";
$db = "recharge";
$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error){ die("DB Error: ".$conn->connect_error); }

// A1Topup API credentials
define("A1_URL","https://business.a1topup.com/recharge/api");
define("A1_USER","8919238651");
define("A1_PASS","bpdjsaje");

// Cashfree credentials
define("CF_ID","102029458ad184d09cc55aa2eb04920201");
define("CF_SECRET","cfsk_ma_prod_7210d476d060bab1e9c843296f516e4f_ec34a081");
?>
