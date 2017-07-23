<?php
include('scripts/dbconnect.php');
//Source: http://phppot.com/php/simple-php-shopping-cart/

$action = $params['action'];
$comp_ref = $params['comp_id'];
if(isset($action) && isset($comp_ref)) {
    switch ($action) {
        case "add":
            $query = mysqli_query('SELECT * FROM components WHERE comp_ref = "' . $comp_ref . '"');
            while($row = mysqli_fetch_row($query)){
                echo $row;
                echo '<br/>'.$_POST['quantity'];
            }

            break;
    }

} else {
    echo "Action or comp_id aren't set";
}

?>




