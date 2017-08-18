<?php
include('scripts/header.php');

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
};
?>


<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h1>Welcome to ArduinoBooking!</h1>
        </div>
        <div class="col-sm-6">
            <h2>Here's a quick guide on how to use the website</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-0 homebox1">


        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-6 homebox2">


        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-0 homebox1">


        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-6 homebox2">


        </div>
    </div>
</div>




<?php include('scripts/footer.php'); ?>
