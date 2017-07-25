<?php

if(isset($_SESSION['cart'])){
    foreach ($_SESSION["cart"] as $key => $value) {
        $get_inStock = $conn->query('SELECT in_stock FROM components WHERE comp_ref ="' .$key .'"');
        $row = $get_inStock->fetch_array();
        $conn->query('UPDATE components SET in_stock ="' .($row['in_stock'] + $value['quantity']) .'" WHERE comp_ref ="' .$key .'"');
    }
    unset($_SESSION["cart"]);
}
session_start();
session_destroy();
header('Location:./');
exit();

?>