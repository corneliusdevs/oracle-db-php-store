<?php

$dbUser = 'system';
$dbPass = 'cornelius2001';
$dbHost = 'localhost';
$dbPort = '1521';
$dbServiceName = 'xepdb1';

// Establish a connection to the Oracle
$conn = oci_connect($dbUser, $dbPass, "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$dbHost)(PORT=$dbPort))(CONNECT_DATA=(SERVICE_NAME=$dbServiceName)))");

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Query the database for furniture
$query = "SELECT * FROM PURCHASES";
$statement = oci_parse($conn, $query);
oci_execute($statement);

// Fetch the results and store them in an array
$purchases = array();
while ($row = oci_fetch_assoc($statement)) {
    $purchases[] = $row;
}

// Close the database connection
oci_close($conn);

// Output the purchases data as JSON
header('Content-Type: application/json');
echo json_encode($purchases);
