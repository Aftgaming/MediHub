<?php
// login.php

// Database connection parameters
$servername = "localhost"; // or your server name
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "medihub"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for email and password
$email = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM accounts WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();

    // Check if the email exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stored_password);
        $stmt->fetch();

        // Directly compare the passwords (not recommended for production)
        if ($password === $stored_password) {
            // Start a session and set session variables if needed
            session_start();
            $_SESSION['email'] = $email; // Store email in session for future reference

            // Redirect to index.php after successful login
            header("Location: index.php");
            exit(); // Ensure no further code is executed
        } else {
            // Show alert for invalid password
            echo "<script>alert('Invalid email or password');</script>";
        }
    } else {
        // Show alert for email not found
        echo "<script>alert('Email not found');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - MediHub</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }
        .bg-image {
            background-image: url('images/background1.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            height: 100%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Dark overlay */
        }
        .login-box {
            position: relative;
            padding: 30px;
            max-width: 400px;
            width: 100%;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            z-index: 10;
            text-align: center;
        }
        .login-box h2 {
            font-weight: bold;
            color: #28a745;
            margin-bottom: 20px;
        }
        .login-box input[type="email"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .login-box button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .login-box button:hover {
            background-color: #218838;
        }
        .forgot-password,
        .signup-link {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        .forgot-password:hover,
        .signup-link:hover {
            text-decoration: underline;
        }
        .error-message {
            color: red;
            margin-top: -15px;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <header class="d-flex flex-column" style="padding: 20px 150px; background-color: white; border-bottom: 1px solid #ddd;">
        <div class="d-flex align-items-center">
            <a href="index.php" class="d-flex align-items-center" style="text-decoration: none;">
                <img src="images/logo.png" alt="MediHub Logo" style="height: 60px; margin-right: 10px;"/>
                <h1 style="margin: 0; font-size: 1.8rem; color: #28a745;">MediHub</h1>
            </a>
            <h2 style="margin: 0; margin-left: 10px; font-size: 1.5rem; color: #333;">Log In</h2>
        </div>
    </header>

    <div class="bg-image">
        <div class="bg-overlay"></div>
        <div class="login-box">
            <h2>Log In</h2>
            <form action="login.php" method="POST">
                <input type="email" name="email" placeholder="Enter your email" required value="<?php echo htmlspecialchars($email); ?>">
                <input type="password" name="password" placeholder="Enter your password" required>
                <button type="submit">Log In</button>
            </form>
            <a href="forgot.php" class="forgot-password">Forgot Password?</a>
            <a href="signup.php" class="signup-link">New to MediHub? Sign Up</a>
        </div>
    </div>
</body>
</html>