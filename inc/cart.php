<?php
include('scripts/dbconnect.php');
//Source: http://phppot.com/php/simple-php-shopping-cart/

$action = $params['action'];
$comp_ref = $params['comp_id'];
$quantity = $_POST['quantity'];
$cart_array = array();
if(isset($action) && isset($comp_ref)) {
    switch ($action) {
        case "add":
            $sql = 'SELECT * FROM components WHERE comp_ref = "' . $comp_ref . '"';
            $result = $conn->query($sql);
            $result_count = $result->num_rows;
            if ($result_count > 0) {

            while ($row = $result->fetch_assoc()) {
                array_push($cart_array, $row, $quantity);
                $_SESSION['cart'] = $cart_array;
                $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Item added!</strong>Click \'Your Cart\' to check out, or add more items
                                </div>';
                //header("Location: ../../components");
                var_dump($row);
                echo '<br/>' . $_POST['quantity'];
            };

    } else {


                    include('scripts/header_2.php');
                    echo '<div class="alert alert-warning alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Oh no!</strong>Component not found.
                                </div>';

                    include('scripts/footer.php');

            }
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




