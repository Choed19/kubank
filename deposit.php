<?php
session_start();
// ตรวจสอบว่าผู้ใช้ได้เข้าสู่ระบบหรือไม่ หากไม่ได้เข้าสู่ระบบให้ redirect ไปหน้า login
if (!isset($_SESSION['id'])) {
  header("Location: login.php");
}

// สร้างการเชื่อมต่อฐานข้อมูล
include "conDB.php";

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// รับฝากเงิน
if (isset($_POST['deposit'])) {
  $amount = $_POST['amount'];
  $new_balance = $user['balance'] + $amount;
  $sql = "UPDATE users SET balance='$new_balance' WHERE id='$user_id'";
  mysqli_query($conn, $sql);
  $user['balance'] = $new_balance;
  
      $datetime = date("Y-m-d H:i:s");
    // $sql = "INSERT INTO statement (id,user_id, created_at, status, value) VALUES (null, $user_id, $datetime,'Withdraw', $new_balance)";
    $sql = "INSERT INTO statement (id, user_id, created_at, status, value) VALUES (NULL, '$user_id', NOW(), 'Withdraw', $amount)";
    mysqli_query($conn, $sql);

  header("Location: http://localhost/kubank/home.php"); 
}


// ค้นหาข้อมูลผู้ใช้
if (isset($_POST['search'])) {
  $search_text = $_POST['search_text'];
  $sql = "SELECT * FROM users WHERE username LIKE '%$search_text%'";
  $result = mysqli_query($conn, $sql);
}

// แสดงข้อมูลผู้ฝาก
if (isset($_POST['show'])) {
  $sql = "SELECT * FROM users";
  $result = mysqli_query($conn, $sql);
}

?>

<h1>Welcome! , <?php echo $user['username']; ?></h1>
<p>Balance : <?php echo number_format($user['balance'], 2); ?> THB</p>
<a href="home.php"> <img src="img/logout.png" alt=""></a>

<h2>Deposit</h2>
<form method="post">
  <label for="amount"></label>
  <div class="money">
    <input type="number" id="amount" name="amount" placeholder="0.00">
</div>
  <div class="conmfirm">
    <button type="submit" name="deposit" onclick="return confirm('Are you confirm your money?');">Confirm</button>
  </div>
</form>