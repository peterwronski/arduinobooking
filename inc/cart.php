<?php
session_start();
include('scripts/dbconnect.php');
//Source: http://phppot.com/php/simple-php-shopping-cart/
//comment
$action = $params['action'];
$comp_ref = $params['comp_ref'];
$quantity = $_POST['quantity'];

function displayArray()
{
    echo '<table> <th>Key</th><th>Value</th>';
    foreach ($_SESSION["cart"] as $key => $value) {
        echo '<tr>
                           <td>' . $key . '</td><td>' . $value . '</td>';
    }
    echo '</table>';
};

if(isset($action)) {
    switch ($action) {
            case "add":
	/*$result = $conn->query("SELECT * FROM components WHERE comp_ref = '" .$comp_ref ."'");
	$row=$result->fetch_array();

        $itemArray = array(
                           $row['comp_ref'] => array('comp_name'=>$row["comp_name"], 'quantity'=>$_POST["quantity"]));
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
                            //print_r($_SESSION["cart"]);
                            displayArray();
                        }
                        $_SESSION["cart"][$k]["quantity"] += $_POST["quantity"];
                        //echo 'IS THIS THING WORKING 6';
                        //print_r($_SESSION["cart"]);
                        displayArray();
                    }
                }
            } else {
                $_SESSION["cart"] = array_merge($_SESSION["cart"],$itemArray);
                //print_r($_SESSION["cart"]);
                displayArray();
            }
        } else {
            $_SESSION["cart"] = $itemArray;
            //print_r($_SESSION["cart"]);
            displayArray();

        }
*/
	unset($_SESSION['cart']);
            break;
            case "view":
                echo 'IS THIS THING WORKING view';
            break;
    }

} else {
    echo "Action or comp_id aren't set";
}

?>




