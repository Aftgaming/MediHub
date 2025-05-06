<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediHub - Home</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    <style>
        .img-box img {
            width: 100%; /* Make the image take the full width of the box */
            height: 200px; /* Set a fixed height */
            object-fit: cover; /* Ensure the image covers the box without distortion */
            border: 2px solid #81c784; /* Set a border color */
            border-radius: 8px; /* Optional: round the corners */
        }
        .category-box {
            cursor: pointer;
            background-color: #f9f9f9;
            border: 1px solid #81c784;
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            text-align: center;
        }
        .medicine-list {
            display: none; /* Hide the list initially */
        }
        .img-box {
            text-align: center; /* Center the text inside the box */
            margin: 10px; /* Optional: add margin for spacing between images */
        }
    </style>
</head>
<body>
    <?php
    session_start(); // Start the session

    // Check if the user is logged in
    $isLoggedIn = isset($_SESSION['email']); // Assuming you set the email in the session upon login
    ?>

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
                <li class="list-inline-item"><a href="profile.php" class="d-flex align-items-center"><b>Profile</b></a></li> <!-- Profile Button -->
                <li class="list-inline-item"><a href="logout.php" class="d-flex align-items-center"><b>Log Out</b></a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="d-flex align-items-center">
        <a href="index.php" class="d-flex align-items-center mr-3">
            <img src="images/logo.png" alt="MediHub Logo" style="height: 60px;"/> <!-- Adjust the logo path and size as needed -->
            <h1 style="margin: 0; margin-left: 10px; font-size: 1.8rem;">MediHub</h1> <!-- Clickable text logo -->
        </a>
        <input type="text" class="form-control mr-2" placeholder="MediHub Search..." aria-label="Search" style="max-width: 1000px;"/>
        <?php if (!$isLoggedIn): ?>
            <a href="login.php" class="btn btn-outline-success ml-auto" style="border: none;">
                <img src="images/cart-icon.png" alt="Add to Cart" style="height: 30px;"/> <!-- Add to cart icon -->
            </a>
        <?php else: ?>
            <a href="cart.php" class="btn btn-outline-success ml-auto" style="border: none;">
                <img src="images/cart-icon.png" alt="Add to Cart" style="height: 30px;"/> <!-- Add to cart icon -->
            </a>
        <?php endif; ?>
    </div>
</header>


    <section class="hero" style="background-color: #81c784; color: white; padding: 100px 20px; text-align: center;">
        <div class="hero-content">
            <h2>Your Health, Our Priority</h2>
            <p>Connecting you to essential health services and information.</p>
        </div>
    </section>

    <!-- Slider Section for Services -->
    <section class="slider_section position-relative">
        <div id="carouselServices" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="img-box">
                                    <img src="images/magnifying glass.jpg" alt="Find a Pharmacy" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="detail-box">
                                    <h3>Find a Pharmacy</h3>
                                    <p>Searching for a reliable pharmacy can be challenging, especially in a new area. With our "Find a Pharmacy" service, you can easily locate pharmacies nearby, view their operating hours, and even check for available medications. Our platform connects you to a network of trusted pharmacies, ensuring you get the health products you need without any hassle. Take the stress out of finding a pharmacy—let us guide you to the right place!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="img-box">
                                    <img src="images/price check.png" alt="Medicine Price Check" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="detail-box">
                                    <h3>Medicine Price Check</h3>
                                    <p>Are you tired of guessing the prices of your medications? Our "Medicine Price Check" service allows you to instantly compare prices across different pharmacies. By simply entering the name of your medication, you can view a list of local pharmacies, their prices, and any available discounts or promotions. This service helps you save money while ensuring you never overpay for your prescriptions again. Your health shouldn’t break the bank!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="img-box">
                                    <img src="images/health consult.jpg" alt="Health Consultations" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="detail-box">
                                    <h3>Health Consultations</h3>
                                    <p>Accessing healthcare professionals has never been easier with our "Health Consultations" service. Whether you need medical advice, have questions about a specific condition, or want to discuss treatment options, our platform connects you with licensed healthcare providers for virtual consultations. You can schedule appointments at your convenience, receive personalized guidance, and ensure that your health is always a top priority. Get the care you deserve from the comfort of your home!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a class="carousel-control-prev" href="#carouselServices" role="button" data-slide="prev">
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselServices" role="button" data-slide="next">
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
    <!-- End of Slider Section -->

    <!-- Main Content -->
    <main class="main-content">
        <section>
            <!-- Popular Pharmacies Section -->
            <section>
                <div style="text-align: left; margin: 0 auto; max-width: 800px;">
                    <h2 style="color: #4caf 50; font-size: 2rem;">Popular Pharmacies</h2>
                </div>
                <div class="clickable-images">
                    <div class="category">
                        <a href="https://tgp.com.ph">
                            <img src="images/TGP-Logo.png" alt="Pharmacy 1">
                            <p>The Generics Pharmacy</p>
                        </a>
                    </div>
                    <div class="category">
                        <a href="https://www.mercurydrug.com">
                            <img src="images/Mercury-Drugs-Logo.png" alt="Pharmacy 2">
                            <p>Mercury Drug</p>
                        </a>
                    </div>
                    <div class="category">
                        <a href="https://southstardrug.com.ph/?gclid=Cj0KCQiA_qG5BhDTARIsAA0UHSLHiUW3-bCcrqhWzl1yBzmPVPu7AjOhoHuTymFjuw2E8KMB2vltWFQaAuRZEALw_wcB">
                            <img src="images/Southstart-Drugstore.png" alt="Pharmacy 3">
                            <p>Southstar Drug</p>
                        </a>
                    </div>
                    <div class="category">
                        <a href="https://generika.com.ph">
                            <img src="images/Generika-Drugstore.png" alt="Pharmacy 4">
                            <p>Generika Drugstore</p>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Over-the-Counter Medicines Section -->
            <section>
                <div style="text-align: left; margin: 0 auto; max-width: 800px;">
                    <h2 style="color: #4caf50; font-size: 2rem;">Over-the-Counter Medicines</h2>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="category-box" onclick="toggleMedicines('fever')">
                                <h5>For Fever, Headache, and Pain</h5>
                            </div>
                            <div class="medicine-list" id="fever">
                                <div class="img-box">
                                    <img src="images/biogesic.jpg" alt="Paracetamol">
                                    <p>Paracetamol</p>
                                </div>
                                <div class="img-box">
                                    <img src="images/medicol.png" alt="Ibuprofen">
                                    <p>Ibuprofen</p>
                                </div>
                                <div class="img-box">
                                    <img src="images/naproxen.png" alt="Naproxen">
                                    <p>Naproxen</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="category-box" onclick="toggleMedicines('cough')">
                                <h5>For Cough</h5>
                            </div>
                            <div class="medicine-list" id="cough">
                                <div class="img-box">
                                    <img src="images/Dextromethorphan.jpg" alt="Dextromethorphan">
                                    <p>Dextromethorphan (for dry cough)</p>
                                </div>
                                <div class="img-box">
                                    <img src="images/Guaifenesin.jpg" alt="Guaifenesin">
                                    <p>Guaifenesin (for cough with phlegm)</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="category-box" onclick="toggleMedicines('allergies')">
                                <h5>For Allergies</h5>
                            </div>
                            <div class="medicine-list" id="allergies">
                                <div class="img-box">
                                    <img src="images/Diphenhydramine.png" alt="Diphenhydramine">
                                    <p>Diphenhydramine</p>
                                </div>
                                <div class="img-box">
                                    <img src="images/Chlorpheniramine.jpg" alt="Chlorpheniramine">
                                    <p>Chlorpheniramine</p>
                                </div>
                                <div class="img-box">
                                    <img src="images/Loratadine.jpg" alt="Loratadine">
                                    <p>Loratadine</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="category-box" onclick="toggleMedicines('cuts ')">
                                <h5>For Cuts and Burns</h5>
                            </div>
                            <div class="medicine-list" id="cuts">
                                <div class="img-box">
                                    <img src="images/Povidone-iodine solution.jpg" alt="Povidone-iodine solution">
                                    <p>Povidone-iodine solution (antiseptic)</p>
                                </div>
                                <div class="img-box">
                                    <img src="images/Hydrogen peroxide.png" alt="Hydrogen peroxide">
                                    <p>Hydrogen peroxide</p>
                                </div>
                                <div class="img-box">
                                    <img src="images/Bandages and gauze pads.jpg" alt="Bandages and gauze pads">
                                    <p>Bandages and gauze pads</p>
                                </div>
                                <div class="img-box">
                                    <img src="images/Medical tape.jpg" alt="Medical tape">
                                    <p>Medical tape</p>
                                </div>
                                <div class="img-box">
                                    <img src="images/Antibiotic ointment.png" alt="Antibiotic ointment">
                                    <p>Antibiotic ointment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <section class="testimonials">
        <h2>What Our Users Say</h2>
        <div class="testimonials-container">
            <div class="testimonial">
                <img src="images/anonymous.jpg" alt="User  Avatar" class="avatar">
                <blockquote>
                    <p>"MediHub has made it so easy for me to find health services!"</p>
                    <footer>- Anonymous</footer>
                </blockquote>
            </div>
            <div class="testimonial">
                <img src="images/anonymous.jpg" alt="User  Avatar" class="avatar">
                <blockquote>
                    <p>"The price checker feature saved me a lot of money on my prescriptions!"</p>
                    <footer>- Anonymous</footer>
                </blockquote>
            </div>
        </div>
    </section>

    <section class="newsletter" style="padding: 40px 20px; text-align: center;">
        <h2>Stay Updated</h2>
        <p>Sign up for our newsletter for the latest updates!</p>
        <form>
            <input type="email" placeholder="Enter your email" required>
            <button type="submit" class="btn btn-primary">Subscribe</button>
        </form>
    </section>

    <footer style="background-color: #333; color: white; text-align: center; padding: 10px 0;">
        <p>&copy; 2024 MediHub. All rights reserved.</p>
    </footer>

    <button class="chatbot-toggler">
        <span class="material-symbols-rounded">mode_comment</span>
        <span class="material-symbols-outlined">close</span>
    </button>
    <div class="chatbot">
        <header>
            <h2>Nurse Meddy - Chatbot</h2>
            <span class="close-btn material-symbols-outlined">close</span>
        </header>
        <ul class="chatbox">
            <li class="chat incoming">
                <span class="material-symbols-outlined">smart_toy</span>
                <p>Hi there 👋, Nurse Meddy here!<br>How can I help you today?</p>
            </li>
        </ul>
        <div class="chat-input">
            <textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
            <span id="send-btn" class="material-symbols-rounded">send</span>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function toggleMedicines(category) {
            const medicineList = document.getElementById(category);
            if (medicineList.style.display === "none" || medicineList.style.display === "") {
                medicineList.style.display = "block"; // Show the medicine list
            } else {
                medicineList.style.display = "none"; // Hide the medicine list
            }
        }
    </script>
</body>
</html>