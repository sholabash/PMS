<?php
session_start();
?>

<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pmc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the sale ID from the URL
$sale_id = $_GET['id'];

// Delete the sale from the database
$sql = "DELETE FROM sales WHERE sale_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $sale_id);

if ($stmt->execute()) {
    echo "Sale deleted successfully.";
    header("Location: sales_management.php");
} else {
    echo "Error deleting sale: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
