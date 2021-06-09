<?php

// MySQLi - MySQL improved (relational database driver)

    $servername = 'fdb22.awardspace.net';
    $username = '3855137_hyu1';
    $database = '3855137_hyu1';
    $password = 'huypr113';

// create a connection
$conn = new mysqli($servername, $username, $password, $database);

// check connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error );
} else {
    error_log('Connected!');
}

?>