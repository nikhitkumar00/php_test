<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "main";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve data from the table
$sql = "SELECT name, age FROM listnames";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    // Fetch data and store in array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

// Set the appropriate headers
header("Content-Type: application/json");

// Output the data as JSON
echo json_encode($data);
?>