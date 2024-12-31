<?php
	include('session.php');
    $sql = 'SELECT * FROM stockramp';
	$result = mysqli_query($db,$sql); 
	$rows = array();
	
	while($row = mysqli_fetch_array($result)){
    	$rows[] = $row;	
	}
	include_once("db_connect.php");
	include("header.php"); 
	
	
?>

<html>
<style>
/* Smartphones (portrait and landscape) ----------- */
@media only screen 
and (min-device-width : 500px) 
and (max-device-width : 580px) {
/* Styles */
}
 
/* Smartphones (landscape) ----------- */
@media only screen 
and (min-width : 500px) {
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
		<title>STOCK</title>
		<link rel="stylesheet" type="text/css" href="css/dashboard.css">
		<link rel="stylesheet" type="text/css" href="css/inventory.css">
		<script type="text/javascript">
			var products = <?php echo json_encode( $rows ) ?>;
		</script>
		<script src="js/dashboard.js"></script>
		<script src="js/inventory2.js"></script>
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
		<!--div id = "side-navagate-bar">
			<div class = "toggle-btn" onclick="toggleSideBar()">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<ul>
				<li><h2 id="logo">Stock Management</h2></li>
				<!--li><a href="sales.php">Sales</a></li>
				<li><a href="inventory.php">Inventory</a></li>
			</ul>
		</div-->

		<div id="block">
	
	<br>
	<br>	
	<br>
	<br>	
	<br>
	<button onClick="window.location.reload();">Refresh Page</button>
	<button onclick="location.href='supplierramp.php'">Back to Supplier</button>
	<br>
				<script type="text/javascript" src="dist/jquery.tableditramp.js"></script>
<div class="container home">	
	<table id="data_table" class="table table-striped">
		<thead>
			<tr>
				<th>ICODE</th>
				<th>INAME</th>
				<th>SUPPLIER</th>
				<th>W-STOCK</th>	
				<th>R-STOCK</th>
				<th>UNIT</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$supplier = $_POST['sup'];
			$sql_query = "SELECT icode, iname, sup, wkhan, rkhan, unit FROM stockramp where sup='$supplier'";
			$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
			while( $stock = mysqli_fetch_assoc($resultset) ) {
			?>
			   <tr id="<?php echo $stock ['icode']; ?>">
			   <td><?php echo $stock ['icode']; ?></td>
			   <td><?php echo $stock ['iname']; ?></td>
			   <td><?php echo $stock ['sup']; ?></td>
			   <td><?php echo $stock ['wkhan']; ?></td>   
			   <td><?php echo $stock ['rkhan']; ?></td>
			   <td><?php echo $stock ['unit']; ?></td>   
			   </tr>
			<?php } ?>
		</tbody>
    </table>	
	</div>
<script type="text/javascript" src="custom_table_editramp.js"></script>

				<br>
				
				<!--form id="submit" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<div id="Product_Panel">
						<button name="edit" id="editBtn">Submit Change</button>
						<div id="updateModal" onclick="model()" class="modal">
							<div class="modal-content">
								<span class="close">&times;</span>
								<div class="modal-body">
									<table>
										<tr><td>Item Id: </td><td><input type="text" placeholder="itemId" name="itemId"></td></tr>
										<tr><td>Item Name: </td><td><input type="text" placeholder="itemName" name="item"></td></tr>
										<tr><td>Quantity: </td><td><input type="text" placeholder="quantity" name="quantity"></td></tr>
										<tr><td>Date: </td><td><input type="date" placeholder="date" name="date"></td></tr>
									</table>
									<br>
									<button id="editBtn" name="updateSale">Update Sale</button>
								</div>
							</div>
						</div>
						<div>
						</div>
						<br>
					</div>	
				</form-->
				
	<script type="text/javascript" src="custom_table_editramp.js"></script>
			
				<script>
					// Get the modal
					var modal = document.getElementsByClassName("modal");
					
					// Get the button that opens the modal
					var btn = document.getElementsByClassName("Btn");
					
					// Get the <span> element that closes the modal
					var span = document.getElementsByClassName("close");
					
					// When the user clicks the button, open the modal 
					btn[0].onclick = function() {
					    modal[0].style.display = "block";
					}
					
					btn[1].onclick = function() {
					    modal[1].style.display = "block";
					}
					
					btn[2].onclick = function() {
					    modal[2].style.display = "block";
					}
					
					
					// When the user clicks on <span> (x), close the modal
					span[0].onclick = function() {
					    modal[0].style.display = "none";
					}
					
					span[1].onclick = function() {
					    modal[1].style.display = "none";
					}
					
					span[2].onclick = function() {
					    modal[2].style.display = "none";
					}
					
					// When the user clicks anywhere outside of the modal, close it
					window.onclick = function(event) {
					    if (event.target == modal) {
					        modal.style.display = "none";
					    }
					}
				</script>
			
		</div>
		
</html>
	</body>
	<script type="text/javascript" src="custom_table_editramp.js"></script>
