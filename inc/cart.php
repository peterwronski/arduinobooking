<?php
include('scripts/dbconnect.php');
//Source: http://phppot.com/php/simple-php-shopping-cart/

$action = $params['action'];
$comp_ref = $params['comp_id'];
if(isset($action) && isset($comp_ref)) {
    switch ($action) {
        case "add":
            $query = $conn->query('SELECT * FROM components WHERE comp_ref = "' . $_GET['comp_id'] . '"');
            echo $query;
            break;
    }

} else {
    echo "Action or comp_id aren't set";
}

?>




