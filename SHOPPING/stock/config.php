<?php
	define('DB_SERVER', '198.71.227.86');
   	define('DB_USERNAME', 'rkjrshopping');
   	define('DB_PASSWORD', 'Shreybassi@1');
   	define('DB_DATABASE', 'rkjrshopping');
   	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	$sql = "SELECT avatar FROM user WHERE id = '1'";
   	$pathResult = mysqli_query($db,$sql);
   	$locations = array();
	while($row = mysqli_fetch_array($pathResult)){
    	$locations[] = $row;
	}
   	$avatar =$locations[0]['avatar'];
?>