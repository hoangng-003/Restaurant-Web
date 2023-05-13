<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product_action.php'; //including controller
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
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/review.css">
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
                            <?php
                            $query = mysqli_query($db, "select * from res_category limit 9");
                            while ($rows = mysqli_fetch_array($query)){
                                echo "<li><a href=\"#\" class=\"tag\">
                                    $rows[c_name]
                                </a></li>";
                            }
                            ?>
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
                                                    <li class="list-inline-item list-inline-item-distance" latitude="' . $rows["latitude"] . '" longitude="' . $rows["longitude"] . '"><i class="fa fa-motorcycle"></i> 30 min</li>
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

<?php include_once("profile_modal.php") ?>

<!-- Bootstrap core JavaScript
================================================== -->
<script src="js/lib/jquery.min.js"></script>
<script src="js/lib/tether.min.js"></script>
<script src="js/lib/bootstrap.min.js"></script>
<script src="js/lib/bootstrap-slider.min.js"></script>
<script src="js/lib/jquery.isotope.min.js"></script>
<script src="js/lib/headroom.js"></script>
<script src="js/thegreen.js"></script>
<script src="js/profile.js"></script>
<script src="js/widget-body.js"></script>
<script src="js/get-distance.js"></script>
</body>

</html>