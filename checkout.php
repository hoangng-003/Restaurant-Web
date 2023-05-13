<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product_action.php';
error_reporting(0);
session_start();
$temp=0;
function create_zalopay_order($total_price)
{
    $config = [
        "app_id" => 2554,
        "key1" => "sdngKKJmqEMzvh5QQcdD2A9XBSKUNaYn",
        "key2" => "trMrHtvjo6myautxDUiAcYsVtaeQ8nhf",
        "endpoint" => "https://sb-openapi.zalopay.vn/v2/create"
    ];

    $embeddata = json_encode([
        "redirecturl" => "http://localhost/online-restaurant-websites/checkout.php"
    ]);
//$items = [
//    [ "itemid" => "knb", "itemname" => "kim nguyen bao", "itemprice" => 198400, "itemquantity" => 1 ]
//];
    $items = '[]'; // Merchant's data
    $transID = rand(0, 1000000); //Random trans id
    $order = [
        "app_id" => $config["app_id"],
        "app_time" => round(microtime(true) * 1000), // miliseconds
        "app_trans_id" => date("ymd") . "_" . $transID, // translation missing: vi.docs.shared.sample_code.comments.app_trans_id
        "app_user" => "user123",
        "item" => $items,
        "embed_data" => $embeddata,
        "amount" => $total_price * 23000,
        "description" => "The Green - Payment for the order #1",
        "bank_code" => ""
    ];
    $data = $order["app_id"] . "|" . $order["app_trans_id"] . "|" . $order["app_user"] . "|" . $order["amount"]
        . "|" . $order["app_time"] . "|" . $order["embed_data"] . "|" . $order["item"];
    $order["mac"] = hash_hmac("sha256", $data, $config["key1"]);

    $context = stream_context_create([
        "http" => [
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($order)
        ]
    ]);

    $resp = file_get_contents($config["endpoint"], false, $context);
    $result = json_decode($resp, true);
    if ($result["return_code"]) {
        var_dump($result);
        return $result;
//    header("Location: ${$result["orderurl"]}");
    }
}

if (empty($_SESSION["user_id"]))
{
    header('location:login.php');
}
else {
foreach ($_SESSION["cart_item"] as $item) {
    $item_total += ($item["price"] * $item["quantity"]);
}
if ($_POST['submit']) {
    $item_total = 0;
    foreach ($_SESSION["cart_item"] as $item) {
        $temp++;
        $item_total += ($item["price"] * $item["quantity"]);
        //By COD
        if ($_POST["mod"] != "zalopay") {
            $SQL = "insert into users_orders(u_id, d_id, title, quantity, price) 
                values('" . $_SESSION["user_id"] . "','" . $item["d_id"] . "','" . $item["title"] . "','" . $item["quantity"] . "','" . $item["price"] . "')";
            mysqli_query($db, $SQL);
            $success = "Thank you! Your Order Placed successfully!";
            unset($_SESSION["cart_item"]);
        }
    }
    //By Zalopay
    if ($_POST["mod"] == "zalopay") {
        $res = create_zalopay_order($item_total);
        $success = "ZaloPay";
        header("Location: ${res["order_url"]}");
    }

} else if ($_GET["appid"]) {
    $key2 = "trMrHtvjo6myautxDUiAcYsVtaeQ8nhf";
    $data = $_GET;
    $checksumData = $data["appid"] . "|" . $data["apptransid"] . "|" . $data["pmcid"] . "|" . $data["bankcode"] . "|" . $data["amount"] . "|" . $data["discountamount"] . "|" . $data["status"];
    $checksum = hash_hmac("sha256", $checksumData, $key2);

    if (strcmp($checksum, $data["checksum"]) != 0) {
        http_response_code(400);
        echo "Bad Request";
    } else {
        foreach ($_SESSION["cart_item"] as $item) {
            mysqli_query($db,
                "insert into users_orders(u_id, d_id, title, quantity, price)
                    values('" . $_SESSION["user_id"] . "','" . $item["d_id"] . "','" . $item["title"] . "','" . $item["quantity"] . "','" . $item["price"] . "')");
            $query = mysqli_query($db,
                "SELECT users.*, users_orders.*
                    FROM users INNER JOIN users_orders
                    ON users.u_id=users_orders.u_id
                    WHERE users.u_id = $_SESSION[user_id]
                    ORDER BY users_orders.date DESC LIMIT 1;
                    ");
            $rows = mysqli_fetch_array($query);
            $form_id = $rows['o_id'];
            $status = "paid";
            $remark = "ZaloPay";
            mysqli_query($db, "insert into remark(frm_id,status,remark) values('$form_id','$status','$remark')");
            mysqli_query($db, "update users_orders set status='$status' where o_id='$form_id'");
        }
        $success = "Thank you! Your Order Placed successfully!";
        unset($_SESSION["cart_item"]);
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
    <title>Checkout</title>
    <!-- Bootstrap core CSS -->
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/animate.css" rel="stylesheet">
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
                                                    <td>Free shipping</td>
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
                                                </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="mod" type="radio" value="zalopay"
                                                           class="custom-control-input"> <span
                                                            class="custom-control-indicator"></span> <span
                                                            class="custom-control-description">ZaloPay E-wallet <img
                                                                src="images/logo-zalopay.svg" alt="" width="90"></span>
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
<script src="js/lib/jquery.min.js"></script>
<script src="js/lib/tether.min.js"></script>
<script src="js/lib/bootstrap.min.js"></script>
<script src="js/lib/bootstrap-slider.min.js"></script>
<script src="js/lib/jquery.isotope.min.js"></script>
<script src="js/lib/headroom.js"></script>
<script src="js/thegreen.js"></script>
</body>

</html>

<?php
}
?>
