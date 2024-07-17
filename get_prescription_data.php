<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pmc");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch medication names and count prescriptions
$query = "
    SELECT m.name AS medication_name, COUNT(p.prescription_id) AS prescribed_count
    FROM prescription p
    JOIN medication m ON p.medication_id = m.medication_id
    GROUP BY m.medication_id
"; // Adjust table names if necessary

$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>
