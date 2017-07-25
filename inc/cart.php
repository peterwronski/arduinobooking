<?php
session_start();
include('scripts/dbconnect.php');
//Source: http://phppot.com/php/simple-php-shopping-cart/
//comment
$action = $params['action'];
$comp_ref = $params['comp_ref'];
$quantity = $_POST['quantity'];
$get_inStock = $conn->query('SELECT in_stock FROM components WHERE comp_ref="' .$comp_ref .'"');
$update_add = $get_inStock - $quantity;



function updateStock_add(){
    $conn->query('UPDATE components SET in_stock = '.$update_add .' WHERE comp_ref="' .$comp_ref .'"');
};

function itemAdded(){
    $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Yeee boi!</strong> Item added to cart!
                                </div>';
    updateStock_add();

    header('Location: ../../components');
};



if(isset($action)) {
    switch ($action) {
            case "add":
	$result = $conn->query("SELECT * FROM components WHERE comp_ref = '" .$comp_ref ."'");
	$row=$result->fetch_array();

        $itemArray = array(
                           $row['comp_ref'] => array('comp_name'=>$row["comp_name"], 'quantity'=>$_POST["quantity"]));
        //echo 'IS THIS THING WORKING 1';
        if(!empty($_SESSION["cart"])) {
            //echo 'IS THIS THING WORKING 2';
            if(in_array($row["comp_ref"],array_keys($_SESSION["cart"]))) {
                //echo 'IS THIS THING WORKING 3';
                foreach($_SESSION["cart"] as $k => $v) {
                    if($row["comp_ref"] == $k) {
                        //echo 'IS THIS THING WORKING 4';
                        if(empty($_SESSION["cart"][$k]["quantity"])) {
                            $_SESSION["cart"][$k]["quantity"] = 0;
                            setcookie("cart_cookie", $_SESSION["cart"], time() + (86400 * 30), "/");
                            itemAdded();
                            //print_r($_SESSION["cart"]);
                            //displayCart();
                        }
                        $_SESSION["cart"][$k]["quantity"] += $_POST["quantity"];
                        //echo 'IS THIS THING WORKING 6';
                        //print_r($_SESSION["cart"]);
                        //displayCart();
                        setcookie("cart_cookie", $_SESSION["cart"], time() + (86400 * 30), "/");
                        itemAdded();
                    }
                }
            } else {
                $_SESSION["cart"] = array_merge($_SESSION["cart"],$itemArray);
                //print_r($_SESSION["cart"]);
                //displayCart();
                setcookie("cart_cookie", $_SESSION["cart"], time() + (86400 * 30), "/");
                itemAdded();

            }
        } else {
            $_SESSION["cart"] = $itemArray;
            //print_r($_SESSION["cart"]);
            //displayCart();
            setcookie("cart_cookie", $_SESSION["cart"], time() + (86400 * 30), "/");
            itemAdded();

        }

            break;
        case "remove":
            if($comp_ref === "all"){
                foreach ($_SESSION["cart"] as $key => $value) {
                    $update_remove = $get_inStock + $value['quantity'];
                    $conn->query('UPDATE components SET in_stock =' .$update_remove .' WHERE comp_ref ="' .$key .'"');
                }
                unset($_SESSION["cart"]);
                setcookie("cart_cookie", $_SESSION["cart"], time() + (86400 * 30), "/");
                $_SESSION['msg'] = '<div class="alert alert-info alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Yeee boi!</strong> Cart cleared!
                                </div>';


                header("Location:../../components");
            } else {
                if (!empty($_SESSION["cart"])) {
                    foreach ($_SESSION["cart"] as $key => $value) {
                        $update_remove = $get_inStock + $value['quantity'];
                        $conn->query('UPDATE components SET in_stock =' .$update_remove .' WHERE comp_ref ="' .$key .'"');
                        if ($comp_ref == $key) unset($_SESSION["cart"][$key]);
                        if (empty($_SESSION["cart"])) unset($_SESSION["cart"]);
                        setcookie("cart_cookie", $_SESSION["cart"], time() + (86400 * 30), "/");
                    }
                }
                $_SESSION['msg'] = '<div class="alert alert-info alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Yeee boi!</strong> Item removed from cart!
                                </div>';

                header("Location:../../viewcart");
            }
            break;


    }

} else {
    echo "Action or comp_id aren't set";
}

?>




