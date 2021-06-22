<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then alert and redirect back to #
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.html");
    exit;
}
?>

<!-- INSERT CODE BELOW -->

<?php
    require_once('php/connect_menu.php');

    $productname    = (isset($_GET['productname'])          && !empty($_GET['productname']))    ? $_GET['productname']  : null;
    $productprice   = (isset($_GET['productprice'])               && !empty($_GET['productprice']))         ? $_GET['productprice']       : null;
    $productimg     = (isset($_GET['productimg'])         && !empty($_GET['productimg']))   ? $_GET['productimg'] : null;
    $productid      = (isset($_GET['productid'])         && !empty($_GET['productid']))   ? $_GET['productid'] : null;

    if (!is_null($employee_id) && !is_null($salary) && !is_null($employee_job))
    {
        $sql = "UPDATE producttb SET productname='$productname', productprice='$productprice', productimg='$productimg' WHERE id='$employee_id'";
        $result = $conn->query($sql);
    }

?>
<!DOCTYPE html>
<html>
    
    <?php 
        $page_title = 'Add Product';
        
    ?>

    <body>

        <div class="container">

            <div class="row" style="margin-top: 50px">

                <div class="col-md-12">

                    <?php
                        echo "<p>Product name is: $productname</p>";
                        echo "<p>Product price is: $productprice</p>";
                        echo "<p>Product image is: $productimg</p>";
                        echo "<p>Product id is: $productid</p>";

                        if ($result == true) {
                            echo "Save complete!";
                        } else {
                            echo "Save failed!";
                        }

                    ?>

                </div>

                <div class="col-md-12" style="margin-top: 100px">

                    <h5>Cookie</h5>

                    <?php
                        if (!isset( $_COOKIE['user'] )) {
                            echo "Cookie is not set!";
                        } else {
                            echo "Cookie IS set!<br>";
                            echo "Value is: " . $_COOKIE['user'];
                        }
                    ?>
                    
                </div>
            </div>

        </div>

    </body>
</html>