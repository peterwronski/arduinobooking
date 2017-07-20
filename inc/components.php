<?php
session_start();
include('scripts/header.php');
if(isset($_SESSION['userloggedin']) && !empty($_SESSION['userloggedin'])) {
    include('scripts/dbconnect.php');



    ?>

    <div class="container" id="componentlist">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 componentdiv">
                <h1>Components</h1> <br/>
                <button type="button" class="btn btn-basic btn-block" data-toggle="collapse" data-target="#options">
                    Options
                </button>
                <div id="options" class="collapse"><?


                        echo' <form action="components" method="post">
                                Sort by: <a class="btn btn-info btn-select">
                                                <input type="hidden" class="btn-select-input" name="sort_method1"/>
                                                    <span class="btn-select-value">Select a value</span>
                                                    <span class="btn - select - arrow glyphicon glyphicon - chevron - down"></span>
                                                <ul>
                                                    <li>Name</li>
                                                    <li>In stock</li>
                                                </ul>
                                         </a>
                                         
                                         <a class="btn btn-info btn-select">
                                                <input type="hidden" class="btn-select-input" name="sort_method2"/>
                                                    <span class="btn-select-value">Select a value</span>
                                                    <span class="btn - select - arrow glyphicon glyphicon - chevron - down"></span>
                                                <ul>
                                                    <li>Ascending</li>
                                                    <li>Descending</li>
                                                </ul>
                                         </a>
                                         
                                         <input type="submit" name="sort_submit">  </input>
                                         </form>
                                         
                                         
                        
                        ';

                    //SORTING FORM - CONFIRMED WORKING
                    /*<select name="sort_method1" class="btn-new">
                                        <option value="name">Name</option>
                                        <option value = "in_stock">In stock</option>
                                     </select>

                                     <select name="sort_method2" class="btn-new">
                                        <option value="ascending">Ascending</option>
                                        <option value="descending"> Descending</option>
                                     </select>*/
                   if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                            $sort_method1 = $_POST['sort_method1'];
                            $sort_method2 = $_POST['sort_method2'];

                                switch ($sort_method1) {
                                    case "Name":
                                        $_SESSION['sort_method1'] = " comp_name";
                                        break;

                                    case "In stock":
                                        $_SESSION['sort_method1'] = " in_stock";
                                    break;
                                };

                                switch ($sort_method2) {
                                    case "Ascending":
                                        $_SESSION['sort_method2'] = " ASC";
                                        break;
                                    case "Descending":
                                        $_SESSION['sort_method2'] = " DESC";
                                        break;
                                };
                    }

                        ?>
                    </div>
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
                    if(isset($_SESSION['sort_method1']) && isset($_SESSION['sort_method2'])){
                        $query = "SELECT * FROM components ORDER BY" .$_SESSION['sort_method1'] .$_SESSION['sort_method2'];
                        unset($_SESSION['sort_method1']);
                        unset($_SESSION['sort_method2']);
                    } else{
                        $query = "SELECT * FROM components";
                    }
                    $result = $conn->query($query);
                    //echo $query;

                    if ($result->num_rows > 0) {
// output data of each row
                        while ($row = $result->fetch_array()) {
                            $comp_ref = $row['comp_ref'];
                            $img_link = ' "inc/img/arduino_img/' . $row['comp_ref'] . '.jpg" ';
                            echo ' 
 <tr class="clickable-row" data-href="viewcomponent/' . $comp_ref . '">
 <td><img src=' . $img_link . ' class="img-thumbnail" height="150px" width="150px" alt ="' . $row['comp_name'] . '"/> </td>
 <td>' . $row['comp_name'] . '</td>
 <td>' . $row['in_stock'] . '</td>
</tr>
';
                        };
                        echo '
                <script>
                    jQuery(document).ready(function($) {
                        $(".clickable-row").click(function() {
                            window.location = $(this).data("href");
                        });
                    });
                </script>
                ';

                    } else {
                        echo "No components to show at this time";
                    };
                    ?>
            </div>
        </div>
    </div>
    <?php
}else{
    $_SESSION['msg'] = '<div class="alert alert-warning alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong>Hold up!</strong>You have to be logged in to view this content
                                </div>';

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    };

}
    include('scripts/footer.php');
 ?>
