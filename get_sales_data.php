<?php
// Similar to get_medication_data.php
$conn = new mysqli("localhost", "root", "", "pmc");

$query = "SELECT m.name AS medication_name, SUM(s.quantity_sold) AS total_quantity
        FROM sales s
        JOIN medication m ON s.medication_id = m.medication_id
        GROUP BY m.medication_id"; // Adjust table name
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>
