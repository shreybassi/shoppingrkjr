<?php
/*
 * @author Shrey Bassi
*/

// display all error except deprecated and notice  
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
// turn on output buffering 
ob_start();

define('DB_DRIVER', 'mysql');
define("DB_HOST", "198.71.227.86");
define("DB_USER", "rkjrshopping");
define("DB_PASSWORD", "Shreybassi@1");
define("DB_DATABASE", "rkjrshopping");

require_once("functions.php");

// basic options for PDO 
$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

//connect with the server
try {
    $DB = new PDO(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_DATABASE, DB_USER, DB_PASSWORD, $dboptions);
} catch (Exception $ex) {
    printErrorMessage($ex->getMessage());
    die;
}

?>