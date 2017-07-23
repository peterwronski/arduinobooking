<?php
include('scripts/dbconnect.php');
//Source: http://phppot.com/php/simple-php-shopping-cart/

$action = $params['action'];
$comp_ref = $params['comp_id'];
if(isset($action) && isset($comp_ref)) {
    switch ($action) {
        case "add":
            $sql = 'SELECT * FROM components WHERE comp_ref = "' . $comp_ref . '"';
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()){
                var_dump($row);
                echo '<br/>'.$_POST['quantity'];
            }

            break;
    }

} else {
    echo "Action or comp_id aren't set";
}

?>




