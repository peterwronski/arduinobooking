<?php
//Source: http://phppot.com/php/simple-php-shopping-cart/
switch ($_GET['action']){
    case "add":
    if (!empty($_POST["quantity"])) {
        $compByCode = $conn->query("SELECT * FROM components WHERE comp_ref='" . $_GET["comp_id"] . "'");
        $itemArray = array($compByCode[0]["comp_id"] =>
                        array('comp_name' => $compByCode[0]["comp_name"],
                            'comp_id' => $compByCode[0]["comp_ref"],
                            'quantity' => $_POST["quantity"]));
        print_r("Item added to array");

        if (!empty($_SESSION["cart_item"])) {
            if (in_array($compByCode[0]["comp_id"], array_keys($_SESSION["cart_item"]))) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($compByCode[0]["comp_id"] == $k) {
                        if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                            $_SESSION["cart_item"][$k]["quantity"] = 0;
                        }
                        $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                    }
                    print_r("Item added to session");
                }
            } else {
                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                print_r("Item merged to session");
            }
        } else {
            $_SESSION["cart_item"] = $itemArray;
            print_r("Item added to session");
        }
    }

    break;

}
