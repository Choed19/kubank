<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="css/login_style.css">
  <title>WebBank</title>
  <style>
    html,
    body {
      height: 100%;
      margin: 0;

    }

    .container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      height: 100%;
    }

    .col-sm-4 {
      margin: auto;
    }
  </style>
</head>

<body>
  <div backgroud: url('<?php $a = array('image.jpg');
                        echo $a[array_rand($a)]; ?>');>
    <div class="container">
      <div class="row">
        <div class="col-sm-0"></div>
        <div class="col-sm-0">
          <h4>Sign IN</h4>
          <form action="" method="post">
            <!-- <div class="info">
            <input type="text" id="username" name="username" class="form-control" required placeholder="username">
            <input type="password" id="password" name="password" class="form-control" required placeholder="password">
          </div> -->
            <div class="mb-3">
              <label class="form-label">username</label>
              <input type="text" id="username" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" id="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="login" style="display:flex;">
              <button type="submit" class="btn btn-primary" name="login">Login</button>
              &nbsp;&nbsp;
              <button type="submit" class="btn btn-success" name="register">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php
    // สร้างการเชื่อมต่อฐานข้อมูล

    include "conDB.php";
    // เข้าสู่ระบบ
    if (isset($_POST['login'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      if (mysqli_num_rows($result) == 1) {
        session_start();
        $_SESSION['id'] = $row['id'];
        echo '
	      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  	    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  	';
        echo '
					<script>
				       setTimeout(function() {
				        swal({
				            title: "Login สำเร็จ !!",
				            type: "success"
				        }, function() {
				            window.location = "home.php";
				        });
				    });
				</script>
				';
        // header("Location: home.php");
      } else {
        echo "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
      }
    }
    // การลงทะเบียนผู้ใช้งาน
    if (isset($_POST["register"])) {
      $username = $_POST["username"];
      $password = $_POST["password"];

      $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
      if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    $conn->close();
    ?>