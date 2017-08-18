<?php
include('scripts/header.php');

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
};
?>

<div class="container">
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
