<?php
include('scripts/dbconnect.php');
//Source: http://phppot.com/php/simple-php-shopping-cart/
if(isset($_GET['action']) && isset($_GET['comp_id']))
switch ($_GET['action']){
    case "add":
        $query = $conn->query('SELECT * FROM components WHERE comp_ref = "' .$_GET['comp_id'] .'"');
        echo $query;
        break;
        }





