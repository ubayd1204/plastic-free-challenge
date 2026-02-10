<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'vendor') {
    header("Location: vendor_login.php");
    exit();
}

$message = '';

if (isset($_POST['add_reward'])) {
    $reward_name = $_POST['reward_name'];
    $points = $_POST['points_required'];
    $vendor_id = $_SESSION['user_id'];

    $sql = "INSERT INTO rewards (vendor_id, name, points_required)
            VALUES ('$vendor_id', '$reward_name', '$points')";

    if (mysqli_query($conn, $sql)) {
        $message = "Reward added successfully!";
    } else {
        $message = "Error adding reward.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Add Reward for Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="card">
    <h2 style="text-align:center;">Add Reward for Student</h2>

    <!-- Success / Error Message -->
    <?php if($message != '') echo "<p style='text-align:center; color:green;'>$message</p>"; ?>

    <!-- Form -->
    <form method="POST" action="add_reward.php">

        <div style="display:flex; justify-content:center; margin-bottom:10px;">
            <input type="text" name="student_name" placeholder="Student Name" required style="width:85%;">
        </div>

        <div style="display:flex; justify-content:center; margin-bottom:10px;">
            <input type="text" name="reward_name" placeholder="Reward Name" required style="width:85%;">
        </div>

        <div style="display:flex; justify-content:center; margin-bottom:10px;">
            <input type="number" name="points_required" placeholder="Points Required" required style="width:85%;">
        </div>

        <div style="display:flex; justify-content:center;">
            <button type="submit" name="add_reward" style="width:85%;">Add Reward & Redeem</button>
        </div>

    </form>
</div>

</body>
</html>
