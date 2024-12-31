<?php
	include('session2.php');
   	$error = "";

   	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$myComment = mysqli_real_escape_string($db,$_POST['comment']);
		$hour = date('H');
		$minute = date('i');
		$date = date('d');
		$month = date('m');
		$year = date('Y');
      	if(isset($_POST['submit'])){
	      	$sql = "INSERT INTO comment (comment,username, hour, minute, date, month, year)
	   		VALUES ('$myComment','$login_session', '$hour', '$minute', '$date', '$month', '$year')";
	   		if ($db->query($sql) === TRUE) {
				$message = "New record created successfully";
				header("comment.php");
			} else {
				$message = "Error: " . $sql . "<br>" . $db->error;
			}
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
<style>
/* Smartphones (portrait and landscape) ----------- */
@media only screen 
and (min-device-width : 500px) 
and (max-device-width : 480px) {
/* Styles */
}
 
/* Smartphones (landscape) ----------- */
@media only screen 
and (min-width : 321px) {
/* Styles */
}
 
/* Smartphones (portrait) ----------- */
@media only screen 
and (max-width : 500px) {
/* Styles */
}
 
/* iPads (portrait and landscape) ----------- */
@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) {
/* Styles */
}
 
/* iPads (landscape) ----------- */
@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : landscape) {
/* Styles */
}
 
/* iPads (portrait) ----------- */
@media only screen 
and (min-device-width : 768px) 
and (max-device-width : 1024px) 
and (orientation : portrait) {
/* Styles */
}
 
/* Desktops and laptops ----------- */
@media only screen 
and (min-width : 1224px) {
/* Styles */
}
 
/* Large screens ----------- */
@media only screen 
and (min-width : 1824px) {
/* Styles */
}
 
/* iPhone 4 ----------- */
@media
onl
</style>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<head>
		<title>message</title>
		<link rel="stylesheet" type="text/css" href="css2/dashboard.css">
		<link rel="stylesheet" type="text/css" href="css2/comment.css">
		<script>
			var comments = <?php echo json_encode( $CommentRows ) ?>;
		</script>
		<script src="js2/comment.js"></script>

	</head>
	<body>
	<div id="top-bar">
		<nav>
				<li><a href="dashboard.php">Home</a></li>
				<li><a href="comment.php">Message</a></li>
				<!--li><a href="reference.php" target="_blank">About</a></li-->
				<li><a href="logout.php">Logout</a></li>
			
			
		</nav>
	</div>	
		

	
			<div id="welcome">
				<h1>Welcome <?php echo $login_session; ?></h1>
			</div>
			<div id="title">
				<h1>Message Board</h1>
			</div>
			
			
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				
				
				<div class= "submit">
					<div id="in">
						<textarea class ="comment" type="text" name="comment" required rows="4" cols="50"></textarea>	
					</div>
				<div id="sub-btn">	
						<button name="submit">submit</button>
					</div>	
				</div>
				
			</form>
		
	
	</body>
</html>