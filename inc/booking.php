<?php
session_start();
include('scripts/dbconnect.php');

$action = $params['action'];

if(isset($action)) {
    switch ($action) {
        case "add":
        //TODO ADD FUNCTION
            break;
        case "confirm":
            //TODO CONFIRM ACTION
            break;


    }

}