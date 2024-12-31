<?php
define('DB_SERVER','198.71.227.86');
define('DB_USER','rkjrshopping');
define('DB_PASS' ,'Shreybassi@1');
define('DB_NAME', 'rkjrshopping');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>