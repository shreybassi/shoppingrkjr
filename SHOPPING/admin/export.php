<?php
/*
 * @author Shrey Bassi
 */

require_once("configure.php");

$filename = "orders.csv";
        
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");

//$sql = "SELECT * FROM orders,users WHERE orders.userId = users.id";
$sql = "SELECT orders.id id, orders.order_id order_id,orders.userId userId, orders.productId productId, orders.quantity quantity, orders.orderDate orderDate, orders.paymentMethod paymentMethod, orders.orderStatus orderStatus, users.name name, users.contactno contactno, products.TaxableValue price FROM orders,users, products WHERE orders.userId = users.id and orders.productId = products.id and (orderStatus IS NULL or orderStatus = 'In Process') ";

try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
} catch (Exception $ex) {
    printErrorMessage($ex->getMessage());
}

$content = array();
$title = array("ID", "Order ID", "UserId", "ProductId", "Quantity", "OrderDate","PaymentMethod","Order Status","NAME","Phone", "Rate");
foreach ($results as $rs) {
    $row = array();

    $row[] = stripslashes($rs["id"]);
    $row[] = stripslashes($rs["order_id"]);
    $row[] = stripslashes($rs["userId"]);
    $row[] = stripslashes($rs["productId"]);
    $row[] = stripslashes($rs["quantity"]);
    $row[] = stripslashes($rs["orderDate"]);
    $row[] = stripslashes($rs["paymentMethod"]);
    $row[] = stripslashes($rs["orderStatus"]);
	$row[] = stripslashes($rs["name"]);
	$row[] = stripslashes($rs["contactno"]);
    $row[] = stripslashes($rs["price"]);
        
    $content[] = $row;
    
}

$output = fopen('php://output', 'w');
fputcsv($output, $title);
foreach ($content as $con) {
    fputcsv($output, $con);
}
?>
