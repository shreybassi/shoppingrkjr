<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: logincus.php");
exit(); }
?>