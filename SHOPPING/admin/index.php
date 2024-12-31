<?php
// Start session and set time limit
session_start();
set_time_limit(0);
error_reporting(0);

// Include configuration file
include("include/config.php");

// Handle form submission
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Query to check admin credentials
    $ret = mysqli_query($con, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $num = mysqli_fetch_array($ret);

    if ($num > 0) {
        // If credentials are correct
        $_SESSION['alogin'] = $_POST['username'];
        $_SESSION['id'] = $num['id'];

        // Redirect to change password page
        $extra = "change-password.php";
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("Location: http://$host$uri/$extra");
        exit();
    } else {
        // If credentials are incorrect
        $_SESSION['errmsg'] = "Invalid username or password";

        // Redirect back to login page
        $extra = "index.php";
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("Location: http://$host$uri/$extra");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Portal | Admin Login</title>

    <!-- Stylesheets -->
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i>
                </a>
                <a class="brand" href="index.html">
                    Shopping Portal | Admin
                </a>
                <div class="nav-collapse collapse navbar-inverse-collapse">
                    <ul class="nav pull-right">
                        <li>
                            <a href="http://localhost:8080/shopping/">Back to Portal</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Wrapper -->
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <!-- Login Module -->
                <div class="module module-login span4 offset4">
                    <form class="form-vertical" method="post">
                        <div class="module-head">
                            <h3>Sign In</h3>
                        </div>
                        <!-- Error Message -->
                        <span style="color:red;">
                            <?php echo htmlentities($_SESSION['errmsg']); ?>
                            <?php echo htmlentities($_SESSION['errmsg'] = ""); ?>
                        </span>
                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="text" id="inputEmail" name="username" placeholder="Username" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="password" id="inputPassword" name="password" placeholder="Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button type="submit" class="btn btn-primary pull-right" name="submit">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.module-login -->
            </div>
        </div>
    </div>
    <!-- /.wrapper -->

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <b class="copyright">&copy; 2018 RKJR Shopping Portal </b> All rights reserved.
        </div>
    </div>

    <!-- Scripts -->
    <script src="scripts/jquery-1.9.1.min.js"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
