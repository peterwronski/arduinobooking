<?php
session_start();
include('scripts/dbconnect.php');

$action = $params['action'];

$dateTo = $_POST['date_to'];
$dateFrom = $_POST['date_from'];






if(isset($_SESSION['userloggedin']) && !empty($_SESSION['userloggedin'])) {

    if (isset($action)) {
        switch ($action) {
            case "add":
                if(strtotime($dateTo) > strtotime($dateFrom)) {
                    foreach ($_SESSION["cart"] as $key => $value) {
                        $query = 'INSERT INTO booking (studentid, comp_ref, quantity, date_from, date_to, approved) VALUES ("' . $_SESSION['studentid'] . '", "' . $key . '" , "' . $value['quantity'] . '", "' . $dateFrom . '", "' . $dateTo . '", "0")';
                        $result = $conn->query($query);

                        $get_inStock = $conn->query('SELECT in_stock FROM components WHERE comp_ref ="' . $key . '"');
                        $row = $get_inStock->fetch_array();

                        $quantity = $row['in_stock'] - $value['quantity'];

                        $in_stockUpdate = $conn->query('UPDATE components SET in_stock = "' . $quantity . '" WHERE comp_ref="' . $key . '"');


                        unset ($_SESSION['cart'][$key]);


                    };

                    $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Booking created!</strong> Check the status of your booking in the <a href="../../bookings">BOOKINGS</a> section
                                </div>';


                    header("Location:../../viewcart");

                } else {
                    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Check your dates!</strong> \'Returning on\' date can\'t be before \'Booking from \' date.
                                </div>';


                    header("Location:../../viewcart");
                }

                break;



            default:
                header("Location: 404.php");
                break;
        }

    }
}
else {
    header("Location: 404.php");
}