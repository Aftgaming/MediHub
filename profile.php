<?php
session_start(); // Start the session

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

// Check if user is logged in
$isLoggedIn = isset($_SESSION['email']); // Assuming you set the email in the session upon login

// Handle form submissions for updating profile details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email']; // Get the logged-in user's email

    // Update name
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $stmt = $conn->prepare("UPDATE accounts SET name = ? WHERE email = ?");
        $stmt->bind_param("ss", $name, $email);
        $stmt->execute();
        $stmt->close();
    }

    // Update username
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $stmt = $conn->prepare("UPDATE accounts SET username = ? WHERE email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->close();
    }

    // Update phone number
    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
        $stmt = $conn->prepare("UPDATE accounts SET phonenumber = ? WHERE email = ?");
        $stmt->bind_param("ss", $phone, $email);
        $stmt->execute();
        $stmt->close();
    }

    // Update gender
    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
        $stmt = $conn->prepare("UPDATE accounts SET gender = ? WHERE email = ?");
        $stmt->bind_param("ss", $gender, $email);
        $stmt->execute();
        $stmt->close();
    }

    // Update date of birth
    if (isset($_POST['date_of_birth'])) {
        $date_of_birth = $_POST['date_of_birth'];
        $stmt = $conn->prepare("UPDATE accounts SET dateofbirth = ? WHERE email = ?");
        $stmt->bind_param("ss", $date_of_birth, $email);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect back to profile page after updating
    header("Location: profile.php");
    exit();
}

// Fetch current user data
$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT username, name, phonenumber, gender, dateofbirth FROM accounts WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($username, $name, $phone, $gender, $date_of_birth);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediHub - Profile</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e7f9e9;
        }
        .sidebar a {
            text-decoration: none;
            color: #333;
            padding: 8px;
            display: block;
            border-radius: 4px;
            transition: color 0.3s;
            font-size: 1rem; /* Consistent font size */
            cursor: pointer; /* Pointer cursor for links */
        }
        .sidebar h3 {
            margin: 0;
            font-size: 1rem; /* Set a consistent font size for h3 */
        }
        .sidebar a:hover {
            color: #28a745; /* Change text color on hover */
        }
        .my-account a:hover, .my-purchases a:hover, .my-vouchers a:hover {
            color: #28a 745; /* Change text color on hover for specific links */
        }
        .dropdown {
            display: none; /* Initially hidden */
        }
        .dropdown.active {
            display: block; /* Show when active */
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header class="d-flex flex-column" style="padding: 20px 150px;">
        <nav class="d-flex justify-content-end mb-2">
            <ul class="list-inline mb-0" style="font-size: 0.85rem;">
                <li class="list-inline-item"><a href="index.php">Home</a></li>
                <li class="list-inline-item"><a href="services.php">Services</a></li>
                <li class="list-inline-item"><a href="about.php">About</a></li>
                <li class="list-inline-item"><a href="chatbot.php">Chatbot</a></li>
                <?php if (!$isLoggedIn): ?>
                    <li class="list-inline-item" style="margin-right: 0px;"><a href="signup.php" class="d-flex align-items-center"><b>Sign Up</b></a></li>
                    <li class="list-inline-item"><a href="login.php" class="d-flex align-items-center"><b>Log In</b></a></li>
                <?php else: ?>
                    <li class="list-inline-item"><a href="profile.php" class="d-flex align-items-center"><b>Profile</b></a></li>
                    <li class="list-inline-item"><a href="logout.php" class="d-flex align-items-center"><b>Log Out</b></a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="d-flex align-items-center">
            <a href="index.php" class="d-flex align-items-center mr-3">
                <img src="images/logo.png" alt="MediHub Logo" style="height: 60px;"/>
                <h1 style="margin: 0; margin-left: 10px; font-size: 1.8rem;">MediHub</h1>
            </a>
            <input type="text" class="form-control mr-2" placeholder="MediHub Search..." aria-label="Search" style="max-width: 1000px;"/>
            <a href="cart.php" class="btn btn-outline-success ml-auto" style="border: none;">
                <img src="images/cart-icon.png" alt="Add to Cart" style="height: 30px;"/>
            </a>
        </div>
    </header>

    <!-- Profile Page Content -->
    <div class="account-container">
        <div class="sidebar" style="background-color: #e7f9e9;">
            <div class="profile-section d-flex align-items-center">
                <img src="images/user-profile.jpg" alt="User  Profile Picture" class="profile-pic" style="margin-right: 10px;">
                <div>
                    <h2 id="user-name"><?php echo htmlspecialchars($username); ?></h2>
                    <a href="#" class="edit-profile-link" style="color: gray;">Edit Profile</a>
                </div>
            </div>
            <div class="my-account">
                <h3 class="clickable" onclick="toggleDropdown('accountDropdown')">
                    <a href="#" class="account-link">My Account</a>
                </h3>
                <ul class="dropdown" id="accountDropdown">
                    <li><a href="profile.php" class="account-link">Profile</a></li>
                    <li><a href="payment.html" class="account-link">Payment Methods</a></li>
                    <li><a href="addresses.html" class="account-link">Addresses</a></li>
                    <li><a href="privacy.html" class="account-link">Privacy Settings</a></li>
                </ul>
            </div>
            <div class="my-purchases">
                <h3><a href="cart.php" class="purchases-link">My Purchases</a></h3>
            </div>
            <div class="my-vouchers">
                <h3><a href="vouchers.html" class="vouchers-link">My Vouchers</a></h3>
            </div>
        </div>

        <!-- Main Profile Box -->
        <div class="profile-box">
            <h2>My Profile</h2>
            <p>Manage your profile</p>
            <hr>

            <form method="POST" action="profile.php">
                <div class="profile-details">
                    <div class="left-details">
                        <div class="detail-item">
                            <label for="username"><strong>Username:</strong></label>
                            <input type="text" id="username" name="username" placeholder="Enter your username" value="<?php echo htmlspecialchars($username); ?>" onchange="updateName()">
                        </div>
                        <div class="detail-item">
                            <label for="name"><strong>Name:</strong></label>
                            <input type="text" id="name" name="name" placeholder="Enter your name" value="<?php echo htmlspecialchars($name); ?>" onchange="updateName()">
                        </div>
                        <div class="detail-item">
                            <strong>Email:</strong>
                            <span id="email-text"><?php echo htmlspecialchars($email); ?></span>
                        </div>
                        <div class="detail-item">
                            <strong>Phone Number:</strong>
                            <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($phone); ?>" onchange="updatePhone()">
                        </div>
                        <div class="detail-item">
                            <strong>Gender:</strong>
                            <label><input type="radio" name="gender" value="Male" <?php echo ($gender == 'Male') ? 'checked' : ''; ?> onchange="updateGender()"> Male</label>
                            <label><input type="radio" name="gender" value="Female" <?php echo ($gender == 'Female') ? 'checked' : ''; ?> onchange="updateGender()"> Female</label>
                            <label><input type="radio" name="gender" value="Other" <?php echo ($gender == 'Other') ? 'checked' : ''; ?> onchange="updateGender()"> Other</label>
                        </div>
                        <div class="detail-item">
                            <strong>Date of Birth:</strong>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="<?php echo htmlspecialchars($date_of_birth); ?>" onchange="updateBirthdate()">
                        </div>
                    </div>

                    <div class="right-details">
                        <img id="profile-pic-preview" src="images/user-profile.jpg" alt="User  Profile Picture" class="profile-pic-large">
                        <button onclick="document.getElementById('upload-profile-pic').click()" class="change-image-btn">Change Image</button>
                        <input type="file" id="upload-profile-pic" accept=".jpeg, .png" onchange="previewImage(event)" style="display: none;">
                        <p>File size: maximum 1 MB</p>
                        <p>File extensions: .JPEG, .PNG</p>
                    </div>
                </div>
                <!-- Save Changes Button -->
                <button type="submit" class="btn btn-primary save-changes-btn">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dd => {
                if (dd !== dropdown) {
                    dd.classList.remove('active'); // Collapse other dropdowns
                }
            });
            dropdown.classList.toggle('active'); // Toggle the clicked dropdown
        }

        function updateName() {
            const nameField = document.getElementById('name');
            const userName = document.getElementById('user-name');
            userName.textContent = nameField.value;
        }

        function updatePhone() {
            const phoneField = document.getElementById('phone');
            // Additional logic can be added here if needed
        }

        function updateGender() {
            // Additional logic can be added here if needed
        }

        function updateBirthdate() {
            // Additional logic can be added here if needed
        }

        function previewImage(event) {
            const file = event.target.files[0];
            if (file && file.size <= 1 * 1024 * 1024) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-pic-preview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                alert('File size must be less than or equal to 1 MB.');
            }
        }
    </script>
    <footer style="background-color: #333; color: white; text-align: center; padding: 10px 0;">
        <p>&copy; 2024 MediHub. All rights reserved.</p>
    </footer>
</body>
</html>