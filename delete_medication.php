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

if (isset($_GET['id'])) {
    $medication_id = $_GET['id'];

    // Delete the medication
    $sql = "DELETE FROM medication WHERE medication_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $medication_id);

    if ($stmt->execute()) {
        echo "Medication deleted successfully";
        // Redirect to medication management page
        header("Location: medication_management.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No medication ID provided.";
    exit;
}

$conn->close();
?>
