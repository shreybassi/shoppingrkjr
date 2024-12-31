<?php
/* Database connection start */
$servername = "198.71.227.86";
$username = "rkjrshopping";
$password = "Shreybassi@1";
$dbname = "rkjrshopping";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>