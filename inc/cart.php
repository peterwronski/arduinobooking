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
	$result = $conn->query("SELECT * FROM components WHERE comp_ref = '" .$comp_ref ."'");
	$row=$result->fetch_array();

        $itemArray = array($row[0]["comp_ref"]=>array('comp_name'=>$row[0]["comp_name"], 'comp_ref'=>$row[0]["comp_ref"], 'quantity'=>$_POST["quantity"]));
        //echo 'IS THIS THING WORKING 1';
        if(!empty($_SESSION["cart"])) {
            //echo 'IS THIS THING WORKING 2';
            if(in_array($row[0]["comp_ref"],array_keys($_SESSION["cart"]))) {
                //echo 'IS THIS THING WORKING 3';
                foreach($_SESSION["cart"] as $k => $v) {
                    if($row[0]["comp_ref"] == $k) {
                        //echo 'IS THIS THING WORKING 4';
                        if(empty($_SESSION["cart"][$k]["quantity"])) {
                            $_SESSION["cart"][$k]["quantity"] = 0;
                            //echo 'IS THIS THING WORKING 5';
                        }
                        $_SESSION["cart"][$k]["quantity"] += $_POST["quantity"];
                        //echo 'IS THIS THING WORKING 6';
                    }
                }
            } else {
                $_SESSION["cart"] = array_merge($_SESSION["cart"],$itemArray);
                //echo 'IS THIS THING WORKING 7';
            }
        } else {
            $_SESSION["cart"] = $itemArray;
            //echo 'IS THIS THING WORKING 8';
        }


                   /* include('scripts/header_2.php');
                    echo '<div class="alert alert-warning alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Oh no!</strong>Component not found.
                                </div>';

                    include('scripts/footer.php'); */
            break;

        case "view":
            echo ' IS THIS THING WORKING view';

    }

} else {
    echo "Action or comp_id aren't set";
}

?>




