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
  <link rel="stylesheet" href="css/home_style.css">
  <title>WebBank</title>

  <!-- <style>
    body {
      background-image: url(https://p4.wallpaperbetter.com/wallpaper/159/576/899/the-sky-clouds-landscape-nature-wallpaper-preview.jpg);
      background-size: cover;
    }

}
    .main-home {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
    }

    .main-home > div {
      margin: 10px;
      text-align: center;
      width: calc(25% - 20px);
    }

    h1 {
      color: green;
      text-align: center;
    }

    p {
      color: green;
      text-align: center;
    }

  </style> -->
</head>

<body>
  <h1>Welcome! , <?php echo $user['username']; ?></h1>
  <p>Balance : <?php echo number_format($user['balance'], 2); ?> THB</p>
  <div class="main-home">
    <div class="item-cheild" >
      <form action="withdraw.php">
        <div class="withdraw">
          <button type="submit" class="icon">
            <img src="img/cash-withdrawal.png" alt="withdraw" width="200px" height="200px">
          </button>
        </div>
      </form>
      <h4 for="">Withdraw</h4>
    </div>
    <div class="item-cheild">
      <form action="deposit.php">
        <div class="deposit">
          <button type="submit" class="icon">
            <img src="img/Deposit.png" alt="deposit" width="200px" height="200px">
          </button>
        </div>
      </form>
      <h4  for="">Deposit</h4>
    </div>
    <div class="item-cheild" >
      <form action="statement.php">
        <div class="statement">
          <button type="submit" class="icon">
            <img src="img/statement.png" alt="statement" width="200px" height="200px">
          </button>
        </div>
        <h4  for="">Check Statement</h4>
      </form>
    </div>
    <div>
      <a href="logout.php" onclick="return confirm('Are you confirm to logout?');"> <img src="img/logout.png" alt="" class="icon" width="200px" height="200px"></a>
    </div>
  </div>
  <!-- <div class="input-field">
  </div> -->
</body>

</html>
