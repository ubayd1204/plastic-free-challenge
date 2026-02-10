<?php
session_start();
include "db.php";

$error = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND role='vendor'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];
        header("Location: vendor_dashboard.php");
        exit();
    } else {
        $error = "Invalid vendor credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vendor Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
    <h2>Vendor Login</h2>

    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="vendor_login.php">

  <div style="display:flex; justify-content:center;">
    <input type="email" name="email" placeholder="Email" required style="width:85%;">
  </div>

  <div style="display:flex; justify-content:center;">
    <input type="password" name="password" placeholder="Password" required style="width:85%;">
  </div>

  <div style="display:flex; justify-content:center;">
    <button type="submit" name="login" style="width:85%;">Login</button>
  </div>

</form>

</div>

<script src="script.js"></script>
</body>
</html>
