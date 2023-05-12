<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  //include connection file
error_reporting(0);  // using to hide undefined undex errors
session_start(); //start temp session until logout/browser closed
include_once 'product_action.php'; //including controller
if (isset($_POST['submit'])){
    if (empty($_POST['current_password'])||
        empty($_POST['new_password'])){
        $error = '<div class="alert alert-danger col-lg-8" style="position: relative; left: 50%; transform: translateX(-50%); margin-top: 1rem">
                    <strong>Danger! </strong>All field required!</div>';
    }else{
        $sql = "SELECT * FROM users WHERE u_id='$_SESSION[user_id]' and password='" . md5($_POST["current_password"]) . "'";
        $query = mysqli_query($db,$sql);
        $result = mysqli_fetch_array($query);
        if (empty($result)){
            $error = '<div class="alert alert-danger col-lg-8" style="position: relative; left: 50%; transform: translateX(-50%); margin-top: 1rem">
                    <strong>Danger! </strong>Incorrect Password!</div>';
        }else{
            if (strlen($_POST['new_password'])<6){
                $error = '<div class="alert alert-danger col-lg-8" style="position: relative; left: 50%; transform: translateX(-50%); margin-top: 1rem">
                    <strong>Danger! </strong>New password must be >=6</div>';
            }else{
                $mql = "update users set password ='".md5($_POST["new_password"])."'  where u_id='$_SESSION[user_id]' ";
                mysqli_query($db, $mql);
                $success = '<div class="alert alert-success col-lg-8" style="position: relative; left: 50%; transform: translateX(-50%); margin-top: 1rem">
                          <strong>Success!</strong> All changes has saved!</div>';
            }
        }
    }
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
    <title>Update Password</title>
    <!-- Bootstrap core CSS -->
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="css/profile.css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="home">
<!--header starts-->
<?php include_once("./header.php") ?>

<div class="page-wrapper">
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row">

            <?php
                echo $error;
                echo $success;
            ?>
            <!-- Start Page Content -->
            <div style="position: relative">
                <div class="col-lg-8" style="position: relative; left: 50%; transform: translateX(-50%)">
                    <form action='' method='post'>
                        <div class="form-body">
                            <hr>
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Current Password</label>
                                        <input type="password" name="current_password" class="form-control"
                                               placeholder="Current Password">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">New Password</label>
                                        <input type="password" name="new_password"
                                               class="form-control form-control-danger"
                                               placeholder="New Password">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" name="submit" class="btn btn-success" value="Save">
                            <a href="index.php" class="btn btn-inverse">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->
</div>
<!-- End Page wrapper  -->

<!-- start: FOOTER -->
<?php
include_once ("./profile_modal.php");
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
<script src="js/profile.js"></script>
</body>

</html>
