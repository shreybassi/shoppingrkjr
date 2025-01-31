<?php
/*
 * @author Shrey Bassi
 */

require_once("\admin\configure.php");


if ($_REQUEST["mode"] == "import") {
    $row = 0;

    $tempFileName = time() . ".csv";
    if (is_uploaded_file($_FILES["uploadFile"]['tmp_name'])) {
        $fileUploaded = move_uploaded_file($_FILES["uploadFile"]['tmp_name'], $tempFileName);

        if ($fileUploaded) {

            if (($handle = fopen($tempFileName, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                    if ($row > 0) {
                        try {
                            $sql = "INSERT INTO tbl_products2 (products_name, products_quantity,products_model,products_price,products_weight,products_status) values ( :pname, :qty, :model, :price, :weight, :status  ) ";
                            $stmt = $DB->prepare($sql);
                            $stmt->bindValue(":pname", $data[0]);
                            $stmt->bindValue(":qty", $data[1]);
                            $stmt->bindValue(":model", $data[2]);
                            $stmt->bindValue(":price", $data[3]);
                            $stmt->bindValue(":weight", $data[4]);
                            $stmt->bindValue(":status", $data[5]);

                            $stmt->execute();
                        } catch (Exception $ex) {
                            printErrorMessage($ex->getMessage());
                        }
                    }
                    $row++;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="http://thesoftwareguy.in/favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Import and Export CSV with PHP And MySql - thesoftwareguy</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>

    <body>

        <div id="container">
            <div id="body">
                <div class="mainTitle" >Import CSV file after uploading it to server</div>
                <div style="text-align:center;">
                    <a href="import-csv.php" title="Import CSV" ><img src="buttons/button_import.png" alt="Import CSV" width="151" height="38"> </a>   
                    <a href="export-csv.php" title="Export CSV" ><img src="buttons/button_export.png" alt="Export CSV" width="148" height="38"> </a>    
                </div>
                <div class="height10"></div>
                <div class="height10"></div>
                <div style="text-align:center;">
                    <a href="import-csv.php" title="Import The file" ><img src="buttons/button_import_file.png" alt="Import the local CSV file" width="208" height="38"></a> 
                    <a href="import-csv-using-file.php" title="Upload CSV" ><img src="buttons/button_upload_csv_file.png" alt="Import the local CSV file" width="153" height="38"></a> 
                </div>

                <div class="height10"></div>
                <div class="height10"></div>
                <div style="text-align:center;">
                    <form name="myform" method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="mode" value="import" >
                        <input type="file" name="uploadFile"> &nbsp;<input type="submit" name="sub" value="Upload" >
                    </form>
                </div>
                <div class="height10"></div>
                <article>
                    <table class="bordered" >
                        <thead>

                            <tr> 
                                <th style="font-weight:bold;text-align:left;">Name</th>
                                <th style="width:10%;text-align:center;font-weight:bold;">Quantity</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">Model</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">Price</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">Weight</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">Status</th>
                            </tr>
                            <?php
                            $sql = "SELECT * FROM tbl_products2 WHERE 1";

                            try {
                                $stmt = $DB->prepare($sql);
                                $stmt->execute();
                                $results = $stmt->fetchAll();
                            } catch (Exception $ex) {
                                printErrorMessage($ex->getMessage());
                            }
// display all products
foreach ($results as $rs) {
    ?>
                                <tr>
                                    <td><?php echo stripslashes($rs["products_name"]) ?></td>
                                    <td style="text-align:center"><?php echo stripslashes($rs["products_quantity"]) ?></td>
                                    <td style="text-align:center;"><?php echo stripslashes($rs["products_model"]) ?></td>
                                    <td style="text-align:center;"><?php echo stripslashes($rs["products_price"]) ?></td>
                                    <td style="text-align:center;"><?php echo stripslashes($rs["products_weight"]) ?></td>
                                    <td style="text-align:center;"><?php echo ($rs["products_status"] == "A") ? "Active" : "Inactive"; ?></td>
                                </tr>
    <?php
}
if ($_REQUEST["mode"] != "import") {
    echo '<tr><td align="center" colspan="6">No Records to display. Please import the file to display the records.</td> </tr>';
}

if ($_REQUEST["mode"] == "import") {
    @mysql_query("TRUNCATE TABLE `tbl_products2`");
}
?>
                        </thead>
                    </table>
                    <div class="height10"></div>
                    
                </article>
                <div style="margin:10px 0;width:100%;float: left;">
	<div style="width:35%;float: left;margin:0 auto;text-align: center;">
		<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FThesoftwareguy7&amp;width&amp;height=360&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=198210627014732" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:360px;" allowTransparency="true"></iframe>
	</div>
	<div style="width:35%;float: left;margin:0 auto;text-align: center;">
		<!-- Place this tag where you want the widget to render. -->
		<div class="g-person" data-href="https://plus.google.com/116523474604785207782"  data-rel="author" data-layout="potrait"></div>

		<!-- Place this tag after the last widget tag. -->
		<script type="text/javascript">
			(function() {
				var po = document.createElement('script');
				po.type = 'text/javascript';
				po.async = true;
				po.src = 'https://apis.google.com/js/platform.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(po, s);
			})();
		</script>
	</div>
	<div style="width:30%;float: left;margin:0 auto;text-align: center;">
		<a class="twitter-follow-button"
		href="https://twitter.com/thesoftwareguy7"
		data-show-count="true" 
		data-lang="en" data-size="large" >
		</a>
		<script type="text/javascript">
		window.twttr = (function (d, s, id) {
		var t, js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src= "https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js, fjs);
		return window.twttr || (t = { _e: [], ready: function (f) { t._e.push(f) } });
		}(document, "script", "twitter-wjs"));
		</script>
	</div>
</div>
                
                <div class="height10"></div>
                <footer>
                    <div class="copyright">
                        &copy; 2013 <a href="http://www.thesoftwareguy.in" target="_blank">RKJR</a>. All rights reserved
                    </div>
                    <div class="footerlogo"><a href="http://www.thesoftwareguy.in" target="_blank"><img src="http://www.thesoftwareguy.in/thesoftwareguy-logo-small.png	" width="200" height="47" alt="thesoftwareguy logo" /></a> </div>
                </footer>
            </div></div>


    </body>
</html>