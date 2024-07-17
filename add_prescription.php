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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $medication_id = $_POST['medication_id'];
    $patient_name = $_POST['patient_name'];
    $patient_contact = $_POST['patient_contact'];
    $prescribing_doctor = $_POST['prescribing_doctor'];
    $quantity = $_POST['quantity'];
    $date_prescribed = $_POST['date_prescribed'];

    // Validate form data
    if (!empty($medication_id) && !empty($patient_name) && !empty($patient_contact) && !empty($prescribing_doctor) && !empty($quantity) && !empty($date_prescribed)) {
        // Insert data into the prescription table
        $sql = "INSERT INTO prescription (medication_id, patient_name, patient_contact, prescribing_doctor, quantity, date_prescribed) 
                VALUES ('$medication_id', '$patient_name', '$patient_contact', '$prescribing_doctor', '$quantity', '$date_prescribed')";

        if ($conn->query($sql) === TRUE) {
            echo "New prescription added successfully";
            // Redirect to prescription list or any other page
            header("Location: prescription.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "All fields are required.";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Prescription</title>
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
            max-width: 600px;
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
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light navbar_colour">
    <a class="navbar-brand navbar_padding" href="#"> <img src="images/Sud Logo.png" alt="Logo" width="200"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item navbar_padding">
                <a class="nav-link" style="color: black;" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item navbar_padding">
                <a class="nav-link" style="color: black;" href="pharmacy.php">Pharmacy</a>
            </li>
        </ul>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item navbar_padding">
                    <?php
                    if (isset($_SESSION["username"])) {
                        echo '<a class="nav-link" style="color: black;" href="#">Welcome, ' . $_SESSION["username"] . '</a>';
                        echo '<a class="nav-link" style="color: black;" href="index.php">Logout</a>';
                    } else {
                        echo '<a class="nav-link" style="color: black;" href="index.php">Login</a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <div class="container">
        <h2 class="heading">Add Prescription</h2>
        <form action="add_prescription.php" method="POST">
            <div class="form-group">
                <label for="medication_id">Medication ID</label>
                <input type="number" class="form-control" id="medication_id" name="medication_id" required>
            </div>
            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text" class="form-control" id="patient_name" name="patient_name" required>
            </div>
            <div class="form-group">
                <label for="patient_contact">Patient Contact</label>
                <input type="text" class="form-control" id="patient_contact" name="patient_contact" required>
            </div>
            <div class="form-group">
                <label for="prescribing_doctor">Prescribing Doctor</label>
                <input type="text" class="form-control" id="prescribing_doctor" name="prescribing_doctor" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="date_prescribed">Date Prescribed</label>
                <input type="date" class="form-control" id="date_prescribed" name="date_prescribed" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Prescription</button>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
