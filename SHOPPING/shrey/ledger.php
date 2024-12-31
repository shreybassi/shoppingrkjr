<?php
    session_start(); ?>
<html>
<head>
	<title>LEDGER</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

    <h2>Ledger Form</h2>

    <form action="newled.php" method="POST"> Ledger Code:

        <input type="text" name="ledger"> 
        <input type="hidden" name="form_submitted" value="1" />

        <input type="submit" value="Submit">



    </form>
	<form method="post" action="generate_pdf.php">
	<input type="hidden" name="form_submit" value="1" />
	<input type="text" name="ledger"> 
    <input type="submit" value="Create a PDF">
</form>
</body>
</html>