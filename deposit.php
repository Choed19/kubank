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
  $sql = "INSERT INTO statement (id, user_id, created_at, status, value) VALUES (NULL, '$user_id', NOW(), 'Deposit', $amount)";
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/withdraw.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <title>WebBank: Deposit</title>

</head>

<body>
  <div class="main">
    <h1>Welcome! , <?php echo $user['username']; ?></h1>
    <p>Balance : <?php echo number_format($user['balance'], 2); ?> THB</p>

    <h2>Deposit</h2>
    <form method="post">
      <label for="amount"></label>
      <div class="money">
      <input type="number" id="amount" class="form-control" min=0  name="amount" placeholder="0.00" style="width:200px; margin:auto;">
      </div>
      <div class="conmfirm pt-2">
        <button type="submit" class="btn btn-success" name="deposit" onclick="return confirm('Are you confirm your money?');">Confirm</button>
      </div>
    </form>
    <a href="home.php"> <img src="img/logout.png" alt="" width="50px" height="50px"></a>

  </div>
</body>

</html>