<?php
require_once 'library/config.php';

// if no order id defined in the session
// redirect to main page
if (!isset($_SESSION['orderId'])) {
	header('Location: ' . WEB_ROOT);
	exit;
}

$pageTitle   = 'Checkout Completed Successfully';
require_once 'include/header.php';


// send notification email
if ($shopConfig['sendOrderEmail'] == 'y') 
	{
	/*$subject = "[New Order] " . $_SESSION['orderId'];
	$email   = $shopConfig['email'];
	$message = "You have a new order. Check the order detail here \n http://" . $_SERVER['HTTP_HOST'] . WEB_ROOT . 'admin/order/index.php?view=detail&oid=' . $_SESSION['orderId'] ;
	mail($email, $subject, $message, "From: $email\r\nReturn-path: $email");*/

	include './include/sendMail.php';

		$Sender = "info@rkjr.co.in";
		$Recipient = "saurabhbassi@gmail.com,sunilbassi25@hotmail.com,shilbassi@gmail.com";		
		$Subject = "You have a new order- ". $_SESSION['orderId'];
		$custName = $_SESSION['EmailName'];
		$custPhone = $_SESSION['EmailPhone'];
		$Body = "<html> 
		  <body bgcolor=\"WhiteSmoke\"> <img src=\"http://www.rkjr.co.in/images/logo.png\"><br>
			<left> 
					Customer Name : ".$custName."<br>
					Customer Phone : ".$custPhone."
			</left> 
			  <br><br><br><br><br><br>** This is an auto generated mail, don't respond to this mail. <br><br>___________________<br> Regards<br>Shizin Online Shopping Admin Team. 
		  </body> 
		</html>"; 
		$Type = "HTML";
		sendmail( $Sender, $Recipient, $Subject, $Body, $Type);

}


?>
<p>&nbsp;</p><table width="500" border="0" align="center" cellpadding="1" cellspacing="0">
   <tr> 
      <td align="left" valign="top" bgcolor="#333333"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
               <td align="center" bgcolor="#EEEEEE"> <p>&nbsp;</p>
                        <p>Thank you for shopping with us! Your order number is: <?php  echo "<b>".$_SESSION['orderId']."</b>"; ?> <br>We will pack the purchased 
                            item(s) immediately. Pickup timings are 11:00 AM to 05:00 PM. We will contact you when your order is ready for pickup. To continue shopping please <a href="main.php">click 
                            here</a></p>
                  <p>&nbsp;</p></td>
            </tr>
         </table></td>
   </tr>
</table>

<?php unset($_SESSION['orderId']); ?>
<br>
<br>
<?php
require_once 'include/footer.php';
?>