<?php 
    $conn = mysqli_connect("localhost", "root", "", "kubank");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
?>