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

// Fetch sales data
$sql = "SELECT sale_id, medication_id, pharmacy_id, customer_id, quantity_sold, price_per_unit, total_price, timestamp FROM sales";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Management</title>
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
            max-width: 800px;
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
        .btn-add {
            margin-bottom: 20px;
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
        <h2 class="heading">Sales Management</h2>
        <a href="addSales.php" class="btn btn-primary btn-add">Add Sale</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Medication</th>
                    <th scope="col">Pharmacy</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Quantity Sold</th>
                    <th scope="col">Price Per Unit</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result !== false) {
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>" . $row['sale_id'] . "</th>";
                            echo "<td>" . $row['medication_id'] . "</td>";
                            echo "<td>" . $row['pharmacy_id'] . "</td>";
                            echo "<td>" . $row['customer_id'] . "</td>";
                            echo "<td>" . $row['quantity_sold'] . "</td>";
                            echo "<td>" . $row['price_per_unit'] . "</td>";
                            echo "<td>" . $row['total_price'] . "</td>";
                            echo "<td>" . $row['timestamp'] . "</td>";
                            echo "<td>";
                            echo "<a href='edit_sale.php?id=" . $row['sale_id'] . "' class='btn btn-sm btn-primary'>Edit</a>";
                            echo " <a href='delete_sale.php?id=" . $row['sale_id'] . "' class='btn btn-sm btn-danger'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>No sales found</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>Error: " . $conn->error . "</td></tr>";
                }
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

<?php
// Close the database connection
$conn->close();
?>
