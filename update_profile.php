<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  //include connection file
error_reporting(0);  // using to hide undefined undex errors
session_start(); //start temp session until logout/browser closed
include_once 'product_action.php'; //including controller

if (isset($_POST['submit'])) {
    if (empty($_POST['first_name']) ||
        empty($_POST['last_name']) ||
        empty($_POST['email']) ||
        empty($_POST['phone']||
        empty($_POST['address']))) {
        $error = '<div class="alert alert-danger col-lg-8" style="position: relative; left: 50%; transform: translateX(-50%); margin-top: 1rem">
                    <strong>Danger! </strong>All field required!</div>';
    } else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
        {
            $error = '<div class="alert alert-danger col-lg-8" style="position: relative; left: 50%; transform: translateX(-50%); margin-top: 1rem">
                    <strong>Danger! </strong>Invalid email!</div>';
        } elseif (strlen($_POST['phone']) < 10) {
            $error = '<div class="alert alert-danger col-lg-8" style="position: relative; left: 50%; transform: translateX(-50%); margin-top: 1rem">
                    <strong>Danger! </strong>Invalid phone number!</div>';
        } else {
            $sql = "update users set f_name='$_POST[first_name]', l_name='$_POST[last_name]',email='$_POST[email]',phone='$_POST[phone]',address ='$_POST[address]' where u_id='$_SESSION[user_id]' ";
            mysqli_query($db, $sql);
            $success = '<div class="alert alert-success col-lg-8" style="position: relative; left: 50%; transform: translateX(-50%); margin-top: 1rem">
                          <strong>Success!</strong> All changes has saved!</div>';
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
    <title>Update Profile</title>
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
                    <?php
                    $query_user = "select * from users where u_id='$_SESSION[user_id]'";
                    $result = mysqli_query($db, $query_user);
                    $row = mysqli_fetch_array($result); ?>
                    <form action='' method='post'>
                        <div class="form-body">

                            <hr>
                            <div class="row p-t-20">
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Firstname</label>
                                        <input type="text" name="first_name"
                                               class="form-control form-control-danger"
                                               value="<?php echo $row['f_name']; ?>" placeholder="jon">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Lastname </label>
                                        <input type="text" name="last_name" class="form-control"
                                               placeholder="doe" value="<?php echo $row['l_name']; ?>">
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" name="email"
                                               class="form-control"
                                               value="<?php echo $row['email']; ?>"
                                               placeholder="example@gmail.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Phone</label>
                                        <input type="text" name="phone"
                                               class="form-control"
                                               value="<?php echo $row['phone']; ?>" placeholder="phone">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Address</label>
                                        <input type="text" name="address"
                                               class="form-control"
                                               value="<?php echo $row['address']; ?>">
                                    </div>
                                </div>
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
