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
    echo ($conn);
}

// construct the page url 
// $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == "443") ? "https://" : "http://";
// $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


// parse_str($url_components['query'], $params);

// // extract the ISBN number from query params
// $productId = strval($params["productId"]);

// // Get the productId from the query parameters
// if (!isset($url_components['query'])) {
//     http_response_code(400);
//     echo json_encode(['error' => "no product id here $params"]);
//     echo json_encode($params);
//     exit;
// }



$productId = isset($_GET['productId']) ? $_GET['productId'] : null;
// $productId = 1;
// Validate the productId
if ($productId === null) {
    http_response_code(400);
    echo json_encode(['error' => "no product id here $productId"]);
    exit;
}else{

}
if ($productId === null || !is_numeric($productId)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid productId']);
    exit;
}

// Prepare the SQL statement with a bind variable for productId
$query = "SELECT * FROM FURNITURE WHERE FURNITURE_ID = :productId";
$statement = oci_parse($conn, $query);

// Bind the productId parameter to the variable in the SQL statement
oci_bind_by_name($statement, ":productId", $productId);

// Execute the query
oci_execute($statement);

// Fetch the results and store them in an array
$furniture = array();
while ($row = oci_fetch_assoc($statement)) {
    $furniture[] = $row;
}

// Close the database connection
oci_close($conn);

// Output the furniture data as JSON
header('Content-Type: application/json');
echo json_encode($furniture);
exit;
