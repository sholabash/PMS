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
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $user_id = $_POST['user_id'];

    // Validate form data
    if (!empty($name) && !empty($address) && !empty($contact_number) && !empty($user_id)) {
        // Insert data into the pharmacy table
        $sql = "INSERT INTO pharmacy (name, address, contact_number, user_id) 
                VALUES ('$name', '$address', '$contact_number', '$user_id')";

        if ($conn->query($sql) === TRUE) {
            echo "New pharmacy added successfully";
            // Redirect to pharmacy list or any other page
            header("Location: pharmacy.php");
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
    <title>User Interface - Pharmacy Table</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>

        .container {
            margin-top: 30px;
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
            <li class="nav-item navbar_padding">
                <a class="nav-link" style="color: black;" href="medication_chart.php">Chart Report</a>
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
    <h1>Pharmacy Table</h1>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Pharmacy ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>User ID</th>
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

            // Fetch pharmacies
            $sql = "SELECT * FROM pharmacy";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["pharmacy_id"] . "</td>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["address"] . "</td>
                            <td>" . $row["contact_number"] . "</td>
                            <td>" . $row["user_id"] . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No pharmacies found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <h2 class="mt-5">Add New Pharmacy</h2>
    <form action="pharmacy.php" method="POST">
        <div class="form-group">
            <label for="name">Pharmacy Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="contact_number">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number" required>
        </div>
        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="number" class="form-control" id="user_id" name="user_id" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Pharmacy</button>
    </form>
</div>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
