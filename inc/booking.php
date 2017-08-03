<?php
session_start();
include('scripts/dbconnect.php');

$action = $params['action'];
$dateTo = $_POST['date_to'];
$dateFrom = $_POST['date_from'];
$addSuccess = "<div class=\"alert alert-success alert-dismissable\">
                                    <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">×</a>
                                    <strong>Items added!</strong>";

function itemAdded(){

    global $conn, $quantity, $row;



};

if(isset($action)) {
    switch ($action) {
        case "add":
            foreach ($_SESSION["cart"] as $key => $value) {
                $query = 'INSERT INTO booking VALUES ("' . $_SESSION['studentid'] . '", "' . $key . '" , "' . $value['quantity'] . '", "' . $key . '", "' . $dateFrom . '", "' . $dateTo . '")';
                $result=$conn->query($query);
                if($result){

                    $get_inStock = $conn->query('SELECT in_stock FROM components WHERE comp_ref ="' .$_SESSION['cart'][$key] .'"');
                    $row = $get_inStock->fetch_array();


                    $conn->query('UPDATE components SET in_stock = "'.($row['in_stock'] - $quantity) .'" WHERE comp_ref="' .$comp_ref .'"');

                    unset($_SESSION['cart'][$key]);


                }
            };
            $_SESSION['msg'] = $addSuccess .'Your booking is now created. Check the progress under \'Your Bookings\' </div>';
            break;

        default:
            header("Location: 404.php");
            break;
    }

}