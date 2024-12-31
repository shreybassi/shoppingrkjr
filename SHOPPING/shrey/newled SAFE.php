<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>LEDGER.php</title>
</head>
<body>
<?php if (isset($_POST['form_submitted'])): ?>

<h1>LEDGER</h1>
<div>
 <?php
 $f = $_POST['ledger'].'.txt';
$file = fopen($f, 'r') or exit('error'); 
$data = '';

while(!feof($file)) 
{
    $data .= '<pre>' . fgets($file) . '</pre>'; 
}

fclose($file);

echo $data;
 endif; ?>
 <p style="font-size:30px">Go <a href="/shrey/ledger.php">back</a> to the LEDGER</p>
</div>
</body>
</html>