<?php

require_once('manage/database.php');


/*
if (isset($_POST['employee_id']) 
{
    $employee_id = (int)$_POST['employee_id'];
} 
else 
{
    $employee_id = -1;
}
*/

// ternary operator


$product_id      = (isset($_GET['product_id'])          ?  (int)$_POST['product_id'] : null);
$product_name    = (isset($_GET['product_name'])          ?  (string)$_POST['product_name'] : null);
$product_price   = (isset($_GET['product_price'])               ?  (float)$_POST['product_price'] : null);
$product_image     = (isset($_GET['product_image'])         ?  (string)$_POST['product_image'] : null);


error_log( '<p>ID: ' . $product_id . '<p>' );
error_log( '<p>Product name: ' . $product_name . '<p>' );
error_log( '<p>Prodduct price: ' . $product_price . '<p>' );
error_log( '<p>Product image: ' . $product_image . '<p>' );



if (
    (!is_null($product_id))       && 
    (!is_null($product_name))    && 
    (!is_null($product_price))    && 
    (!is_null($product_image))
    ) 
{
    $sql = "update producttb set product_price='$product_price' where id=$product_id";
    $result = $conn->query($sql);
    echo json_encode(array('status' => $result));
} 
else 
{
    echo json_encode(array('status' => 'php error'));
}

// close the db connection
$conn->close();

?>