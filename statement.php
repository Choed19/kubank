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

// $sql = "SELECT * FROM `statement` WHERE user_id='$user_id' ORDER BY `statement`.`created_at` DESC"
$sql = "SELECT * FROM `statement` WHERE user_id='$user_id' ORDER BY `statement`.`created_at` DESC";
$statements = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="css/statement.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    <title>Statement</title>
</head>

<body>
    <div class="main-statement container-fluid">
        <div class="width-table">
            <h1>Statement , <?php echo $user['username']; ?></h1>

            <hr>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <!-- <th>id</th> -->
                        <th>Value</th>
                        <th>DateTime</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($statement = $statements->fetch_assoc()) {
                        echo "<tr>";
                        // echo "<td>" . $statement["id"] . "</td>";
                        echo "<td>" . $statement["value"] . "</td>";
                        echo "<td>" . $statement["created_at"] . "</td>";
                        echo "<td>" . $statement["status"] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <form action="home.php">
                <button type="submit" class="btn btn-secondary m-3">BACK</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "ordering": false,
                // order: [
                //     [1, 'desc']
                // ],
            });

        });
    </script>
</body>


</html>