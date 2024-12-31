<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;

			}
		}
			echo "<script>alert('Your Cart has been Updated');</script>";
		}
	}
// Code for Remove a Product from Cart
if(isset($_POST['remove_code']))
	{

if(!empty($_SESSION['cart'])){
		foreach($_POST['remove_code'] as $key){
			
				unset($_SESSION['cart'][$key]);
		}
			echo "<script>alert('Your Cart has been Updated');</script>";
	}
}
// code for insert product in order table


if(isset($_POST['ordersubmit'])) 
{

	$quantity=$_POST['quantity'];
	$pdd=$_SESSION['pid'];
	$value=array_combine($pdd,$quantity);
$uid = mysqli_query($con,"select MAX(id) as id1 from users");
$oid=mysqli_query($con,"select MAX(order_id) as oo from orders");

$lcode = $row2['lcode'];
$email = $row3['email'];

$odrno=1;
$shipname = $_POST['sname'];
$shipemail = $_POST['semail'];
$shipphone = $_POST['sphone'];
$shipaddress=$_POST['saddress'];
$shipcity=$_POST['scity'];
$shipstate=$_POST['sstate'];
$shippin=($_POST['spin']);

$billaddress=$_POST['baddress'];
$billcity=$_POST['bcity'];
$billstate=$_POST['bstate'];
$billpin=($_POST['bpin']);

while($row = mysqli_fetch_array($oid))
{
	
    $odrno = $row['oo'];
}
while($row = mysqli_fetch_array($uid))
{
	
    $uidno = $row['id1'];
}
$uidno+=1;
$odrno+=1;
		foreach($value as $qty=> $val34){



mysqli_query($con,"insert into orders(order_id,userId,productId,quantity,lcode) values('".$odrno."','".$uidno."','$qty','$val34','null')");
mysqli_query($con,"insert into razorpay(id,amount,name,email) values('".$odrno."','".$_SESSION['tp']."','".$shipname."','".$semail."')");
header('location:payment-method1.php');
}
$query=mysqli_query($con,"insert into users(name,email,contactno,shippingAddress,shippingState,shippingCity,shippingPincode,billingAddress,billingState,billingCity,billingPincode) values('".$shipname."','".$shipemail."','".$shipphone."','".$shipaddress."','".$shipcity."','".$shipstate."','".$shippin."','".$billaddress."','".$billcity."','".$billstate."','".$billpin."') ");


}


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>My Cart</title>
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		
		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">

		<!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

	</head>
    <body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>
</header>
<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Shopping Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row inner-bottom-sm">
			<div class="shopping-cart">
				<div class="col-md-12 col-sm-12 shopping-cart-table ">
	<div class="table-responsive">
<form name="cart" method="post">	
<?php
if(!empty($_SESSION['cart'])){
	?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="cart-romove item">Remove</th>
					<th class="cart-description item">Image</th>
					<th class="cart-product-name item">Product Name</th>
			
					<th class="cart-qty item">Quantity</th>
					<th class="cart-sub-total item">Taxable Value</th>
					<th class="cart-sub-total item">SGST</th>
					<th class="cart-sub-total item">CGST</th>
					<th class="cart-sub-total item">Cess</th>
					<th class="cart-total last-item">Grandtotal</th>
				</tr>
			</thead><!-- /thead -->
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							<span class="">
								<a href="index.php" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
								<input type="submit" name="submit" value="Update shopping cart" class="btn btn-upper btn-primary pull-right outer-right-xs">
							</span>
						</div><!-- /.shopping-cart-btn -->
					</td>
				</tr>
			</tfoot>
			<tbody>
 <?php
 $pdtid=array();
    $sql = "SELECT * FROM products WHERE id IN(";
			foreach($_SESSION['cart'] as $id => $value){
			$sql .=$id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			$totalqunty=0;
			if(!empty($query)){
			while($row = mysqli_fetch_array($query)){
				$quantity=$_SESSION['cart'][$row['id']]['quantity'];
				$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
				$totalprice += $subtotal;
				$_SESSION['qnty']=$totalqunty+=$quantity;

				array_push($pdtid,$row['id']);
//print_r($_SESSION['pid'])=$pdtid;exit;
	?>

				<tr>
					<td class="romove-item"><input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['id']);?>" /></td>
					<td class="cart-image">
						<a class="entry-thumbnail" href="detail.html">
						    <img src="admin/productimages/<?php echo $row['productImage2'];?>" alt="" width="114" height="146">
						</a>
					</td>
					<td class="cart-product-name-info">
						<h4 class='cart-product-description'><a href="product-details.php?pid=<?php echo htmlentities($pd=$row['id']);?>" ><?php echo $row['productName'];

$_SESSION['sid']=$pd;
						 ?></a></h4>
						<div class="row">
							<div class="col-sm-4">
								<div class="rating rateit-small"></div>
							</div>
							<div class="col-sm-8">
<?php $rt=mysqli_query($con,"select * from productreviews where productId='$pd'");
$num=mysqli_num_rows($rt);
{
?>
								<div class="reviews">
									( <?php echo htmlentities($num);?> Reviews )
								</div>
								<?php } ?>
							</div>
						</div><!-- /.row -->
						
					</td>
					<td class="cart-product-quantity">
						<div class="quant-input">
				                <div class="arrows">
				                  <!--div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
				                  <!--div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div-->
				                </div>
				             <input type="text" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]" readonly>
				             
			              </div>
		            </td>
					<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "Rs"." ".$row['TaxableValue']; ?></span></td>
<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "Rs"." ".$row['SGST']; ?></span></td>
<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "Rs"." ".$row['CGST']; ?></span></td>
<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "Rs"." ".$row['CESS']; ?></span></td>
					<td class="cart-product-grand-total"><span class="cart-grand-total-price"><?php echo ($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']); ?></span></td>
				</tr>

				<?php } }
$_SESSION['pid']=$pdtid;
				?>
				
			</tbody><!-- /tbody -->
		</table><!-- /table -->
		
	</div>
						

</div><!-- /.shopping-cart-table -->	

	<table class="table table-bordered">
	
	<tbody>
				<tr>
					<td>
						<div class="form-group">

									<div class="form-group">
						<label class="info-title" for="sname" >Name <span>*</span></label>
						<input type="text" class="form-control unicase-form-control text-input" id="sname" name="sname" required="required">
					</div>
					<div class="form-group">

									<div class="form-group">
						<label class="info-title" for="semail" >Email <span>*</span></label>
						<input type="text" class="form-control unicase-form-control text-input" id="semail" name="semail" required="required">
					</div>
					<div class="form-group">

									<div class="form-group">
						<label class="info-title" for="sphone" >Contact No. <span>*</span></label>
						<input type="text" class="form-control unicase-form-control text-input" id="sphone" name="sphone" required="required">
					</div>
	
	</table>
		<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Shipping Address</span>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">

									<div class="form-group">
						<label class="info-title" for="saddress" >Shipping Address <span>*</span></label>
						<input type="text" class="form-control unicase-form-control text-input" id="saddress" name="saddress" required="required">
					</div>


									<div class="form-group">
						<label class="info-title" for="sstate">Shipping State <span>*</span></label>
						<input type="text" class="form-control unicase-form-control text-input" id="sstate" name="sstate" required="required">
					</div>

						<div class="form-group">
						<label class="info-title" for="scity">Shipping City <span>*</span></label>
						<input type="text" class="form-control unicase-form-control text-input" id="scity" name="scity" required="required">
					</div>

						<div class="form-group">
						<label class="info-title" for="spin">Shipping Pincode <span>*</span></label>
						<input type="text" class="form-control unicase-form-control text-input" id="spin" name="spin" required="required">	
					</div>

		
						</div>
		
						</div>
						</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div>
<script>
function autofilling(f) {
  if ($("#checkbox1").prop("checked")) {
    f.baddress.value = f.saddress.value;
    f.bstate.value = f.sstate.value;
    f.bcity.value = f.scity.value;
	 f.bpin.value = f.spin.value;
  } else {
    f.baddress = '';
    f.bstate = '';
    f.bcity = '';
	f.bpin = '';
  }
}

$("#checkbox1").click(function() {
  if ($("#checkbox1").prop("checked")) {
    autofilling();
  }
});
</script>
<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Billing Address</span>
				</th>
			</tr>
		</thead>
		<input type="checkbox" name="checkbox1" id="checkbox1" onclick="autofilling(this.form)">
      <label for="checkbox1">Check this box if order info and sending info are the same.</label>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
								<div class="form-group">
						<label class="info-title" for="baddress">Billing Address <span>*</span></label>
						<input type="text" class="form-control unicase-form-control text-input" id="baddress" name="baddress" required="required">
					</div>


									<div class="form-group">
						<label class="info-title" for="bstate">Billing State <span>*</span></label>
						<input type="text" class="form-control unicase-form-control text-input" id="bstate" name="bstate" required="required">
					</div>

						<div class="form-group">
						<label class="info-title" for="bcity">Billing City <span>*</span></label>
						<input type="text" class="form-control unicase-form-control text-input" id="bcity" name="bcity" required="required">
					</div>

						<div class="form-group">
						<label class="info-title" for="bpin">Billing Pincode <span>*</span></label>
						<input type="text" class="form-control unicase-form-control text-input" id="bpin" name="bpin" required="required">
					</div>
		
						</div>
					
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div>
	
<div class="col-md-4 col-sm-12 cart-shopping-total">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					
					<div class="cart-grand-total">
						Grand Total<span class="inner-left-md"><?php echo $_SESSION['tp']="$totalprice"; ?></span>
					</div>
				</th>
			</tr>
		</thead><!-- /thead -->
		<tbody>
				<tr>
					<td>
						<div class="cart-checkout-btn pull-right">
							<button type="submit" name="ordersubmit" class="btn btn-primary">PROCCED TO CHECKOUT</button>
						
						</div>
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table>
	<?php } else {
echo "Your shopping Cart is empty";
		}?>
</div>			</div>
		</div> 
		</form>
<?php echo include('includes/brands-slider.php');?>
</div>
</div>
<?php include('includes/footer.php');?>

	<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	
</body>
</html>