<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
   	include("default.php");

	include("config.php");
   	$error = "";

   	if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM user WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        $_SESSION['login_user'] = $myusername;
        header("location:dashboard.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   	}
?>
<html class="html">
	
	<head>
		<title>Login </title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/indexAndAccountManageStyle.css">
		<link rel="stylesheet" href="css/star.css">
		<script src="js/star.js"></script>
	</head>
	<body>
		<div id='stars'></div>
		<div id='stars2'></div>
		<div id='stars3'></div>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<div class="wrap">
				<div class="avatar">
					<?php echo '<img src="' . $avatar . '"/>';?>
				</div>
				<input type="text" placeholder="username" name="username" value="" required>
				<br>
				<input type="password" placeholder="password" name="password" value="" required>
				<br>
				<button class="wrapButton">Sign in</button>
				<div class="error">
					<?php echo $error; ?>
				</div>
			</div>
		</form>
		<!--div class="center">
			<a class="label" href="manageAccount.php">Manage Account</a>
		</div>
		<a class="credit" href="reference.php" target="_blank">credits</a>
		<p class="default">default username:admin</br>default password:admin</p-->
	</body>

</html>