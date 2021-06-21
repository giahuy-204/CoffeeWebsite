<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
/* Attempt to connect to MySQL database */
$link = new mysqli('fdb22.awardspace.net','3855137_hyu1','huypr113','3855137_hyu1');
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>