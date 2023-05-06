<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();
if (empty($_SESSION["user_id"]))
{
    header('location:login.php');
}
else{


foreach ($_SESSION["cart_item"] as $item) {

    $item_total += ($item["price"] * $item["quantity"]);

    if ($_POST['submit']) {

        $SQL = "insert into users_orders(u_id, d_id, title, quantity, price) 
                values('" . $_SESSION["user_id"] . "','" . $item["d_id"] . "','".$item["title"] . "','" . $item["quantity"] . "','" . $item["price"] . "')";
        mysqli_query($db, $SQL);
        $success = "Thank you! Your Order Placed successfully!";
    }
}
if ($_POST['submit']) {
    unset($_SESSION["cart_item"]);
}

?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Checkout</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="site-wrapper">
    <!--header starts-->
    <?php include_once("./header.php") ?>
    <div class="page-wrapper">
        <div class="top-links">
            <div class="container">
                <ul class="row links">

                    <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose
                            Restaurant</a></li>
                    <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Order and Pay
                            online</a></li>
                </ul>
            </div>
        </div>

        <div class="container">
            <h4 style="color:green; text-align: center">
                <?php echo $success; ?>
            </h4>
        </div>

        <div class="container m-t-30" style="margin-top:0 ">
            <form action="" method="post">
                <div class="widget clearfix">

                    <div class="widget-body">
                        <form method="post" action="#">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Cart Summary</h4></div>
                                        <div class="cart-totals-fields">

                                            <table class="table">
                                                <tbody>

                                                <tr>
                                                    <td>Cart Subtotal</td>
                                                    <td> <?php echo "$" . $item_total; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping &amp; Handling</td>
                                                    <td>free shipping</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-color"><strong>Total</strong></td>
                                                    <td class="text-color">
                                                        <strong> <?php echo "$" . $item_total; ?></strong></td>
                                                </tr>
                                                </tbody>


                                            </table>
                                        </div>
                                    </div>
                                    <!--cart summary-->
                                    <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio  m-b-20">
                                                    <input name="mod" id="radioStacked1" checked value="COD"
                                                           type="radio" class="custom-control-input"> <span
                                                            class="custom-control-indicator"></span> <span
                                                            class="custom-control-description">Payment on delivery</span>
                                                    <br> <span>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="mod" type="radio" value="paypal" disabled
                                                           class="custom-control-input"> <span
                                                            class="custom-control-indicator"></span> <span
                                                            class="custom-control-description">Paypal <img
                                                                src="images/paypal.jpg" alt="" width="90"></span>
                                                </label>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"><input type="submit"
                                                                         onclick="return confirm('Are you sure?');"
                                                                         name="submit"
                                                                         class="btn btn-outline-success btn-block"
                                                                         value="Order now"></p>
                                    </div>
                        </form>
                    </div>
                </div>

        </div>
    </div>
    </form>
</div>
<section class="app-section">
    <div class="app-wrap">
        <div class="container">
            <div class="row text-img-block text-xs-left">
                <div class="container">
                    <div class="col-xs-12 col-sm-6  right-image text-center">
                        <figure><img src="images/app.png" alt="Right Image"></figure>
                    </div>
                    <div class="col-xs-12 col-sm-6 left-text">
                        <h3>The Best Food Delivery App</h3>
                        <p>Now you can make food happen pretty much wherever you are thanks to the free easy-to-use Food
                            Delivery &amp; Takeout App.</p>
                        <div class="social-btns">
                            <a href="#" class="app-btn apple-button clearfix">
                                <div class="pull-left"><i class="fa fa-apple"></i></div>
                                <div class="pull-right"><span class="text">Available on the</span> <span class="text-2">App Store</span>
                                </div>
                            </a>
                            <a href="#" class="app-btn android-button clearfix">
                                <div class="pull-left"><i class="fa fa-android"></i></div>
                                <div class="pull-right"><span class="text">Available on the</span> <span class="text-2">Play store</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- start: FOOTER -->
<?php
include_once("./footer.php");
?>
<!-- end:Footer -->
</div>
<!-- end:page wrapper -->
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/headroom.js"></script>
<script src="js/thegreen.min.js"></script>
</body>

</html>

<?php
}
?>
