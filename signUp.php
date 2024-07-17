<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords
    if ($password != $confirm_password) {
        echo "Passwords do not match.";
    } else {
        // Check for existing username or email
        $check_query = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
        if ($check_query === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }
        $bind_check = $check_query->bind_param("ss", $username, $email);
        if ($bind_check === false) {
            die("Bind failed: " . htmlspecialchars($check_query->error));
        }
        $check_query->execute();
        $result = $check_query->get_result();
        if ($result->num_rows > 0) {
            echo "Username or Email already exists.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, ?)");
            if ($stmt === false) {
                die("Prepare failed: " . htmlspecialchars($conn->error));
            }
            $role = 'user'; // or whatever role you want to assign
            $bind = $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);
            if ($bind === false) {
                die("Bind failed: " . htmlspecialchars($stmt->error));
            }

            // Execute the statement
            $execute = $stmt->execute();
            if ($execute) {
                echo "New record created successfully";
                // Redirect to login page or another page
                header("Location: index.php");
                exit;
            } else {
                echo "Execute failed: " . htmlspecialchars($stmt->error);
            }

            // Close the statement
            $stmt->close();
        }

        // Close the check query
        $check_query->close();
    }
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signUp.css">
</head>
<body>

<div class="container row">
    <div class="signup-container col-md-5">
        <img src="images/Sud Logo.png" alt="" width="400">
        <form action="signUp.php" method="POST">
            <h2 class="text-center mb-4">Register</h2>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control sign_up_form" id="username" name="username" placeholder="Enter a username" required>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control sign_up_form" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control sign_up_form" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control sign_up_form" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn signup_button btn-block">Register</button>
            <div class="text-center mt-2">
                <a class="login_text text-center" href="index.php">Login</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
