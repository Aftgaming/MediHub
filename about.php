    <?php
    session_start(); // Start the session to access user data
    $isLoggedIn = isset($_SESSION['email']); // Check if the user is logged in
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediHub - About</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .about-container {
        padding: 20px;
        background-color: #f9f9f9;
        text-align: center;
    }

    .carousel {
        position: relative;
        margin: 30px auto;
        overflow: hidden;
        max-width: 500px;
        width: 80%;
        background-color: #e9ecef;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .carousel-inner {
        display: flex;
        transition: transform 0.5s ease;
        width: 100%;
        text-align: center;
    }

    .carousel-item {
        min-width: 100%;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .carousel-item img {
        width: 80%;
        max-width: 150px;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .carousel-controls {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        transform: translateY(-50%);
    }

    .carousel-button {
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size: 24px;
        color: #333;
    }
	.team-member img {
    border: 5px solid #28a745; /* Green border */
    border-radius: 50%; /* Keeps the circular shape */
    width: 100px;
    height: 100px;
    margin-bottom: 10px;
}
.description-box {
    background-color: rgba(40, 167, 69, 0.1); /* Light green background for the box */
    padding: 15px;
    margin-top: 10px;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Optional shadow for depth */
	}
        .team-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .team-member {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px;
            border-radius: 5px;
            background-color: #fff;
            width: 250px; /* Adjust width for portrait style */
            text-align: center;
        }
        .team-member img {
            border-radius: 50%;
            width: 100px; /* Adjusted size */
            height: 100px; /* Adjusted size */
            margin-bottom: 10px;
        }
	
}

.about-container h2 {
    margin-bottom: 20px; /* Space after About MediHub heading */
}

.about-container p {
    margin-bottom: 20px; /* Space after the content paragraph */
}

.explore-button {
    display: inline-block;
    margin: 20px 0 40px 0; /* Space above and below the button */
    padding: 10px 25px;
    background-color: #28a745;
    color: #fff;
    font-size: 1rem;
    text-decoration: none;
    border-radius: 50px;
    transition: background-color 0.3s ease;
}

.explore-button:hover {
    background-color: #218838;
}
.transparent-box {
    background-color: #f9f8f8; /* Semi-transparent white */
    padding: 20px;
    margin: 20px auto;
    max-width: 600px;
    border-radius: 8px;
    
    </style>
</head>
<body>
    <header style="background-color: white; padding: 10px 0;">
        <div class="header-container" style="display: flex; align-items: center; justify-content: space-between; max-width: 1200px; margin: auto;">
            <a href="index.php" class="logo-title" style="display: flex; align-items: center; text-decoration: none; color: black;">
                <img src="images/logo.png" alt="MediHub Logo" style="height: 60px; margin-right: 10px;" />
                <h1 style="margin: 0; font-size: 1.8rem; color: #4caf50">MediHub</h1>
                <span style="margin-left: 15px; font-size: 1.2rem; font-weight: 500;">About Us</span>
            </a>
            <nav>
                <ul class="nav-links" style="display: flex; list-style: none; padding: 0; margin: 0;">
                    <li style="margin-left: 20px;"><a href="index.php" style="text-decoration: none; color: black;">Home</a></li>
                    <li style="margin-left: 20px;"><a href="services.php" style="text-decoration: none; color: black;">Services</a></li>
                    <li style="margin-left: 20px;"><a href="about.php" style="text-decoration: none; color: black;">About</a></li>
					<li class="list-inline-item"><a href="chatbot.php" style="text-decoration: none; color: black;">Chatbot</a></li>
                    <?php if (!$isLoggedIn): ?>
						    <li class="list-inline-item" style="margin-right: 0px;"><a href="signup.php" class="d-flex align-items-center" style="text-decoration: none; color: black;">Sign Up</a></li>
							<li style="margin-left: 20px;"><a href="login.php" style="text-decoration: none; color: black;">Log In</a></li>
                    <?php else: ?>
                        <li style="margin-left: 20px;"><a href="profile.php" style="text-decoration: none; color: black;">Profile</a></li>
                        <li style="margin-left: 20px;"><a href="logout.php" style="text-decoration: none; color: black;">Log Out</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Green Gradient Separator -->
    <div class="header-gradient"></div>

    <section id="about" class="about-container">
        <div class="about-content">
            <h2>About MediHub</h2>
            <div class="transparent-box">
                <p>MediHub is dedicated to providing accessible health services and information to our community. Our platform connects users with local pharmacies, health consultations, and vital resources to promote better health outcomes.</p>
                <a href="index.php" class="explore-button">Explore MediHub</a>
            </div>

            <h3>Our Mission, Vision, and Values</h3>
            <div class="carousel">
                <div class="carousel-inner" id="carouselInner">
                    <div class="carousel-item">
                        <img src="images/mission.jpg" alt="Mission Image">
                        <h4>Our Mission</h4>
                        <p>To empower individuals by offering seamless access to essential health services, enabling informed decisions regarding their health and well-being.</p>
                    </div>
                    <div class="carousel-item">
                        <img src="images/vision.jpg" alt="Vision Image">
                        <h4>Our Vision</h4>
                        <p>To be the leading provider of health services, ensuring every individual has access to quality healthcare resources.</p>
                    </div>
                    <div class="carousel-item">
                        <img src="images/values.jpg" alt="Values Image">
                        <h4>Our Values</h4>
                        < p>Integrity, compassion, and excellence are at the core of everything we do. We are committed to supporting our community's health.</p>
                    </div>
                </div>
                <div class="carousel-controls">
                    <button class="carousel-button" id="prevButton">&lt;</button>
                    <button class="carousel-button" id="nextButton">&gt;</button>
                </div>
            </div>

            <h2>Meet Our Team</h2>
            <div class="team-container">
                <div class="team-member">
                    <img src="images/jerick.jpg" alt="Team Member 1">
                    <h4>Jerick Alejandro</h4>
                    <div class="description-box">
                        <p><b>--Project Manager--</b></p>
                    </div>
                    <div class="description-box">
                        <p>Jerick oversees the development and implementation of MediHub, ensuring a user-friendly experience for all our users.</p>
                        <p>Email: jerickalejandro@gmail.com</p>
                        <p>Phone: +63123 456 789</p>
                    </div>
                </div>
                <div class="team-member">
                    <img src="images/aljo.jpg" alt="Team Member 2">
                    <h4>Aljo Lacerna</h4>
                    <div class="description-box">
                        <p><b>--Software Developer--</b></p>
                    </div>
                    <div class="description-box">
                        <p>Aljo is responsible for maintaining the platform's performance and security, ensuring that our users' data is protected.</p>
                        <p>Email: aljolacerna@gmail.com</p>
                        <p>Phone: +63123 456 789</p>
                    </div>
                </div>
                <div class="team-member">
                    <img src="images/johnrenz.jpg" alt="Team Member 3">
                    <h4>Johnrenz Pilapil</h4>
                    <div class="description-box">
                        <p><b>--Marketing Specialist--</b></p>
                    </div>
                    <div class="description-box">
                        <p>Johnrenz works to promote MediHub and connect with the community to increase awareness of our services.</p>
                        <p>Email: jrpilapil@gmail.com</p>
                        <p>Phone: +63123 456 789</p>
                    </div>
                </div>
                <div class="team-member">
                    <img src="images/marc.jpg" alt="Team Member 4">
                    <h4>Marc Andal</h4>
                    <div class="description-box">
                        <p><b>--Data Analyst--</b></p>
                    </div>
                    <div class="description-box">
                        <p>Marc analyzes data to improve our services and provide insights into community health needs.</p>
                        <p>Email: marcandal@gmail.com</p>
                        <p>Phone: +63123 456 789</p>
                    </div>
                </div>
                <div class="team-member">
                    <img src="images/francis.jpg" alt="Team Member 5">
                    <h4>Francis So</h4>
                    <div class="description-box">
                        <p><b>--Customer Support--</b></p>
                    </div>
                    <div class="description-box">
                        <p>Francis ensures that all user inquiries are addressed promptly and efficiently, providing excellent customer service.</p>
                        <p>Email: francisso@gmail.com</p>
                        <p>Phone: +63123 456 789</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 MediHub. All rights reserved.</p>
    </footer>

    <script>
        const carouselInner = document.getElementById('carouselInner');
        const carouselItems = document.querySelectorAll('.carousel-item');
        let currentIndex = 0;

        document.getElementById('nextButton').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % carouselItems.length;
            updateCarousel();
        });

        document.getElementById('prevButton').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
            updateCarousel();
        });

        function updateCarousel() {
            const offset = -currentIndex * 100;
            carouselInner.style.transform = `translateX(${offset}%)`;
        }
    </script>
</body>
</html>