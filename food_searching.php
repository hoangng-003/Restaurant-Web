<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  //include connection file
error_reporting(0);  // using to hide undefined undex errors
session_start(); //start temp session until logout/browser closed
include_once 'product-action.php'; //including controller
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Food Searching</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="home">
<!--header starts-->
<?php include_once("./header.php") ?>
<!-- .navbar -->
<nav class="navbar navbar-dark">
    <div class="container">
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
                data-target="#mainNavbarCollapse">&#9776;
        </button>
        <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/food-picky-logo.png" alt="">
        </a>
        <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="index.php">Home <span
                                class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item"><a class="nav-link active" href="restaurants.php">Restaurants <span
                                class="sr-only"></span></a></li>


                <?php
                if (empty($_SESSION["user_id"])) // if user is not login
                {
                    echo '<li class="nav-item"><a href="login.php" class="nav-link active">login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">signup</a> </li>';
                } else {
                    //if user is login

                    echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">your orders</a> </li>';
                    echo '<li class="nav-item"><a href="logout.php" class="nav-link active">logout</a> </li>';
                }

                ?>

            </ul>

        </div>
    </div>
</nav>
<!-- /.navbar -->
</header>

<div class="page-wrapper">
    <div class="breadcrumb">
        <div class="container" style=" display: flex; justify-content: center; align-items: center;">
            <form class="form-inline" action="./food_searching.php" method="get">
                <div class="form-group">
                    <label class="sr-only" for="exampleInputAmount">I would like to eat....</label>
                    <div class="form-group">
                        <input name="name" type="text" class="form-control form-control-lg" id="exampleInputAmount"
                               placeholder="I would like to eat...." style="width: 50vw;"></div>
                </div>
                <button type="submit" class="btn theme-btn btn-lg" style="width: 20vw">Search
                </button>
            </form>
        </div>
    </div>
    <div class="container m-t-30">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">

                <div class="widget widget-cart">
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark">
                            Your Shopping Cart
                        </h3>


                        <div class="clearfix"></div>
                    </div>
                    <div class="order-row bg-white">
                        <div class="widget-body">


                            <?php

                            $item_total = 0;

                            foreach ($_SESSION["cart_item"] as $item)  // fetch items define current into session ID
                            {
                                ?>

                                <div class="title-row">
                                    <?php echo $item["title"]; ?><a
                                            href="food_searching.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>">
                                        <i class="fa fa-trash pull-right"></i></a>
                                </div>

                                <div class="form-group row no-gutter">
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control b-r-0"
                                               value=<?php echo "$" . $item["price"]; ?> readonly id="exampleSelect1">

                                    </div>
                                    <div class="col-xs-4">
                                        <input class="form-control" type="text" readonly
                                               value='<?php echo $item["quantity"]; ?>' id="example-number-input"></div>

                                </div>

                                <?php
                                $item_total += ($item["price"] * $item["quantity"]); // calculating current price into cart
                            }
                            ?>


                        </div>
                    </div>

                    <!-- end:Order row -->

                    <div class="widget-body">
                        <div class="price-wrap text-xs-center">
                            <p>TOTAL</p>
                            <h3 class="value"><strong><?php echo "$" . $item_total; ?></strong></h3>
                            <p>Free Shipping</p>
                            <a href="checkout.php?res_id=<?php echo $_GET['res_id']; ?>&action=check"
                               class="btn theme-btn btn-lg">Checkout</a>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">

                <!-- end:Widget menu -->
                <div class="menu-widget" id="2">
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark">
                            Search results <a class="btn btn-link pull-right" data-toggle="collapse"
                                              href="#popular2" aria-expanded="true">
                                <i class="fa fa-angle-right pull-right"></i>
                                <i class="fa fa-angle-down pull-right"></i>
                            </a>
                        </h3>
                        <div class="clearfix"></div>
                    </div>

                    <div class="collapse in" id="popular2">
                        <?php // display values and item of food/dishes
                        if (isset($_GET["name"])) {
                            $query_food = $db->prepare("select * from dishes where title like '%${_GET["name"]}%'");
                            $query_food->execute();
                            $products = $query_food->get_result();

                        }
                        if (!empty($products)) {
                            foreach ($products as $product) {

                                ?>
                                <div class="food-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
                                            <form method="post"
                                                  action='food_searching.php?res_id=<?php echo $product['rs_id']; ?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                                <div class="rest-logo pull-left">
                                                    <a class="restaurant-logo pull-left"
                                                       href="#"><?php echo '<img src="admin/Res_img/dishes/' . $product['img'] . '" alt="Food logo">'; ?></a>
                                                </div>
                                                <!-- end:Logo -->
                                                <div class="rest-descr">
                                                    <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                                    <p> <?php echo $product['slogan']; ?></p>
                                                </div>
                                                <!-- end:Description -->
                                        </div>
                                        <!-- end:col -->
                                        <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info">
                                            <span class="price pull-left">$<?php echo $product['price']; ?></span>
                                            <input class="b-r-0" type="text" name="quantity" style="margin-left:30px;"
                                                   value="1" size="2"/>
                                            <input type="submit" class="btn theme-btn" style="margin-left:40px;"
                                                   value="Add to cart"/>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- end:row -->
                                </div>
                                <!-- end:Food item -->

                                <?php
                            }
                        }

                        ?>


                    </div>
                    <!-- end:Collapse -->
                </div>
                <!-- end:Widget menu -->

            </div>
            <!-- end:Bar -->
            <div class="col-xs-12 col-md-12 col-lg-3">
                <div class="sidebar-wrap">
                    <div class="widget clearfix">
                        <!-- /widget heading -->
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">
                                Popular tags
                            </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="widget-body">
                            <ul class="tags">
                                <li><a href="#" class="tag">
                                        Coupons
                                    </a></li>
                                <li><a href="#" class="tag">
                                        Discounts
                                    </a></li>
                                <li><a href="#" class="tag">
                                        Deals
                                    </a></li>
                                <li><a href="#" class="tag">
                                        Amazon
                                    </a></li>
                                <li><a href="#" class="tag">
                                        Ebay
                                    </a></li>
                                <li><a href="#" class="tag">
                                        Fashion
                                    </a></li>
                                <li><a href="#" class="tag">
                                        Shoes
                                    </a></li>
                                <li><a href="#" class="tag">
                                        Kids
                                    </a></li>
                                <li><a href="#" class="tag">
                                        Travel
                                    </a></li>
                                <li><a href="#" class="tag">
                                        Hosting
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end:Right Sidebar -->
        </div>
        <!-- end:row -->
    </div>
    <!-- end:Container -->
    <section class="app-section">
        <div class="app-wrap">
            <div class="container">
                <div class="row text-img-block text-xs-left">
                    <div class="container">
                        <div class="col-xs-12 col-sm-6 hidden-xs-down right-image text-center">
                            <figure><img src="images/app.png" alt="Right Image"></figure>
                        </div>
                        <div class="col-xs-12 col-sm-6 left-text">
                            <h3>The Best Food Delivery App</h3>
                            <p>Now you can make food happen pretty much wherever you are thanks to the free easy-to-use
                                Food Delivery &amp; Takeout App.</p>
                            <div class="social-btns">
                                <a href="#" class="app-btn apple-button clearfix">
                                    <div class="pull-left"><i class="fa fa-apple"></i></div>
                                    <div class="pull-right"><span class="text">Available on the</span> <span
                                                class="text-2">App Store</span></div>
                                </a>
                                <a href="#" class="app-btn android-button clearfix">
                                    <div class="pull-left"><i class="fa fa-android"></i></div>
                                    <div class="pull-right"><span class="text">Available on the</span> <span
                                                class="text-2">Play store</span></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- start: FOOTER -->
    <footer class="footer">
        <div class="container">
            <!-- top footer statrs -->
            <div class="row top-footer">
                <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                    <a href="#"> <img src="images/food-picky-logo.png" alt="Footer logo"> </a> <span>Order Delivery &amp; Take-Out </span>
                </div>
                <div class="col-xs-12 col-sm-2 about color-gray">
                    <h5>About Us</h5>
                    <ul>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">History</a></li>
                        <li><a href="#">Our Team</a></li>
                        <li><a href="#">We are hiring</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-2 how-it-works-links color-gray">
                    <h5>How it Works</h5>
                    <ul>
                        <li><a href="#">Enter your location</a></li>
                        <li><a href="#">Choose restaurant</a></li>
                        <li><a href="#">Choose meal</a></li>
                        <li><a href="#">Pay via credit card</a></li>
                        <li><a href="#">Wait for delivery</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-2 pages color-gray">
                    <h5>Pages</h5>
                    <ul>
                        <li><a href="#">Search results page</a></li>
                        <li><a href="#">User Sing Up Page</a></li>
                        <li><a href="#">Pricing page</a></li>
                        <li><a href="#">Make order</a></li>
                        <li><a href="#">Add to cart</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-3 popular-locations color-gray">
                    <h5>Popular locations</h5>
                    <ul>
                        <li><a href="#">Sarajevo</a></li>
                        <li><a href="#">Split</a></li>
                        <li><a href="#">Tuzla</a></li>
                        <li><a href="#">Sibenik</a></li>
                        <li><a href="#">Zagreb</a></li>
                        <li><a href="#">Brcko</a></li>
                        <li><a href="#">Beograd</a></li>
                        <li><a href="#">New York</a></li>
                        <li><a href="#">Gradacac</a></li>
                        <li><a href="#">Los Angeles</a></li>
                    </ul>
                </div>
            </div>
            <!-- top footer ends -->
            <!-- bottom footer statrs -->
            <div class="row bottom-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 payment-options color-gray">
                            <h5>Payment Options</h5>
                            <ul>
                                <li>
                                    <a href="#"> <img src="images/paypal.png" alt="Paypal"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/maestro.png" alt="Maestro"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/stripe.png" alt="Stripe"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/bitcoin.png" alt="Bitcoin"> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-4 address color-gray">
                            <h5>Address</h5>
                            <p>Concept design of oline food order and deliveye,planned as restaurant directory</p>
                            <h5>Phone: <a href="tel:+080000012222">080 000012 222</a></h5></div>
                        <div class="col-xs-12 col-sm-5 additional-info color-gray">
                            <h5>Addition informations</h5>
                            <p>Join the thousands of other restaurants who benefit from having their menus on
                                TakeOff</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- bottom footer ends -->
        </div>
    </footer>
    <!-- end:Footer -->
</div>
<!-- end:page wrapper -->
</div>

<!-- start: FOOTER -->
<?php
include_once("./footer.php");
?>
<!-- end:Footer -->

<!-- Bootstrap core JavaScript
================================================== -->
<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/headroom.js"></script>
<script src="js/foodpicky.min.js"></script>
<script src="js/widget_body.js"></script>
</body>

</html>
