<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>LEDGER.php</title>
</head>
<body>
<?php if (isset($_POST['form_submitted'])): ?>
<form method="post" action="generate_pdf.php">
<?php
 $filename = $_POST['ledger'].'.txt'; ?>
    <input type="hidden" name="filename" value="<?php echo htmlspecialchars($filename); ?>">
    <button type="submit">Create PDF</button>
</form>
 <p style="font-size:30px">Go <a href="shopping/shrey/ledger.php">back</a> to the LEDGER</p>
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
 
</div>
</body>
</html>