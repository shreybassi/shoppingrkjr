<?php
//include auth.php file on all secure pages
include("session.php");
?>

<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>WELCOME.php</title>
</head>
<body>

<h1>LEDGER</h1>
<form method="post" action="generate_pdf.php">
<?php
 $filename = ($_SESSION["username"]).'.txt'; ?>
    <input type="hidden" name="filename" value="<?php echo htmlspecialchars($filename); ?>">
    <button type="submit">Create PDF</button>
</form>
<div>
<?php
 $f = ($_SESSION["username"]).'.txt';
$file = fopen($f, 'r') or exit('error'); 
$data = '';

while(!feof($file)) 
{
    $data .= '<pre>' . fgets($file) . '</pre>'; 
}

fclose($file);

echo $data;
?>
 <p style="font-size:30px">Go <a href="logout.php">back</a> to the LEDGER</p>
</div>
</body>
</html>