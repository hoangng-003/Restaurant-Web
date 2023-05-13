<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if (empty($_SESSION['user_id']))  //if user is not login redirected back to login page
{
    header('location:login.php');
}
else{
if (isset($_POST['submit'])) {
    $sql_insert_fb = "INSERT INTO dishes_feedbacks(u_id,d_id,rating_value,feedback)
            VALUES('" . $_SESSION['user_id'] . "','" . $_POST['d_id'] . "','" . $_POST['rating'] . "','" . $_POST['opinion'] . "')";
    mysqli_query($db, $sql_insert_fb);
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
    <title>Orders</title>
    <!-- Bootstrap core CSS -->
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">

    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/feedback.css">
    <link rel="stylesheet" href="css/profile.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style type="text/css" rel="stylesheet">

        :root{
            --primary-color: #60ba62;
        }
        .indent-small {
            margin-left: 5px;
        }

        .form-group.internal {
            margin-bottom: 0;
        }

        .dialog-panel {
            margin: 10px;
        }

        .datepicker-dropdown {
            z-index: 200 !important;
        }

        .panel-body {
            background: #e5e5e5;
            /* Old browsers */
            background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
            /* FF3.6+ */
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
            /* Chrome,Safari4+ */
            background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
            /* Chrome10+,Safari5.1+ */
            background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
            /* Opera 12+ */
            background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
            /* IE10+ */
            background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
            /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
            /* IE6-9 fallback on horizontal gradient */
            font: 600 15px "Open Sans", Arial, sans-serif;
        }

        label.control-label {
            font-weight: 600;
            color: #777;
        }

        .order-table .row{
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 40px 0 rgba(0,0,0,.15);
            -moz-box-shadow: 0 0 40px 0 rgba(0,0,0,.15);
            -webkit-box-shadow: 0 0 40px 0 rgba(0,0,0,.15);
            -o-box-shadow: 0 0 40px 0 rgba(0,0,0,.15);
            -ms-box-shadow: 0 0 40px 0 rgba(0,0,0,.15)
        }

        table {
            width: 750px;
            border-collapse: collapse;
            margin: auto;
        }

        /* Zebra striping */
        tr:nth-of-type(odd) {
            /*background: #eee;*/
        }

        th {
            background: var(--gray1-9);
            color: white;
            font-weight: bold;

        }

        td, th {
            padding: 10px;
            /*border: 1px solid var(--primary-color);*/
            text-align: left;
            font-size: 14px;
        }

        /*
        Max width before this PARTICULAR table gets nasty
        This query will take effect for any screen smaller than 760px
        and also iPads specifically.
        */
        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {

            table {
                width: 100%;
            }

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                /* Now like a table header */
                position: absolute;
                /* Top/left values mimic padding */
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                /* Label the data */
                content: attr(data-column);

                color: #000;
                font-weight: bold;
            }

        }


    </style>

</head>

<body>

<!--header starts-->
<?php include_once("./header.php") ?>
<div class="page-wrapper">
    <!-- top Links -->

    <!-- end:Top links -->
    <!-- start: Inner page hero -->
    <div class="inner-page-hero bg-image" data-image-src="images/img/res.jpeg">
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
            <div class="row order__container">
                <div class="order-widget col-xs-12 col-sm-3 col-md-3 col-lg-3">
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
                                        Sandwich
                                    </a></li>
                                <li><a href="#" class="tag">
                                        Com tam
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
                    <!-- end:Widget -->
                </div>
                <div class="order-table col-xs-12 col-sm-7 col-md-7 ">
                    <div class="bg-gray">
                        <div class="row" >
                            <table>
                                <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>price</th>
                                    <th>status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                    <th>Feedback</th>
                                </tr>
                                </thead>
                                <tbody>


                                <?php
                                // displaying current session user login orders
                                $query_res = mysqli_query($db, "select *, date(date) as dmy, TIME_FORMAT(date,'%H:%i:%s') as hms from users_orders where u_id='" . $_SESSION['user_id'] . "'");
                                if (!mysqli_num_rows($query_res) > 0) {
                                    echo '<td colspan="6" style="text-align: center;">You have No orders Placed yet. </td>';
                                } else {

                                    while ($row = mysqli_fetch_array($query_res)) {

                                        ?>
                                        <tr>
                                            <td data-column="Item"> <?php echo $row['title']; ?></td>
                                            <td data-column="Quantity"> <?php echo $row['quantity']; ?></td>
                                            <td data-column="price">$<?php echo $row['price']; ?></td>
                                            <td data-column="status">
                                                <?php
                                                $status = $row['status'];
                                                if ($status == "" or $status == "NULL") {
                                                    ?>
                                                    <span class="badge badge-pill badge-secondary">Dispatch</span>
                                                    <?php
                                                }
                                                if ($status == "in process") { ?>
                                                    <span class="badge badge-pill badge-warning">On a way!</span>
                                                    <?php
                                                }
                                                if ($status == "closed") {
                                                    ?>
                                                    <span class="badge badge-pill badge-success">Success</span>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if ($status == "rejected") {
                                                    ?>
                                                    <button type="button" class="btn btn-danger"><i
                                                                class="fa fa-close"></i>cancelled
                                                    </button>
                                                    <?php
                                                }
                                                ?>

                                            </td>
                                            <td data-column="Date"> <?php echo $row['hms']."<br>".$row['dmy']; ?></td>
                                            <td data-column="Action"><a
                                                        href="delete_orders.php?order_del=<?php echo $row['o_id']; ?>"
                                                        onclick="return confirm('Are you sure you want to cancel your order?');"
                                                        class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i
                                                            class="fa fa-trash-o" style="font-size:16px"></i></a>
                                            </td>
                                            <td data-column="Feedback"
                                            ">
                                            <form action="" method="post">
                                                <div>
                                                    <input type="number" name="d_id" hidden>
                                                    <a class="btn btn-info btn-flat btn-addon btn-xs m-b-10 <?php if($status != "closed") echo "forbidden-feedback"; else echo "show-feedback"; ?>"
                                                       d_id="<?php echo $row['d_id']; ?>" ;>
                                                        <i class="fa fa-star-o"
                                                           style="font-size:16px; color: white;"></i>
                                                    </a>
                                                </div>
                                            </form>
                                            </td>
                                        </tr>


                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                        <!--end:row -->
                    </div>

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
<div class="feedback-modal" id="feedback-modal">
    <div class="modal-content">
        <div class="wrapper">
            <h3>How do you feel?</h3>
            <form name="feedback-form" action="" method="post" onsubmit="return validateFormFeedBack()">
                <div class="rating">
                    <input type="number" name="rating" hidden>
                    <i class='bx bx-star star' style="--i: 0;"></i>
                    <i class='bx bx-star star' style="--i: 1;"></i>
                    <i class='bx bx-star star' style="--i: 2;"></i>
                    <i class='bx bx-star star' style="--i: 3;"></i>
                    <i class='bx bx-star star' style="--i: 4;"></i>
                </div>
                <div class="d_id">
                    <input type="number" name="d_id" hidden>
                </div>
                <textarea name="opinion" cols="30" rows="5" placeholder="Your opinion..."></textarea>
                <div class="btn-group">
                    <button type="submit" name="submit" class="btn submit">Submit</button>
                    <button type="button" class="btn cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once("profile_modal.php") ?>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<script src="js/lib/jquery.min.js"></script>
<script src="js/lib/tether.min.js"></script>
<script src="js/lib/bootstrap.min.js"></script>
<script src="js/lib/bootstrap-slider.min.js"></script>
<script src="js/lib/jquery.isotope.min.js"></script>
<script src="js/lib/headroom.js"></script>
<script src="js/thegreen.js"></script>
<script src="js/widget-body.js"></script>
<script src="js/feedback.js"></script>
<script src="js/profile.js"></script>
</body>

</html>
<?php
}
?>