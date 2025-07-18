<?php
session_start();
include 'config.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
  $email=$_POST['email'];$pass=$_POST['password'];
  $q=$conn->query("SELECT * FROM users WHERE email='$email' AND password='$pass'");
  if($q->num_rows>0){$_SESSION['uid']=$q->fetch_assoc()['id'];header('Location:dashboard.php');exit;}
  else $error="Invalid";
}
?>
<!DOCTYPE html><html><head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head><body class="bg-light p-4">
<div class="container" style="max-width:400px;">
<h3 class="text-success mb-3">🔑 Login</h3>
<?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
<form method="post">
<input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
<button class="btn btn-success w-100">Login</button>
</form>
<p class="mt-3">No account? <a href="register.php">Register</a></p>
</div>
</body></html>