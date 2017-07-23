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
            if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                var_dump($row);
                echo '<br/>' . $_POST['quantity'];
            }

    } else {
                $_SESSION['msg'] = '<div class="alert alert-warning alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Oh no!</strong>Component not found.
                                </div>';
                if(isset($_SESSION['msg'])){
                    include('scripts/header_2.php');
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                    include('scripts/footer.php');
                };
            }
            break;
    }

} else {
    echo "Action or comp_id aren't set";
}

?>




