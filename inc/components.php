<?php
session_start();
include('scripts/header.php');
include('scripts/dbconnect.php');

$query = $conn->query("SELECT * FROM components");

$count = mysql_num_rows($query);
?>

<div class="container" id="componentlist">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 componentdiv">
            <h1>Components</h1> <br/>
            <button type="button" class="btn btn-basic btn-block" data-toggle="collapse" data-target="#options">Options</button>
            <div id="options" class="collapse">INSERT SORT OPTIONS HERE</div>
            <hr/>
        </div>
    </div>
</div>

<div class="container" id="componentlist">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 componentdiv">
            <ul>

<?php
if ($query->num_rows > 0) {
    // output data of each row
    while ($row = $query->fetch_assoc()) {
        $img_link = ' "inc/img/arduino_img/'.$row['comp_ref'] .'.jpg" ';
        echo ' <li> Component name: ' .$row['comp_name'] .'<br/>
                In stock: ' .$row['in_stock'] .'<br/>
                Component image: <img src='.$img_link .' class="img-responsive" height="250px" width="250px" alt ="'.$row['comp_name'] .'"/> 
              </li>
              <hr/>';
    };
}else {
    echo "No components to show at this time";
};
?>
</div>
<?php include('scripts/footer.php'); ?>
