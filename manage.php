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