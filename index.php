<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  //include connection file
include_once 'product_action.php'; //including controller
error_reporting(0);  // using to hide undefined index errors
session_start(); //start temp session until logout/browser closed

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>The Green</title>
    <!-- Bootstrap core CSS -->
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="css/review.css">
    <link rel="stylesheet" href="css/profile.css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="home">

<!--header starts-->
<?php include_once("./header.php") ?>
<!-- banner part starts -->
<section class="hero bg-image" data-image-src="images/img/main.jpg">
    <div class="hero-inner">
        <div class="container text-center hero-text">
            <h1>Savor the flavor of vegetarian cuisine! </h1>
            <h5 class="space-xs">Find restaurants, specials, and coupons for free</h5>
            <div class="banner-form">
                <form class="form-inline" action="./food_searching.php" method="get">
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputAmount">I would like to eat....</label>

                        <input name="name" type="text" class="form-control form-control-lg" id="exampleInputAmount"
                               placeholder="I would like to eat....">
                    </div>
                    <button type="submit" class="btn theme-btn btn-lg">Search
                    </button>
                </form>
            </div>
            <div class="steps">
                <div class="step-item step1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" fill="white"
                         class="bi bi-houses" viewBox="0 0 16 16">
                        <path d="M5.793 1a1 1 0 0 1 1.414 0l.647.646a.5.5 0 1 1-.708.708L6.5 1.707 2 6.207V12.5a.5.5 0 0 0 .5.5.5.5 0 0 1 0 1A1.5 1.5 0 0 1 1 12.5V7.207l-.146.147a.5.5 0 0 1-.708-.708L5.793 1Zm3 1a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708L8.793 2Zm.707.707L5 7.207V13.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5V7.207l-4.5-4.5Z"/>
                    </svg>
                    <h4><span>1. </span>Choose Restaurant</h4>
                </div>
                <!-- end:Step -->
                <div class="step-item step2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" fill="white" class="bi bi-bag-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                    </svg>
                    <h4><span>2. </span>Order Food</h4>
                </div>
                <!-- end:Step -->
                <div class="step-item step3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" fill="white"
                         class="bi bi-truck" viewBox="0 0 16 16">
                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg>
                    <h4><span>3. </span>Delivery or take out</h4>
                </div>
                <!-- end:Step -->
            </div>
            <!-- end:Steps -->
        </div>
    </div>
    <!--end:Hero inner -->
</section>
<!-- banner part ends -->


<!-- Popular block starts -->
<section class="popular">
    <div class="container">
        <div class="title text-xs-center m-b-30">
            <h2 STYLE="text-transform: uppercase;">Popular Dishes of the Month</h2>
            <p class="lead">The easiest way to your favourite food</p>
        </div>
        <div class="row">
            <?php
            // fetch records from database to display popular first 3 dishes from table
            $query_recent_dishes = mysqli_query($db, "select getDishFeedbackRating(d_id) as rating, getDishReviewCount(d_id) as rvcount, r.rs_id, d.title, d.d_id, d.slogan,
            d.price, d.img, r.latitude, r.longitude from dishes d join restaurant r on r.rs_id = d.rs_id limit 3;");

            $review_list = '';
            while ($r = mysqli_fetch_array($query_recent_dishes)) {
                $query_reviews = mysqli_query($db, "select df.*, concat_ws(' ',u.f_name,u.l_name) as u_name from dishes_feedbacks df join users u on df.u_id=u.u_id where d_id='$r[d_id]'");

                $review_list = $review_list . "<div class='product-rating'  d_id = '$r[d_id]' style='display: none'>";
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
                        "</div>";
                }
                $review_list = $review_list . "</div>";

                echo '  <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                            <div class="food-item-wrap">
                                <div class="figure-wrap bg-image" data-image-src="admin/res_img/dishes/' . $r['img'] . '">
                                    <div class="distance" latitude = ' . $r['latitude'] . ' longitude = ' . $r['longitude'] . '>
                                        <i class="fa fa-pin"></i>
                                    </div>
                                    <div class="rating pull-left badge badge-light ' . $r['rating'] . '">
                                       ' . rating_star($r['rating']) . '
                                     </div>
                                     <div class="review pull-right"><button class="openModal" d_id=' . $r['d_id'] . '>' . $r['rvcount'] . ' reviews</button> </div>
                                </div>
                                <div class="content">
                                    <h5><a href="dishes.php?res_id=' . $r['rs_id'] . '">' . $r['title'] . '</a></h5>
                                    <div class="product-name">' . $r['slogan'] . '</div>
                                    <div class="price-btn-block"> <span class="price">$' . $r['price'] . '</span> <a href="dishes.php?res_id=' . $r['rs_id'] . '" class="btn theme-btn-dash pull-right">Order Now</a> </div>
                                </div>
                            </div>
                    </div>';
            }
            echo
                '<div class="review-modal" id="review-modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <div class="wrapper">
                                <h3 class="title">Review</h3>
                                <div>' . $review_list . '</div>
                            </div>
                        </div>
                </div>';
            ?>
        </div>
    </div>
</section>
<!-- Popular block ends -->

<!-- Featured restaurants starts -->
<section class="featured-restaurants">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="title-block pull-left">
                    <h4>FEATURED RESTAURANTS</h4>
                </div>
            </div>
            <div class="col-sm-8">
                <!-- restaurants filter nav starts -->
                <div class="restaurants-filter pull-right">
                    <nav class="primary pull-left">
                        <ul>
                            <li><a href="#" class="selected" data-filter="*">all</a></li>
                            <?php
                            // display categories here
                            $res = mysqli_query($db, "select * from res_category");
                            while ($row = mysqli_fetch_array($res)) {
                                echo '<li><a href="#" data-filter=".' . $row['c_name'] . '"> ' . $row['c_name'] . '</a> </li>';
                            }
                            ?>

                        </ul>
                    </nav>
                </div>
                <!-- restaurants filter nav ends -->
            </div>
        </div>
        <!-- restaurants listing starts -->
        <div class="row">
            <div class="restaurant-listing">

                <?php //fetching records from table and filter using html data-filter tag
                $ress = mysqli_query($db, "select getRestFeedbackRating(rs.rs_id) as rating, getRestReviewCount(rs.rs_id) as count, getMinDishPrice(rs.rs_id) as min_price, rs.* from restaurant rs");
                while ($rows = mysqli_fetch_array($ress)) {
                    // fetch records from res_category table according to catgory ID
                    $query = mysqli_query($db, "select * from res_category where c_id='" . $rows['c_id'] . "' ");
                    $rowss = mysqli_fetch_array($query);

                    echo ' <div class="col-xs-12 col-sm-12 col-md-6 single-restaurant all ' . $rowss['c_name'] . '">
                                <div class="restaurant-wrap">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-3 col-md-12 col-lg-3 text-xs-center">
                                                <a class="restaurant-logo" href="dishes.php?res_id=' . $rows['rs_id'] . '" > <img src="admin/Res_img/' . $rows['image'] . '" alt="Restaurant logo"> </a>
                                        </div>
                                        <!--end:col -->
                                        <div class="col-xs-12 col-sm-9 col-md-12 col-lg-9">
                                            <h5><a href="dishes.php?res_id=' . $rows['rs_id'] . '" >' . $rows['title'] . '</a></h5> <span>' . $rows['address'] . '</span>
                                            <div class="bottom-part">
                                                <div class="cost"><i class="fa fa-check"></i> Min $' . $rows['min_price'] . '</div>
                                                <div class="mins featured-restaurants-distance" latitude="' . $rows["latitude"] . '" longitude="' . $rows["longitude"] . '"><i class="fa fa-motorcycle"></i></div>
                                                <div class="ratings"> <span>
                                                    ' . rating_star($rows['rating']) . '
                                                    </span> (' . $rows['count'] . ') </div>
                                            </div>
                                        </div>
                                        <!-- end:col -->
                                        </div>
                                        <!-- end:row -->
                                </div>
                                <!--end:Restaurant wrap -->
                        </div>';
                }
                ?>
            </div>
        </div>
        <!-- restaurants listing ends -->

    </div>
</section>
<!-- Featured restaurants ends -->

<!-- How it works block starts -->
<section class="how-it-works">
    <div class="container">
        <div class="text-xs-center">
            <h2>Easy 3 Step Order</h2>
            <!-- 3 block sections starts -->
            <div class="row how-it-works-solution">
                <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col1">
                    <div class="how-it-works-wrap">
                        <div class="step step-1">
                            <div class="icon" data-step="1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" fill="white"
                                     class="bi bi-houses" viewBox="0 0 16 16">
                                    <path d="M5.793 1a1 1 0 0 1 1.414 0l.647.646a.5.5 0 1 1-.708.708L6.5 1.707 2 6.207V12.5a.5.5 0 0 0 .5.5.5.5 0 0 1 0 1A1.5 1.5 0 0 1 1 12.5V7.207l-.146.147a.5.5 0 0 1-.708-.708L5.793 1Zm3 1a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708L8.793 2Zm.707.707L5 7.207V13.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5V7.207l-4.5-4.5Z"/>
                                </svg>
                            </div>
                            <h3>Choose a restaurant</h3>
                            <p>We"ve got your covered with menus from over 345 delivery restaurants online.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col2">
                    <div class="step step-2">
                        <div class="icon" data-step="2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" fill="white" class="bi bi-bag-check" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg>
                        </div>
                        <h3>Choose a tasty dish</h3>
                        <p>We've got your covered with menus from over 345 delivery restaurants online.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 how-it-works-steps white-txt col3">
                    <div class="step step-3">
                        <div class="icon" data-step="3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" fill="white"
                                 class="bi bi-truck" viewBox="0 0 16 16">
                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            </svg>
                        </div>
                        <h3>Pick up or Delivery</h3>
                        <p>Get your food delivered! And enjoy your meal! Pay online on pickup or delivery</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- 3 block sections ends -->
        <div class="row">
            <div class="col-sm-12 text-center">
                <p class="pay-info"></p>
            </div>
        </div>
    </div>
</section>
<!-- How it works block ends -->

<?php include_once("profile_modal.php") ?>
<?php include_once("footer.php") ?>

<!-- Bootstrap core JavaScript
================================================== -->
<script src="js/lib/jquery.min.js"></script>
<script src="js/lib/tether.min.js"></script>
<script src="js/lib/bootstrap.min.js"></script>
<script src="js/lib/bootstrap-slider.min.js"></script>
<script src="js/lib/jquery.isotope.min.js"></script>
<script src="js/lib/headroom.js"></script>
<script src="js/get-distance.js"></script>
<script src="js/review.js"></script>
<script src="js/profile.js"></script>
<script src="js/thegreen.js"></script>
</body>

</html>