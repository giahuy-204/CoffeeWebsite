<?php

require_once('manage/database.php');

$sql = "SELECT * FROM producttb";
$result = $conn->query($sql);

$myDataArray = array();

if ($result->num_rows > 0) {
    // output the data
    while ($row = $result->fetch_assoc()) {

        $row['delete'] = '<button class="btn btn-danger" value="' . $row['id'] . '">Delete</button>';

        error_log( print_r($row, true) );

        // fill our array
        $myDataArray[] = $row;
    }

    // output our array as json
    echo json_encode(array('data' => $myDataArray));    // bundle our data & provide a reference

} else {
    echo json_encode(array('data' => 'zero results'));
}

// close the db connection
$conn->close();

?>