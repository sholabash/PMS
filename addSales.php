<?php
session_start();
?>

<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pmc"; // replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $medication = $_POST['medication'];
    $pharmacy = $_POST['pharmacy'];
    $customer = $_POST['customer'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $total_price = $quantity * $price;

    // Insert data into sales table
    $sql = "INSERT INTO sales (medication_id, pharmacy_id, customer_id, quantity_sold, price_per_unit, total_price, timestamp)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("iiiidss", $medication, $pharmacy, $customer, $quantity, $price, $total_price, $date);
    if ($stmt->execute()) {
        echo "New sale added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sale</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .heading {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-light navbar_colour">
    <a class="navbar-brand navbar_padding" href="#"> <img src="images/Sud Logo.png" alt="Logo" width="200"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-
        icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item navbar_padding">
                <a class="nav-link" style="color: black;" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item navbar_padding">
                    <a class="nav-link" style="color: black;" href="pharmacy.php">Pharmacies</a>
                </li>
       
        </ul>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item navbar_padding">
                    <a class="nav-link" style="color: black;" href="#">Logout</a>
                </li>  
            </ul>
        </div>  
    </div>  
</nav>
    <div class="container">
        <h2 class="heading">Add Sale</h2>
        <form action="addSales.php" method="POST">
            <div class="form-group">
                <label for="medication">Medication</label>
                <select class="form-control" id="medication" name="medication" required>
                    <option value="">Select Medication</option>
                    <option value="1">Paracetamol</option>
                    <option value="2">Amoxicillin</option>
                    <!-- Add more medication options -->
                </select>
            </div>
            <div class="form-group">
                <label for="pharmacy">Pharmacy</label>
                <select class="form-control" id="pharmacy" name="pharmacy" required>
                    <option value="">Select Pharmacy</option>
                    <option value="1">Pharmacy A</option>
                    <option value="2">Pharmacy B</option>
                    <!-- Add more pharmacy options -->
                </select>
            </div>
            <div class="form-group">
                <label for="customer">Customer</label>
                <select class="form-control" id="customer" name="customer" required>
                    <option value="">Select Customer</option>
                    <option value="1">John Doe</option>
                    <option value="2">Jane Smith</option>
                    <!-- Add more customer options -->
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity Sold</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
            </div>
            <div class="form-group">
                <label for="price">Price Per Unit</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Sale</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
