<?php
/*
 * @author Shrey Bassi
*/

require_once("configure.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <!--link rel="icon" href="http://www.thesoftwareguy.in/favicon.ico" type="image/x-icon" /-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Import and Export CSV with PHP And MySql - RKJR</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>

    <body>

        <div id="container">
            <div id="body">
                <div class="mainTitle" >Export CSV with PHP And MySql</div>
                <div style="text-align:center;">
                    <a href="import-csv.php" title="Import CSV" ><img src="buttons/button_import.png" alt="Import CSV" width="151" height="38"> </a>   
                    <a href="export-csv.php" title="Export CSV" ><img src="buttons/button_export.png" alt="Export CSV" width="148" height="38"> </a>    
                </div>
                <div class="height10"></div>
                <div class="height10"></div>
                <div style="text-align:center;">
                    <a href="export.php" title="Export The table" ><img src="buttons/button_export_table.png" alt="Export The table" width="229" height="38"></a> 
                </div>
                <article>
                    <table class="bordered" >
                        <thead>

                            <tr> 
							Z   <th style="font-weight:bold;text-align:left;">ID</th>
                                <th style="width:10%;text-align:center;font-weight:bold;">Order Id</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">User ID</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">Product ID</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">Quantity</th>
								<th style="width:15%;text-align:center;font-weight:bold;">Payment Method</th>
                                <th style="width:15%;text-align:center;font-weight:bold;">Name</th>		
								<th style="width:15%;text-align:center;font-weight:bold;">Phone No.</th>
                            </tr>
                            <?php
                            $sql = "SELECT * FROM orders,users WHERE orders.userId = users.id";

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
                                     <td><?php echo stripslashes($rs["id"]) ?></td>
                                    <td style="text-align:center"><?php echo stripslashes($rs["order_id"]) ?></td>
                                    <td style="text-align:center;"><?php echo stripslashes($rs["userId"]) ?></td>
                                    <td style="text-align:center;"><?php echo stripslashes($rs["productId"]) ?></td>
                                    <td style="text-align:center;"><?php echo stripslashes($rs["quantity"]) ?></td>
									<td style="text-align:center;"><?php echo stripslashes($rs["paymentMethod"]) ?></td>
                                    <td style="text-align:center;"><?php echo stripslashes($rs["name"]) ?></td>
                                <td style="text-align:center;"><?php echo stripslashes($rs["contactno"]) ?></td>
                                
                                </tr>
                                <?php
                            }
                            ?>
                        </thead>
                    </table>
                    <div class="height10"></div>
                </article>
                <div style="margin:10px 0;width:100%;float: left;">
				
	<div style="width:35%;float: left;margin:0 auto;text-align: center;">
		<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fshreybassi007&amp;width&amp;height=360&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true&amp;appId=198210627014732" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:360px;" allowTransparency="true"></iframe>
	</div>
	<div style="width:35%;float: left;margin:0 auto;text-align: center;">
		<!-- Place this tag where you want the widget to render. -->
		<!--div class="g-person" data-href="https://plus.google.com/116523474604785207782"  data-rel="author" data-layout="potrait"></div>

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
		href="https://twitter.com/ShreyBassi"
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
	</div-->
</div>
<div class="height10"></div>
                <footer>
                    <div class="copyright">
                        &copy; 2019 <a href="https://rkjrrampur.in" target="_blank">RKJR</a>. All rights reserved
                    </div>
                    <div class="footerlogo"><a href="https://rkjrrampur.in\admin" target="_blank"><img src="buttons/Logo.png" width="200" height="47" alt="rkjr logo" /></a> </div>
                </footer>
            </div></div>

    </body>
</html>