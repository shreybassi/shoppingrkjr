<?php
include('includes/config.php');


$orddata1=mysqli_query($con,"select distinct order_id from orders order by order_id desc limit 1");
$userrow = mysqli_fetch_array($orddata1);
$order12 = $userrow['order_id'];
$pageTitle   = 'Checkout Completed Successfully';

?>
<table width="500" border="0" align="center" cellpadding="1" cellspacing="0">
   <tr> 
      <td align="left" valign="top" bgcolor="#333333"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
               <td align="center" bgcolor="#EEEEEE"> <p>&nbsp;</p>
                        <p>Your order number is: <?php  echo "<b>".$order12."</b>"; ?> <br>Please pay by clicking the pay Now button below.</p>
                  <p>&nbsp;</p></td>
            </tr>
         </table></td>
   </tr>
</table>

<?php
session_start();
require('config.php');
include('includes/config.php');
require('razorpay-php/Razorpay.php');

$pageTitle   = 'RKJR | Payment';
// Create the Razorpay Order

use Razorpay\Api\Api;
		
$api = new Api($keyId, $keySecret);
//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orddata=mysqli_query($con,"select distinct razorpay.id id,razorpay.name name,razorpay.amount amt from razorpay,orders where orders.order_id = razorpay.id order by id desc limit 1");
$userrow = mysqli_fetch_array($orddata);
$name1 = $userrow['name'];
$orderData = [
    'receipt'         => $userrow['id'],
    'amount'          => $userrow['amt']*100	, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $name1,
    "description"       => "Ram Kishan Jiva Ram",
    "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill"           => [
    "name"              => $name1,
    "email"             => "",
    "contact"           => "",
    ],
    "notes"             => [
    "address"           => "",
    "merchant_order_id" => "123123",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("checkout/manual.php");
