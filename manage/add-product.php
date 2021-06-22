<?php

require_once('manage/database.php');

if (
    isset($_POST['product_name']) &&
    !empty($_POST['product_name'])
) {
    $product_name = (string)$_POST['product_name'];
} else {
    $product_name = null;
}

if (
    isset($_POST['product_price']) &&
    !empty($_POST['product_price'])
) {
    $product_price = (string)$_POST['product_price'];
} else {
    $product_price = null;
}

if (
    isset($_POST['product_image']) &&
    !empty($_POST['product_image'])
) {
    $product_image = (string)$_POST['product_image'];
} else {
    $product_image = null;
}


error_log( 'Product name:      ' . $product_name);
error_log( 'Product price: ' . $product_price);
error_log( 'Product image:  ' . $product_image);
error_log( print_r($_POST, true) );


if (
    (!is_null($product_name))         && 
    (!is_null($product_price))    && 
    (!is_null($product_image))     

    ) 
{
    $sql = "INSERT INTO `producttb` (`id`, `product_name`, `product_price`, `product_image`) VALUES (NULL, '$product_name', '$product_price', '$product_image');";

    error_log("sql: " . $sql);

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