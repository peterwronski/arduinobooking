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
            <h1>Step 1</h1> <h2>Create an account</h2>


        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-0 homebox2">
            <h1>Step 2</h1> <h2>Find components</h2>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-0 homebox1">
            <h1>Step 3</h1> <h2>Pick dates</h2>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-0 homebox2">
            <h1>Step 4</h1> <h2>Sit back and wait for confirmation</h2>

        </div>
    </div>
</div>




<?php include('scripts/footer.php'); ?>
