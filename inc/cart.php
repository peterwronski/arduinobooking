<?php
//Source: http://phppot.com/php/simple-php-shopping-cart/
if (isset($_GET["action"]) && isset($_GET["comp_id"]) && $_GET["action"] == "add") {
    if (!empty($_POST["quantity"])) {
        $compByCode = $conn->query("SELECT * FROM components WHERE comp_ref='" . $_GET["comp_id"] . "'");
        $itemArray = array($compByCode[0]["comp_id"] =>
                        array('comp_name' => $compByCode[0]["comp_name"],
                            'comp_id' => $productByCode[0]["code"],
                            'quantity' => $_POST["quantity"]));

        if (!empty($_SESSION["cart_item"])) {
            if (in_array($compByCode[0]["code"], array_keys($_SESSION["cart_item"]))) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($compByCode[0]["code"] == $k) {
                        if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                            $_SESSION["cart_item"][$k]["quantity"] = 0;
                        }
                        $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                    }
                }
            } else {
                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
            }
        } else {
            $_SESSION["cart_item"] = $itemArray;
        }
    }
} else {
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Action not recognised</strong> Try something else
                                </div>';
    session_write_close();
    header('Location: components');
}
