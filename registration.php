<!DOCTYPE html>
<html lang="en">
<?php

session_start(); //temp session
error_reporting(0); // hide undefine index
include("connection/connect.php"); // connection
if (isset($_POST['submit'])) //if submit btn is pressed
{
    if (empty($_POST['firstname']) ||  //fetching and find if its empty
        empty($_POST['lastname']) ||
        empty($_POST['email']) ||
        empty($_POST['phone']) ||
        empty($_POST['password']) ||
        empty($_POST['cpassword'])) {
        $message = "All fields must be required!";
    } else {
        //checking username & email if already present
        $check_username = mysqli_query($db, "SELECT username FROM users where username = '" . $_POST['username'] . "' ");
        $check_email = mysqli_query($db, "SELECT email FROM users where email = '" . $_POST['email'] . "' ");

        if (mysqli_num_rows($check_username) > 0)  //check username
        {
            $message = 'Username already exists!';
        } elseif (mysqli_num_rows($check_email) > 0) //check email
        {
            $message = 'Email already exists!';
        } else {

            //inserting values into db
            $mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('" . $_POST['username'] . "','" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . md5($_POST['password']) . "','" . $_POST['address'] . "')";
            mysqli_query($db, $mql);
            $success = "Account Created successfully! <p>You will be redirected in <span id='counter'>5</span> second(s).</p>
														<script type='text/javascript'>
                                                            function countdown() {
                                                                var i = document.getElementById('counter');
                                                                if (parseInt(i.innerHTML)<=0) {
                                                                    location.href = 'login.php';
                                                                }
                                                                i.innerHTML = parseInt(i.innerHTML)-1;
                                                            }
                                                            setInterval(function(){countdown();},1000);
														</script>'";
            header("refresh:0;url=login.php"); //
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
    <title>Signup</title>
    <!-- Bootstrap core CSS -->
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?php include_once("./header.php") ?>

<div class="page-wrapper">
    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="#" class="active">
                        <span style="color:red;"><?php echo $message; ?></span>
                        <span style="color:green;">
								<?php echo $success; ?>
                        </span>
                    </a></li>

            </ul>
        </div>
    </div>
    <section class="contact-page inner-page">
        <div class="container">
            <div class="row">
                <!-- REGISTER -->
                <div class="col-md-8">
                    <div class="widget">
                        <div class="widget-body">

                            <form action="" method="post" onsubmit="return isValidate();">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="username-input">Username</label>
                                        <input class="form-control" type="text" name="username" id="username-input"
                                               placeholder="UserName">
                                        <small>Error message</small>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="first-name-input">First Name</label>
                                        <input class="form-control" type="text" name="firstname" id="first-name-input"
                                               placeholder="First Name">
                                        <small>Error message</small>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="last-name-input">Last Name</label>
                                        <input class="form-control" type="text" name="lastname"
                                               id="last-name-input" placeholder="Last Name">
                                        <small>Error message</small>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="email-input">Email address</label>
                                        <input type="text" class="form-control" name="email" id="email-input"
                                               aria-describedby="emailHelp" placeholder="Enter email">
                                        <small>Error message</small>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tel-input">Phone number</label>
                                        <input class="form-control" type="text" name="phone" id="tel-input"
                                               placeholder="Phone">
                                        <small>Error message</small>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="password1-input">Password</label>
                                        <input type="password" class="form-control" name="password"
                                               id="password1-input" placeholder="Password">
                                        <small>Error message</small>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="password2-input">Repeat password</label>
                                        <input type="password" class="form-control" name="cpassword"
                                               id="password2-input" placeholder="Password">
                                        <small>Error message</small>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="add-input">Delivery Address</label>
                                        <textarea class="form-control" id="add-input" name="address"
                                                  rows="3"></textarea>
                                        <small>Error message</small>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <p><input type="submit" value="Register" name="submit" class="btn theme-btn">
                                        </p>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- end: Widget -->
                    </div>
                    <!-- /REGISTER -->
                </div>
                <!-- WHY? -->
                <div class="col-md-4">
                    <h4>Registration is fast, easy, and free.</h4>
                    <p>Once you"re registered, you can:</p>
                    <hr>
                    <img src="http://placehold.it/400x300" alt="" class="img-fluid">
                    <p></p>
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse"
                                                       class="panel-toggle collapsed" href="#faq1"
                                                       aria-expanded="false"><i class="ti-info-alt"
                                                                                aria-hidden="true"></i>Can I viverra sit
                                    amet quam eget lacinia?</a></h4>
                        </div>
                        <div class="panel-collapse collapse" id="faq1" aria-expanded="false" role="article"
                             style="height: 0px;">
                            <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                                rutrum ut erat a ultricies. Phasellus non auctor nisi, id aliquet lectus. Vestibulum
                                libero eros, aliquet at tempus ut, scelerisque sit amet nunc. Vivamus id porta neque, in
                                pulvinar ipsum. Vestibulum sit amet quam sem. Pellentesque accumsan consequat venenatis.
                                Pellentesque sit amet justo dictum, interdum odio non, dictum nisi. Fusce sit amet
                                turpis eget nibh elementum sagittis. Nunc consequat lacinia purus, in consequat neque
                                consequat id.
                            </div>
                        </div>
                    </div>
                    <!-- end:panel -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse"
                                                       class="panel-toggle" href="#faq2" aria-expanded="true"><i
                                            class="ti-info-alt" aria-hidden="true"></i>Can I viverra sit amet quam eget
                                    lacinia?</a></h4>
                        </div>
                        <div class="panel-collapse collapse" id="faq2" aria-expanded="true" role="article">
                            <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                                rutrum ut erat a ultricies. Phasellus non auctor nisi, id aliquet lectus. Vestibulum
                                libero eros, aliquet at tempus ut, scelerisque sit amet nunc. Vivamus id porta neque, in
                                pulvinar ipsum. Vestibulum sit amet quam sem. Pellentesque accumsan consequat venenatis.
                                Pellentesque sit amet justo dictum, interdum odio non, dictum nisi. Fusce sit amet
                                turpis eget nibh elementum sagittis. Nunc consequat lacinia purus, in consequat neque
                                consequat id.
                            </div>
                        </div>
                    </div>
                    <!-- end:Panel -->
                    <h4 class="m-t-20">Contact Customer Support</h4>
                    <p> If you"re looking for more help or have a question to ask, please </p>
                    <p><a href="contact.html" class="btn theme-btn m-t-15">contact us</a></p>
                </div>
                <!-- /WHY? -->
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

<!-- Bootstrap core JavaScript
================================================== -->
<script src="js/lib/jquery.min.js"></script>
<script src="js/lib/tether.min.js"></script>
<script src="js/lib/bootstrap.min.js"></script>
<script src="js/lib/bootstrap-slider.min.js"></script>
<script src="js/lib/jquery.isotope.min.js"></script>
<script src="js/lib/headroom.js"></script>
<script src="js/thegreen.min.js"></script>
<script src="js/registration.js"></script>
</body>

</html>