<?php
	include('session2.php');
   	$error = "";

   	if($_SERVER["REQUEST_METHOD"] == "POST") {
      	if(isset($_POST['submit'])){
	      	$sql = "TRUNCATE TABLE comment";
	   		header("comment.php");
			}
	    }
   	
    $sql = 'SELECT * FROM comment';
	$CommentResult = mysqli_query($db,$sql); 
	$CommentRows = array();
	while($row = mysqli_fetch_array($CommentResult)){
    	$CommentRows[] = $row;
	}
?>


<html>
	<head>
		<title>message</title>
		<link rel="stylesheet" type="text/css" href="css2/dashboard.css">
		<link rel="stylesheet" type="text/css" href="css2/comment.css">
		<script>
			var comments = <?php echo json_encode( $CommentRows ) ?>;
		</script>
		<script src="js3/comment.js"></script>

	</head>
	<body>
	<div id="top-bar">
		<nav>
			<ul>
				<li><a href="dashboard.php">Home</a></li>
				<li><a href="comment.php">Message</a></li>
				<!--li><a href="reference.php" target="_blank">About</a></li-->
				<li><a href="logout.php">Logout</a></li>
			</ul>
			
			
		</nav>
	</div>	
		

		<div id = "side-navagate-bar">
			<div class = "toggle-btn" onclick="toggleSideBar()">
				<span></span>
				<span></span>
				<span></span>
			</div>
			
			<ul>
				<li><h2 id="logo">RKJR STOCK</h2></li>
				<!--li><a href="sales.php">Sales</a></li-->
				<li><a href="inventory.php">STOCK</a></li>
			</ul>
			
		</div>

	<div id="block">
		<div id="main-area">
			<div id="welcome">
				<h1>Welcome <?php echo $login_session; ?></h1>
			</div>
			<div id="title">
				<h1>Message Board</h1>
			</div>
			
			
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				
				<div id="Tasks_Panel-info">
			
					<h1 id = "me"></h1>
					<div id="comment"></div>
				</div>	
				
				<div class= "submit">
					<div id="sub-btn">	
						<button name="submit">RESET</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	</body>
</html>