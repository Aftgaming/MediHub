<?php
// signup.php

// Start session
session_start();

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

// Initialize variables for email and passwords
$email = '';
$password = '';
$password2 = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Check if passwords match
    if ($password !== $password2) {
        echo "<script>alert('Passwords do not match.');</script>";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO accounts (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password); // Store plain text password

        // Execute the statement
        if ($stmt->execute()) {
            // Automatically log in the user
            $_SESSION['email'] = $email; // Store email in session

            // Redirect to index.php after successful signup and login
            header("Location: index.php");
            exit(); // Ensure no further code is executed
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - MediHub</title>
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
            background-image: url('images/background3.png'); /* Replace with your image path */
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
        .signup-box {
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
        .signup-box h2 {
            font-weight: bold;
            color: #28a745;
            margin-bottom: 20px;
        }
        .signup-box input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
		.signup-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
		.signup-box input[type="password2"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .signup-box button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .signup-box button:hover {
            background-color: #218838;
        }
        .login-link {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        .login-link:hover {
            text-decoration: underline;
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
            <h2 style="margin: 0; margin-left: 10px; font-size: 1.5rem; color: #333;">Sign Up</h2>
        </div>
    </header>
    <div class="bg-image">
        <div class="bg-overlay"></div>
        <div class="signup-box">
            <h2>Sign Up</h2>
            <form method="POST" action="">
                <input type="email" name="email" placeholder="Email" required value="<?php echo htmlspecialchars($email); ?>">
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password2" placeholder="Confirm Password" required>
                <button type="submit">Create Account</button>
            </form>
            <a href="login.php" class="login-link">Already have an account? Log in</a>
        </div>
    </div>
</body>
</html>