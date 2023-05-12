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

// Get the POST data
$data = json_decode(file_get_contents("php://input"), true);

// Validate the data
if (empty($data['name']) || empty($data['age'])) {
    $response = array('success' => false, 'error' => 'Name and age are required');
    echo json_encode($response);
    exit;
}

$name = $data['name'];
$age = $data['age'];

// Prepare and execute the SQL statement
$stmt = $conn->prepare("INSERT INTO listnames (name, age) VALUES (?, ?)");
$stmt->bind_param("si", $name, $age);

if ($stmt->execute()) {
    $response = array('success' => true);
    echo json_encode($response);
} else {
    $response = array('success' => false, 'error' => 'Failed to insert data');
    echo json_encode($response);
}

$stmt->close();
$conn->close();
?>
