<?php
// Database connection parameters
$servername = "localhost"; // your server name
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "medihub"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize email list array
$emailList = [];

// Fetch all emails from the database
$result = $conn->query("SELECT email FROM accounts");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $emailList[] = $row['email'];
    }
}

// Handle form submission for password reset
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the form
    $email = $_POST['email'];

    // Check if the email exists
    $stmt = $conn->prepare("SELECT email FROM accounts WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email exists, proceed to change password
        if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            // Check if passwords match
            if ($new_password === $confirm_password) {
                // Update the password in the database (storing in plain text)
                $update_stmt = $conn->prepare("UPDATE accounts SET password = ? WHERE email = ?");
                $update_stmt->bind_param("ss", $new_password, $email);
                if ($update_stmt->execute()) {
                    echo "<script>alert('Password changed successfully.'); window.location.href='login.php';</script>";
                } else {
                    echo "<script>alert('Error updating password. Please try again.'); window.location.href='forgot.php';</script>";
                }
                $update_stmt->close();
            } else {
                echo "<script>alert('Passwords do not match. Please try again.'); window.location.href='forgot.php';</script>";
            }
        }
    } else {
        // Email does not exist
        echo "<script>alert('Invalid email or email does not exist.'); window.location.href='forgot.php';</script>";
    }

    $stmt->close();
    $conn->close();
    exit; // Prevent further processing after form submission
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - MediHub</title>
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
            background-image: url('images/background3.png');
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
            background-color: rgba(0, 0, 0, 0.6);
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
        .signup-box input[type="email"],
        .signup-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: none; /* Hide by default */
        }
        .signup-box input[type="email"].visible,
        .signup-box input[type="password"].visible {
            display: block; /* Show when visible class is added */
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
        #changePasswordSection {
            display: none; /* Initially hide the change password section */
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
            <h2 style="margin: 0; margin-left: 10px; font-size: 1.5rem; color: #333;">Forgot Password</h2>
        </div>
    </header>

    <div class="bg-image">
        <div class="bg-overlay"></div>
        <div class="signup-box">
            <h2>Forgot Password</h2>
            <form id="forgotPasswordForm" action="forgot.php" method="POST">
                <input type="email" id="email" name="email" placeholder="Enter your email" required class="visible">
                <button id="nextButton" type="button" onclick="validateEmail()">Next</button>
                
                <div id="changePasswordSection" style="display: none;">
                    <input type="password" name="new_password" placeholder="New Password" required class="visible">
                    <input type="password" name="confirm_password" placeholder="Confirm New Password" required class="visible">
                    <button type="submit">Change Password</button>
                </div>
            </form>
            <a href="login.php" class="login-link">Have an account? Log In</a>
        </div>
    </div>

    <script>
        const validEmails = <?php echo json_encode($emailList); ?>; // Pass the PHP array to JavaScript

        function validateEmail() {
            const emailInput = document.getElementById('email').value;

            if (validEmails.includes(emailInput)) {
                showChangePasswordSection();
            } else {
                alert("Invalid email or email does not exist");
            }
        }

        function showChangePasswordSection() {
            document.getElementById('changePasswordSection').style.display = 'block';
            document.getElementById('nextButton').style.display = 'none'; // Hide next button
        }
    </script>
</body>
</html>