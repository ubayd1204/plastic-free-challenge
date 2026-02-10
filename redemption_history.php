<?php
session_start();
include 'db.php';

// Only vendors can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'vendor') {
    header("Location: vendor_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Placeholder data for now
$redemptions = [
    ['student'=>'Aisha','reward'=>'10% Discount','date'=>'2026-01-01'],
    ['student'=>'Amir','reward'=>'Free Coffee','date'=>'2026-01-02'],
    ['student'=>'Govind','reward'=>'5% Discount','date'=>'2026-01-03'],
];

// Optional search filter
$filter = '';
if(isset($_GET['student']) && $_GET['student'] != '') {
    $filter = $_GET['student'];
    $redemptions = array_filter($redemptions, function($r) use($filter) {
        return stripos($r['student'], $filter) !== false;
    });
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reward Redemption History</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
  <div><strong>Plastic-Free Campus</strong></div>
  <div>
    <form action="logout.php" method="post" style="margin:0;">
      <button type="submit" style="
        background:#ffffff;
        color:#2e7d32;
        padding:6px 14px;
        border-radius:6px;
        border:none;
        font-weight:bold;
        cursor:pointer;
      ">
        Logout
      </button>
    </form>
  </div>
</div>

<!-- HERO SECTION -->
<div style="
  background: linear-gradient(135deg, #2e7d32, #66bb6a);
  padding: 60px 20px;
  text-align: center;
  color: white;
">
  <h1 style="
    font-size: 38px;
    margin-bottom: 10px;
    text-shadow: 0 3px 6px rgba(0,0,0,0.4);
  ">
    🎁 Reward Redemption History
  </h1>
  <p style="
    font-size: 18px;
    max-width: 600px;
    margin: auto;
    text-shadow: 0 2px 5px rgba(0,0,0,0.4);
  ">
    Track all rewards redeemed by students
  </p>
</div>

<div style="max-width:900px; margin:40px auto; padding:20px;">

  <!-- Search Form -->
  <form method="get" style="margin-bottom:20px;">
      <label>Search by Student:</label>
      <input type="text" name="student" placeholder="Enter student name" value="<?php echo htmlspecialchars($filter); ?>">
      <button type="submit" style="
        background:#2e7d32;
        color:white;
        border:none;
        padding:5px 12px;
        border-radius:6px;
        cursor:pointer;
      ">Search</button>
  </form>

  <!-- Redemption Table -->
  <table style="width:100%; border-collapse:collapse;">
      <thead>
          <tr style="background:#2e7d32; color:white;">
              <th style="padding:10px; text-align:left;">Student</th>
              <th style="padding:10px; text-align:left;">Reward</th>
              <th style="padding:10px; text-align:left;">Date</th>
          </tr>
      </thead>
      <tbody>
          <?php if(count($redemptions) > 0): ?>
              <?php foreach($redemptions as $r): ?>
                  <tr style="border-bottom:1px solid #ccc;">
                      <td style="padding:10px;"><?php echo $r['student']; ?></td>
                      <td style="padding:10px;"><?php echo $r['reward']; ?></td>
                      <td style="padding:10px;"><?php echo $r['date']; ?></td>
                  </tr>
              <?php endforeach; ?>
          <?php else: ?>
  <tr>
                  <td colspan="3" style="padding:10px; text-align:center;">No records found.</td>
              </tr>
          <?php endif; ?>
      </tbody>
  </table>

</div>

</body>
</html>
  
