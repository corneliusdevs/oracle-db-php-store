<?php

// Database connection details
$dbUser = 'system';
$dbPass = 'cornelius2001';
$dbHost = 'localhost';
$dbPort = '1521';
$dbServiceName = 'xepdb1';
$isLoggedIn = false;


// Retrieve posted username and password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Establish a connection to the Oracle database
    $conn = oci_connect($dbUser, $dbPass, "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$dbHost)(PORT=$dbPort))(CONNECT_DATA=(SERVICE_NAME=$dbServiceName)))");

    if (!$conn) {
        $response = array('success' => false, 'message' => 'Something went horribly wrong');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    // Prepare the SQL statement
    $sql = "SELECT COUNT(*) AS user_count FROM ADMINS WHERE username = :username AND password = :password";
    $stmt = oci_parse($conn, $sql);

    // Bind the parameters
    oci_bind_by_name($stmt, ":username", $username);
    oci_bind_by_name($stmt, ":password", $password);

    // Execute the query
    oci_execute($stmt);

    // Fetch the result
    $row = oci_fetch_assoc($stmt);

    // Check if the user exists
    if ($row['USER_COUNT'] > 0) {
        $isLoggedIn = true;
        $response = array('success' => true, 'message' => 'Login successful');
    } else {
        $response = array('success' => false, 'message' => 'Invalid username or password');
    }

    // Close the database connection
    oci_free_statement($stmt);
    oci_close($conn);

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Invalid request method
    http_response_code(405);
}
