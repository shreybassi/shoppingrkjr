<?php
/*
 * @author Shrey Bassi
 */

require_once("configure.php");

$filename = "slevr.csv";
        
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Expires: 0");

$sql = "SELECT * FROM stock ";

try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
} catch (Exception $ex) {
    printErrorMessage($ex->getMessage());
}

$content = array();
$title = array("ICODE", "W-STOCK", "R-STOCK");
foreach ($results as $rs) {
    $row = array();

    $row[] = stripslashes($rs["ICODE"]);
    $row[] = stripslashes($rs["WKHAN"]);
    $row[] = stripslashes($rs["RKHAN"]);
    
        
    $content[] = $row;
    
}

$output = fopen('php://output', 'w');
fputcsv($output, $title);
foreach ($content as $con) {
    fputcsv($output, $con);
}
?>
