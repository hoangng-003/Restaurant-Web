<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php'; //including controller
error_reporting(0);
session_start();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Restaurants</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/review-style.css">
</head>

<body>
<!--header starts-->
<?php include_once("./header.php") ?>
<div class="page-wrapper">
    <!-- top Links -->
    <div class="top-links">
        <div class="container">
            <ul class="row links">

                <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="restaurants.php">Choose
                        Restaurant</a></li>
                <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick Your favorite food</a></li>
                <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay online</a></li>
            </ul>
        </div>
    </div>
    <!-- end:Top links -->
    <!-- start: Inner page hero -->
    <div class="inner-page-hero bg-image" data-image-src="images/bg.jpg">
        <div class="container"></div>
        <!-- end:Container -->
    </div>
    <div class="result-show">
        <div class="container">
            <div class="row">


            </div>
        </div>
    </div>
    <!-- //results show -->
    <section class="restaurants-page">
        <div class="container">
            <div class="row rest__container">
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
                                    Pizza
                                </a></li>
                            <li><a href="#" class="tag">
                                    Sendwich
                                </a></li>
                            <li><a href="#" class="tag">
                                    Sendwich
                                </a></li>
                            <li><a href="#" class="tag">
                                    Fish
                                </a></li>
                            <li><a href="#" class="tag">
                                    Desert
                                </a></li>
                            <li><a href="#" class="tag">
                                    Salad
                                </a></li>
                        </ul>
                    </div>
                </div>
                <div class="bg-gray restaurant-entry">
                    <div class="row">
                        <?php $ress = mysqli_query($db, "select getRestFeedbackRating(rs.rs_id) as rating, getRestReviewCount(rs.rs_id) as count, getMinDishPrice(rs.rs_id) as min_price, rs.* from restaurant rs");
                        while ($rows = mysqli_fetch_array($ress)) {
                            echo ' <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
															<div class="entry-logo">
																<a class="img-fluid" href="dishes.php?res_id=' . $rows['rs_id'] . '" > <img src="admin/Res_img/' . $rows['image'] . '" alt="Food logo"></a>
															</div>
															<!-- end:Logo -->
															<div class="entry-dscr">
																<h5><a href="dishes.php?res_id=' . $rows['rs_id'] . '" >' . $rows['title'] . '</a></h5> <span>' . $rows['address'] . ' <a href="#">...</a></span>
																<ul class="list-inline">
																	<li class="list-inline-item"><i class="fa fa-check"></i> Min $' . $rows['min_price'] . '</li>
																	<li class="list-inline-item"><i class="fa fa-motorcycle"></i> 30 min</li>
																</ul>
															</div>
															<!-- end:Entry description -->
														</div>
														
														 <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
																<div class="right-content bg-white">
																	<div class="right-review">
																		<div class="rating-block">
																		 ' . rating_star($rows['rating']) . '
																    </div>
																		<p> ' . $rows['count'] . ' Reviews</p> <a href="dishes.php?res_id=' . $rows['rs_id'] . '" class="btn theme-btn-dash">View Menu</a> </div>
																</div>
																<!-- end:right info -->
															</div>';
                        }


                        ?>

                    </div>
                    <!--end:row -->
                </div>
            </div>
        </div>
    </section>
</div>

<!-- start: FOOTER -->
<?php
include_once("./footer.php");
?>
<!-- end:Footer -->
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
<script src="js/widget_body.js"></script>
</body>

</html>