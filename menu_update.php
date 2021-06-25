<?php
    include "connect_manage.php"; 
    $string  = $_POST['string'];
    $product_name  = $_POST['product_name'];
    $product_price  = $_POST['product_price'];
    $product_description  = $_POST['product_description'];
    $product_image  = $_POST['product_image'];
    if ($product_name==''){
        echo "<p class='btn btn-info' align='center'>Please insert your product name</p>";
    }else{
        $sql = "UPDATE producttb SET product_name='$product_name', product_price='$product_price', product_description='$product_description', product_image='$product_image' WHERE id = '$string' ";
        if ($conn->query($sql) === TRUE) {
            echo "<p class='btn btn-info' align='center'>Record updated successfully</p>";
        }else{
            echo "Error updating record: " . $conn->error;
    } 
}
?>