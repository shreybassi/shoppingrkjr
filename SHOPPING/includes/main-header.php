<?php
// Handle cart updates
if (isset($_GET['action'])) {
    if (!empty($_SESSION['cart'])) {
        foreach ($_POST['quantity'] as $key => $val) {
            if ($val == 0) {
                unset($_SESSION['cart'][$key]); // Remove item if quantity is zero
            } else {
                $_SESSION['cart'][$key]['quantity'] = $val; // Update quantity
            }
        }
    }
}
?>

<div class="main-header">
    <div class="container">
        <div class="row">
            <!-- Logo Section -->
            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                <div class="logo">
                    <a href="index.php">
                        <h2>RKJR - WHOLESALE</h2>
                    </a>
                </div>
            </div>
            <!-- /.logo-holder -->

            <!-- Search Bar -->
            <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder">
                <div class="search-area">
                    <form name="search" method="post" action="search-result.php">
                        <div class="control-group">
                            <input 
                                class="search-field" 
                                placeholder="Search here..." 
                                name="product" 
                                pattern="[a-zA-Z0-9\s]+" 
                                title="Please enter only letters, numbers, or spaces" 
                                required="required" 
                            />
                            <button class="search-button" type="submit" name="search" value="search"></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.top-search-holder -->

            <!-- Shopping Cart Dropdown -->
            <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
                <?php if (!empty($_SESSION['cart'])): ?>
                    <div class="dropdown dropdown-cart">
                        <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="total-price-basket">
                                    <span class="lbl">Cart -</span>
                                    <span class="total-price">
                                        <span class="sign">Rs.</span>
                                        <span class="value"><?php echo htmlspecialchars($_SESSION['tp']); ?></span>
                                    </span>
                                </div>
                                <div class="basket">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                </div>
                                <div class="basket-item-count">
                                    <span class="count"><?php echo htmlspecialchars($_SESSION['qnty']); ?></span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            // Fetch product details for cart items
                            $sql = "SELECT * FROM products WHERE id IN(";
                            foreach ($_SESSION['cart'] as $id => $value) {
                                $sql .= $id . ",";
                            }
                            $sql = rtrim($sql, ',') . ") ORDER BY id ASC";
                            $query = mysqli_query($con, $sql);
                            $totalprice = 0;
                            $totalqunty = 0;

                            if (!empty($query)) {
                                while ($row = mysqli_fetch_array($query)) {
                                    $quantity = $_SESSION['cart'][$row['id']]['quantity'];
                                    $subtotal = $quantity * $row['productPrice'] + $row['shippingCharge'];
                                    $totalprice += $subtotal;
                                    $_SESSION['qnty'] = $totalqunty += $quantity;
                            ?>
                                    <li>
                                        <div class="cart-item product-summary">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="image">
                                                        <a href="detail.html">
                                                            <img src="admin/productimages/<?php echo htmlspecialchars($row['productImage2']); ?>" width="35" height="50" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-xs-7">
                                                    <h3 class="name">
                                                        <a href="index.php?page-detail"><?php echo htmlspecialchars($row['productName']); ?></a>
                                                    </h3>
                                                    <div class="price">
                                                        Rs.<?php echo htmlspecialchars($row['productPrice'] + $row['shippingCharge']); ?> * <?php echo htmlspecialchars($quantity); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                            <?php }
                            } ?>
                            <div class="clearfix"></div>
                            <hr>
                            <div class="clearfix cart-total">
                                <div class="pull-right">
                                    <span class="text">Total :</span>
                                    <span class="price">Rs.<?php echo htmlspecialchars($_SESSION['tp'] = $totalprice); ?></span>
                                </div>
                                <div class="clearfix"></div>
                                <a href="my-cart.php" class="btn btn-upper btn-primary btn-block m-t-20">My Cart</a>
                            </div>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="dropdown dropdown-cart">
                        <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="total-price-basket">
                                    <span class="lbl">Cart -</span>
                                    <span class="total-price">
                                        <span class="sign">Rs.</span>
                                        <span class="value">00.00</span>
                                    </span>
                                </div>
                                <div class="basket">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                </div>
                                <div class="basket-item-count">
                                    <span class="count">0</span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="cart-item product-summary">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            Your Shopping Cart is Empty.
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="clearfix cart-total">
                                    <a href="index.php" class="btn btn-upper btn-primary btn-block m-t-20">Continue Shopping</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <!-- /.top-cart-row -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<!-- /.main-header -->
