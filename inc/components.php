<?php
session_start();
include('scripts/header.php');
if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
};

include('scripts/dbconnect.php');

$query = "SELECT * FROM components";
$result = $conn->query($query);
$count = mysqli_num_rows($result);

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
            <table class="componenttable" width="100%">
                <th colspan="2">Component</th>
                <th colspan="1">In stock</th>


<?php
if ($count > 0) {
// output data of each row
    while ($row = $result->fetch_array()) {
        $comp_ref = $row['comp_ref'];
        $img_link = ' "inc/img/arduino_img/'.$row['comp_ref'] .'.jpg" ';
        echo ' 
 <tr class=\'clickable-row\' data-href="viewcomponent/' .$comp_ref.'"\'>
 <td><img src='.$img_link .' class="img-thumbnail" height="250px" width="250px" alt ="'.$row['comp_name'] .'"/> </td>
 <td>' .$row['comp_name'] .'</td>
 <td>' .$row['in_stock'] .'</td>
</tr>
';
    };
    echo'
                <script>
                    jQuery(document).ready(function($) {
                        $(".clickable-row").click(function() {
                            window.location = $(this).data("href");
                        });
                    });
                </script>
                ';

}else {
    echo "No components to show at this time";
};
?>
</div>
<?php include('scripts/footer.php'); ?>
