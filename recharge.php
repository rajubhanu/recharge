<?php
session_start();include 'config.php';
if(!isset($_SESSION['uid'])){header('Location:index.php');exit;}
$wallet=$conn->query("SELECT wallet_balance FROM users WHERE id=".$_SESSION['uid'])->fetch_assoc()['wallet_balance'];
if($_SERVER['REQUEST_METHOD']=='POST'){
  $m=$_POST['mobile'];$op=$_POST['operator'];$amt=floatval($_POST['amount']);
  if($wallet<$amt){$msg="<div class='alert alert-danger'>Insufficient Balance</div>";}
  else{
    $orderid='RCG'.time();
    $url=A1_URL."?username=".A1_USER."&pwd=".A1_PASS."&number=$m&amount=$amt&operatorcode=$op&orderid=$orderid&format=json";
    $res=json_decode(file_get_contents($url),true);
    $status=$res['status']??'FAILED';$txid=$res['txid']??'';
    if(strtoupper($status)=='SUCCESS'){
      $conn->query("UPDATE users SET wallet_balance=wallet_balance-$amt WHERE id=".$_SESSION['uid']);
    }
    $conn->query("INSERT INTO recharges(user_id,operator_code,number,amount,status,txid) VALUES (".$_SESSION['uid'].",'$op','$m','$amt','$status','$txid')");
    $msg="<div class='alert alert-info'>Recharge $status (TXID:$txid)</div>";
    $wallet=$conn->query("SELECT wallet_balance FROM users WHERE id=".$_SESSION['uid'])->fetch_assoc()['wallet_balance'];
  }
}
$ops=$conn->query("SELECT * FROM operators");
?>
<!DOCTYPE html><html><head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></head>
<body class="bg-light p-4">
<h3 class="text-success">📱 Mobile Recharge</h3>
<?php if(isset($msg))echo$msg;?>
<form method="post" class="card p-3" style="max-width:400px;">
<input name="mobile" class="form-control mb-2" placeholder="Mobile Number" required>
<select name="operator" class="form-select mb-2">
<?php while($o=$ops->fetch_assoc()){echo"<option value='{$o['code']}'>{$o['name']}</option>";}?>
</select>
<input type="number" name="amount" class="form-control mb-2" placeholder="Amount" required>
<button class="btn btn-success w-100">Recharge</button>
</form>
<a href="dashboard.php" class="btn btn-outline-success mt-3">⬅ Back</a>
</body></html>