<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <div class="dashboard-container">
            <h2 class="dashboard-heading mt-3">Dashboard</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <i class="fa fa-medkit" style="font-size: 50px ;" aria-hidden="true"></i>
                            <h5 class="card-title mt-5 card_head_weight">Medication Management</h5>
                            <p class="card-text">Manage medication inventory, add, edit, or remove medications.</p>
                            <a href="medication_management.php" class="btn btn-primary stretched-link">Go to Medication</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <i class="fa fa-user" style="font-size: 50px ;" aria-hidden="true"></i>
                            <h5 class="card-title mt-5 card_head_weight">Sales Management</h5>
                            <p class="card-text">View sales records, manage transactions, and generate reports.</p>
                            <a href="sales_management.php" class="btn btn-primary stretched-link">Go to Sales</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <i class="fa fa-address-book" style="font-size: 50px ;" aria-hidden="true"></i>
                            <h5 class="card-title mt-5 card_head_weight">Prescription Management</h5>
                            <p class="card-text">Manage prescriptions, view patient details, and update prescriptions.</p>
                            <a href="prescription.php" class="btn btn-primary stretched-link">Go to Prescriptions</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body text-center ">
                            <i class="fa fa-users" style="font-size: 50px ;" aria-hidden="true"></i>
                            <h5 class="card-title mt-5 card_head_weight">Customer Management</h5>
                            <p class="card-text">Manage customer records, view contact details, and update information.</p>
                            <a href="customer.php" class="btn btn-primary stretched-link">Go to Customers</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
