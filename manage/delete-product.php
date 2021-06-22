<?php

require_once('manage/database.php');

if (
    isset($_POST['product_id']) &&
    !empty($_POST['product_id'])
) {
    $product_id = (string)$_POST['product_id'];
} else {
    $product_id = null;
}

error_log( 'ID:         ' . $product_id);
error_log( print_r($_POST, true) );


if (!is_null($product_id))
{
    $sql = "DELETE FROM producttb WHERE id='$product_id'";

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