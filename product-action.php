<?php
if (!empty($_GET["action"])) {
    $productId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
    $quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '';

    switch ($_GET["action"]) {
        case "add":
            if (!empty($quantity)) {
                $stmt = $db->prepare("SELECT * FROM dishes where d_id= ?");
                $stmt->bind_param('i', $productId);
                $stmt->execute();
                $productDetails = $stmt->get_result()->fetch_object();
                $itemArray = array($productDetails->d_id => array('title' => $productDetails->title, 'd_id' => $productDetails->d_id, 'quantity' => $quantity, 'price' => $productDetails->price));

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productDetails->d_id, array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($productDetails->d_id == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $quantity;
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;

        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($productId == $v['d_id'])
                        unset($_SESSION["cart_item"][$k]);
                }
            }
            break;

        case "empty":
            unset($_SESSION["cart_item"]);
            break;

        case "check":
            header("location:checkout.php");
            break;
    }
}
function rating_star($rating_value){
    $rating_star_element = '';
    $count_star = 0;
    for ($i = 0; $i < floor($rating_value); $i++) {
        $rating_star_element = $rating_star_element . '<i class="fa fa-star"></i>';
        $count_star++;
    }
    if ($rating_value - floor($rating_value) == 0.5) {
        $rating_star_element = $rating_star_element . '<i class="fa fa-star-half-o"></i>';
        $count_star++;
    }
    if ($count_star < 5) {
        for ($i = 0; $i < 5 - $count_star; $i++) {
            $rating_star_element = $rating_star_element . '<i class="fa fa-star-o"></i>';
        }
    }
    return $rating_star_element;
}