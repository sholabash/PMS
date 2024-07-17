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

    // Fetch the medication details
    $sql = "SELECT * FROM medication WHERE medication_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $medication_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $medication = $result->fetch_assoc();
    $stmt->close();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $expiry_date = $_POST['expiry_date'];
        $pharmacy_id = $_POST['pharmacy_id'];

        // Update the medication details
        $sql = "UPDATE medication SET name = ?, description = ?, quantity = ?, price = ?, expiry_date = ?, pharmacy_id = ? WHERE medication_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssidsii", $name, $description, $quantity, $price, $expiry_date, $pharmacy_id, $medication_id);

        if ($stmt->execute()) {
            echo "Medication updated successfully";
            // Redirect to medication management page
            header("Location: medication_management.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
} else {
    echo "No medication ID provided.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Medication</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Edit Medication</h2>
        <form action="edit_medication.php?id=<?php echo $medication_id; ?>" method="POST">
            <div class="form-group">
                <label for="name">Medication Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $medication['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo $medication['description']; ?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $medication['quantity']; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $medication['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="<?php echo $medication['expiry_date']; ?>" required>
            </div>
            <div class="form-group">
                <label for="pharmacy_id">Pharmacy ID</label>
                <input type="number" class="form-control" id="pharmacy_id" name="pharmacy_id" value="<?php echo $medication['pharmacy_id']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Update Medication</button>
        </form>
    </div>
</body>
</html>
