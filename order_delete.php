<?php
    include "connect_manage.php"; 
    $id=$_POST['string'];
    $sql = "DELETE from ordertb where id ='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='btn btn-info' align='center'>Record deleted successfully</p>";
    } else {
        echo "Error deleting record: " . $conn->error;
    } 
 
?>