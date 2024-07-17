<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Interface - Prescription Table</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
    
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
<style>
            .btn-add {
            margin-bottom: 20px;
        }
</style>
    <div class="container">
        <h1>Prescription Table</h1>
        <a href="add_prescription.php" class="btn btn-primary btn-add " >Add Prescription</a>
  
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Prescription ID</th>
                    <th>Medication ID</th>
                    <th>Patient Name</th>
                    <th>Patient Contact</th>
                    <th>Prescribing Doctor</th>
                    <th>Quantity</th>
                    <th>Date Prescribed</th>
                </tr>
            </thead>
            <tbody>
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

                // Fetch prescription data
                $sql = "SELECT * FROM prescription";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['prescription_id'] . "</td>";
                        echo "<td>" . $row['medication_id'] . "</td>";
                        echo "<td>" . $row['patient_name'] . "</td>";
                        echo "<td>" . $row['patient_contact'] . "</td>";
                        echo "<td>" . $row['prescribing_doctor'] . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td>" . $row['date_prescribed'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No prescriptions found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
