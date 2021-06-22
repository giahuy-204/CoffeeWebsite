<?php

$conn = new mysqli('fdb22.awardspace.net','3855137_hyu1','huypr113','3855137_hyu1');

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>