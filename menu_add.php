<?php
    // ob_start();
    include "connect_manage.php"; 
    $product_name  = $_POST['product_name'];
    $product_price  = $_POST['product_price'];
    $product_description  = $_POST['product_description'];
    $product_image  = $_POST['product_image'];
    if ($product_name==''){
        echo "<p class='btn btn-info' align='center'>Please insert your product name</p>";
    }else{ 
        $sql = "INSERT INTO producttb (product_name, product_price, product_description, product_image)
        VALUES ('".$product_name."','".$product_price."','".$product_description."','".$product_image."')";
        if ($conn->query($sql) === TRUE) {
            echo "<p class='btn btn-info' align='center'>New record created successfully</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error."";
        }
        // header('Location: '.$_SERVER['REQUEST_URI']);
        $conn->close();
    }
    // ob_end_flush(); 
?>