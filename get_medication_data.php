<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pmc");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT name, quantity FROM medication"; // Adjust the table name
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>
