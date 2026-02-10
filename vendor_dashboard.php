<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'vendor') {
    header("Location: vendor_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "
SELECT 
    users.username,
    vendor_details.shop_name,
    vendor_details.location,
    vendor_details.discount_offer
FROM users
JOIN vendor_details ON users.user_id = vendor_details.user_id
WHERE users.user_id = $user_id
";

$result = mysqli_query($conn, $sql);
$vendor = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Vendor Dashboard</title>
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
    🏪 Welcome, <?php echo $vendor['shop_name']; ?>
  </h1>

  <p style="
    font-size: 18px;
    max-width: 600px;
    margin: auto;
    text-shadow: 0 2px 5px rgba(0,0,0,0.4);
  ">
    Thank you for supporting sustainable and plastic-free practices 🌱
  </p>
</div>

<!-- DASHBOARD -->
<div class="dashboard-container">
  <div class="grid">

    <div class="dash-card">
      <h3>📍 Location</h3>
      <p><?php echo $vendor['location']; ?></p>
    </div>

    <div class="dash-card">
      <h3>♻ Eco Offer</h3>
      <p><?php echo $vendor['discount_offer']; ?></p>
    </div>

    <a href="add_reward.php" class="dash-card">
      <h3>🎁 Add Reward</h3>
      <p>Create eco-friendly rewards for students</p>
    </a>

    <a href="redemption_history.php" class="dash-card">
  <h3>📋 View Reward Redemptions</h3>
  <p>See all rewards redeemed by students</p>
    </a>

    <div class="dash-card">
      <h3>🌍 Vendor Impact</h3>
      <p>
        Encouraging reusable products and reducing single-use plastics on campus
      </p>
    </div>

  </div>
</div>
<!-- MENU SECTION -->
<div style="max-width:900px; margin:40px auto; padding:20px;">

<?php if ($vendor['shop_name'] === 'Green Campus Café') { ?>

  <!-- GREEN CAMPUS CAFE MENU -->
  <div style="
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
  ">
    <h2 style="color:#2e7d32; text-align:center;">
      ☕ Green Campus Café Menu
    </h2>
    <p style="text-align:center; color:#555;">
      Fresh • Sustainable • Plastic-Free
    </p>

    <hr>

    <h3>🥪 Food</h3>
    <ul style="list-style:none; padding:0;">
      <li>🥐 Wholegrain Croissant <span style="float:right;">RM 6</span></li>
      <li>🥗 Vegan Garden Salad <span style="float:right;">RM 10</span></li>
      <li>🍝 Mushroom Aglio Olio <span style="float:right;">RM 14</span></li>
    </ul>

    <h3>☕ Drinks</h3>
    <ul style="list-style:none; padding:0;">
      <li>☕ Organic Latte <span style="float:right;">RM 7</span></li>
      <li>🍵 Matcha Green Tea <span style="float:right;">RM 8</span></li>
      <li>🥤 Fresh Lemonade <span style="float:right;">RM 5</span></li>
    </ul>

    <p style="margin-top:20px; font-style:italic; color:#2e7d32;">
      ♻ 10% discount when you bring your reusable cup!
    </p>
  </div>

<?php } else { ?>

  <!-- ECO FRIENDLY SHOP MENU -->
  <div style="
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
  ">
    <h2 style="color:#2e7d32; text-align:center;">
      🛍 Eco Friendly Shop
    </h2>
    <p style="text-align:center; color:#555;">
      Sustainable Products for a Greener Life
    </p>

    <hr>

    <h3>🌱 Reusable Items</h3>
    <ul style="list-style:none; padding:0;">
      <li>🥤 Reusable Water Bottle <span style="float:right;">RM 25</span></li>
      <li>🍱 Bamboo Lunch Box <span style="float:right;">RM 30</span></li>
      <li>🛍 Cloth Shopping Bag <span style="float:right;">RM 12</span></li>
    </ul>

    <h3>🧴 Eco Essentials</h3>
    <ul style="list-style:none; padding:0;">
      <li>🪥 Bamboo Toothbrush <span style="float:right;">RM 6</span></li>
      <li>🧼 Natural Soap Bar <span style="float:right;">RM 8</span></li>
      <li>🕯 Soy Wax Candle <span style="float:right;">RM 15</span></li>
    </ul>

    <p style="margin-top:20px; font-style:italic; color:#2e7d32;">
      🌍 Save the planet — one product at a time
    </p>
  </div>

<?php } ?>

</div>



</body>
</html>
