<?php
include 'config.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
  $n=$_POST['name'];$e=$_POST['email'];$p=$_POST['password'];
  $conn->query("INSERT INTO users(name,email,password) VALUES('$n','$e','$p')");
  echo "<h3>✅ Registered</h3><a href='index.php'>Login</a>";exit;
}
?>
<!DOCTYPE html><html><head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head><body class="bg-light p-4">
<div class="container" style="max-width:400px;">
<h3 class="text-success mb-3">📝 Register</h3>
<form method="post">
<input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
<input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
<button class="btn btn-success w-100">Register</button>
</form>
</div></body></html>