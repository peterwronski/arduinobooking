<?php
session_start();
include('scripts/dbconnect.php');

$action = $params['action'];
$dateTo = $_POST['date_to'];
$dateFrom = $_POST['date_from'];








if(isset($action)) {
    switch ($action) {
        case "add":
            //echo 'Date To: ' . $dateTo . ' <br/>Date From: ' . $dateFrom;
            foreach ($_SESSION["cart"] as $key => $value) {
                $query = 'INSERT INTO booking (studentid, comp_ref, quantity, date_from, date_to) VALUES ("' . $_SESSION['studentid'] . '", "' . $key . '" , "' . $value['quantity'] . '", "' .$dateFrom. '", "' . $dateTo . '")';
                $result=$conn->query($query);

                    $get_inStock = $conn->query('SELECT in_stock FROM components WHERE comp_ref ="' .$key .'"');
                    $row = $get_inStock->fetch_array();
                    print $row['in_stock'] .' ' .$value['quantity'];
                    $quantity = $row['in_stock'] - $value['quantity'];

                    $in_stockUpdate = $conn->query('UPDATE components SET in_stock = "' . $quantity . '" WHERE comp_ref="' . $key . '"');


                unset ($_SESSION['cart'][$key]);


            };

            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Yeee boi!</strong> Booking created!
                                </div>';


            header("Location:../../viewcart");


            break;

        default:
            header("Location: 404.php");
            break;
    }

} else {
    header("Location: 404.php");
}