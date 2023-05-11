<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  //include connection file
error_reporting(0);  // using to hide undefined undex errors
session_start(); //start temp session until logout/browser closed
include_once 'product_action.php'; //including controller
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
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/review.css">
</head>

<body class="home">
<!--header starts-->
<?php include_once("./header.php") ?>

<div class="page-wrapper">
    <div class="breadcrumb">
        <div class="container" style=" display: flex; justify-content: center; align-items: center;">
            <form class="form-inline" action="./food_searching.php" method="get">
                <label class="sr-only" for="exampleInputAmount">I would like to eat....</label>
                <div class="form-group">
                    <input name="name" type="text" class="form-control form-control-lg" id="exampleInputAmount"
                           placeholder="I would like to eat...."></div>
                <button type="submit" class="btn theme-btn btn-lg">Search
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
                            $query_food = $db->prepare("select *, getDishReviewCount(d_id) as count from dishes where title like '%${_GET["name"]}%'");
                            $query_food->execute();
                            $products = $query_food->get_result();

                        }

                        $review_list = '';
                        if (!empty($products)) {
                            foreach ($products as $product) {
                                $query_reviews = mysqli_query($db, "select df.*, concat_ws(' ',u.f_name,u.l_name) as u_name from dishes_feedbacks df join users u on df.u_id=u.u_id where d_id='$product[d_id]'");
                                $review_list = $review_list . "<div class='product-rating'  d_id = '$product[d_id]' style='display: none'>";
                                while ($r_d = mysqli_fetch_array($query_reviews)) {
                                    $review_list = $review_list .
                                        "<div class='product-rating__wrap'>" .
                                        '<div class="product-rating__avatar">
                            <svg class="avatar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256s256-114.6 256-256S397.4 0 256 0zM256 128c39.77 0 72 32.24 72 72S295.8 272 256 272c-39.76 0-72-32.24-72-72S216.2 128 256 128zM256 448c-52.93 0-100.9-21.53-135.7-56.29C136.5 349.9 176.5 320 224 320h64c47.54 0 87.54 29.88 103.7 71.71C356.9 426.5 308.9 448 256 448z"/></svg>
                         </div>' .
                                        "<div class='product-rating__main'>
                                <div class='product-rating__author-name'>" . $r_d['u_name'] . "</div>
                                <div class='product-rating__rating_star'>" . rating_star($r_d['rating_value']) . "</div>
                                <div class='product-rating__feedback'>" . $r_d['feedback'] . "</div>
                            </div>" .
                                        "</div>"
                                    ;
                                }
                                $review_list = $review_list . "</div>";
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
                                                    <button type="button" class="openModal" d_id='<?php echo $product['d_id']; ?>'><?php echo $product['count']; ?> Reviews</button>
                                                </div>
                                                <!-- end:Description -->
                                        </div>
                                        <!-- end:col -->
                                        <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info">
                                            <span class="price pull-left">$<?php echo $product['price']; ?></span>
                                            <div class="counter">
                                                <span class="down">-</span>
                                                <input class="b-r-0" type="text" name="quantity"
                                                       value="1" size="2">
                                                <span class="up">+</span>
                                            </div>
                                            <input type="submit" class="btn theme-btn"
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
                        echo
                            '<div class="modal" id="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <div class="wrapper">
                                        <h3>Review</h3>
                                        <div>' . $review_list . '</div>
                                    </div>
                                </div>
                            </div>';
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

    <!-- start: FOOTER -->
    <?php include_once ("footer.php")?>
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
<script src="js/lib/jquery.min.js"></script>
<script src="js/lib/tether.min.js"></script>
<script src="js/lib/bootstrap.min.js"></script>
<script src="js/lib/bootstrap-slider.min.js"></script>
<script src="js/lib/jquery.isotope.min.js"></script>
<script src="js/lib/headroom.js"></script>
<script src="js/thegreen.min.js"></script>
<script src="js/review.js"></script>
<script src="js/widget-body.js"></script>
</body>

</html>
