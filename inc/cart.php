<?php
session_start();
include('scripts/dbconnect.php');
//Source: http://phppot.com/php/simple-php-shopping-cart/
//comment
$action = $params['action'];
$comp_ref = $params['comp_ref'];
$quantity = $_POST['quantity'];

if(isset($action) && isset($comp_ref)) {
    switch ($action) {
            case "add":
	if(!empty($_POST["quantity"])) {

        $itemArray = array($row[0]["comp_ref"]=>array('comp_name'=>$row[0]["comp_name"], 'comp_ref'=>$row[0]["comp_ref"], 'quantity'=>$_POST["quantity"]));

        if(!empty($_SESSION["cart"])) {
            if(in_array($row[0]["comp_ref"],array_keys($_SESSION["cart"]))) {
                foreach($_SESSION["cart"] as $k => $v) {
                    if($row[0]["comp_ref"] == $k) {
                        if(empty($_SESSION["cart"][$k]["quantity"])) {
                            $_SESSION["cart"][$k]["quantity"] = 0;
                        }
                        $_SESSION["cart"][$k]["quantity"] += $_POST["quantity"];
                    }
                }
            } else {
                $_SESSION["cart"] = array_merge($_SESSION["cart"],$itemArray);
            }
        } else {
            $_SESSION["cart"] = $itemArray;
        }
    }
    echo $_SESSION["cart"];







                   /* include('scripts/header_2.php');
                    echo '<div class="alert alert-warning alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Oh no!</strong>Component not found.
                                </div>';

                    include('scripts/footer.php'); */


            break;

        case "view":
            echo ' IS THIS THING WORKING';
            foreach($_SESSION['cart'] as $key=>$value){
                echo 'Key: ' .$key .' // Value: ' .$value;
            }
            break;
    }

} else {
    echo "Action or comp_id aren't set";
}

?>




