<?php
// Enable debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Uncomment to enable sessions if required
// session_start();
?>

<div class="top-bar animate-dropdown">
    <div class="container">
        <div class="header-top-inner">
            <!-- Account Section -->
            <div class="cnt-account">
                <ul class="list-unstyled">
                    <?php if (!empty($_SESSION['login'])) { ?>
                        <li>
                            <a href="#"><i class="icon fa fa-user"></i>Welcome - <?php echo htmlentities($_SESSION['username']); ?></a>
                        </li>
                        <li><a href="my-balance.php"><i class="icon fa fa-user"></i>My Balance</a></li>
                        <li><a href="logout.php"><i class="icon fa fa-sign-out"></i>Logout</a></li>
                    <?php } else { ?>
                        <li><a href="login.php"><i class="icon fa fa-sign-in"></i>Login</a></li>
                    <?php } ?>

                    <li><a href="my-account.php"><i class="icon fa fa-user"></i>My Account</a></li>
                    <li><a href="my-wishlist.php"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                    <li><a href="my-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                    <li><a href="#"><i class="icon fa fa-key"></i>Checkout</a></li>
                </ul>
            </div><!-- /.cnt-account -->

            <!-- Additional Links -->
            <div class="cnt-block">
                <ul class="list-unstyled list-inline">
                    <li class="dropdown dropdown-small">
                        <a href="track-orders.php" class="dropdown-toggle"><span class="key">Track Order</span></a>
                    </li>
                    <span id="siteseal">
                        <script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=kaJAlfqSuXv2rP8kZ9qorYHeua8vva7zFOiRhyrC4DSWtCI8CM6ph2qcx1GI"></script>
                    </span>
                </ul>
            </div><!-- /.cnt-block -->

            <div class="clearfix"></div>
        </div><!-- /.header-top-inner -->
    </div><!-- /.container -->
</div><!-- /.top-bar -->

<!-- Balance Notice -->
<?php if (empty($_SESSION['login'])) { ?>
    <li align="center"><b>Please login to check your balance in Ram Kishan Jiva Ram</b></li>
<?php } else { ?>
    <li align="center"><b>Click on the "My Balance" tab to check your balance</b></li>
<?php } ?>
