<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediHub - Services</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    <style>
        .results-container, .price-results-container {
            margin-top: 20px;
        }
        .result-card, .price-card {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        #map {
            height: 400px;
            width: 100%;
            margin-top: 20px;
            display: flex;
            justify-content: center; /* Center the map horizontally */
        }
        iframe {
            border: 0; /* Remove default border */
            width: 100%; /* Make iframe take full width of its container */
            max-width: 600px; /* Set a max-width for the iframe */
            height: 450px; /* Set the height for the iframe */
        }
        .consultation-form {
            border: 1px solid #ccc;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            background-color: #f0f9f0;
        }
        .location-city h3 {
            margin-top: 20px;
        }
        .location-city ul {
            list-style-type: none;
            padding: 0;
        }
        .location-city li {
            margin-bottom: 10px;
        }
        .location-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            background-color: #f1f1f1;
            margin-bottom: 10px;
        }
        .location-card h4 {
            margin: 0 0 5px 0;
        }
        .location-card p {
            margin: 0;
            color: #555;
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


    <section id="services">
        <h2>Pharmacy Location</h2>
        <form class="search-form" id="searchForm">
            <input type="text" id="locationInput" placeholder="Enter your location" required>
            <button type="submit">Search</button>
        </form>
        
        <div class="results-container" id="resultsContainer"></div>
    </section>
        
    <h3>Our Services</h3>
    <div class="services-container">
        <div class="service-card">
            <img src="images/magnifying glass.jpg" alt="Find a Pharmacy">
            <h4>Pharmacy Locations</h4>
            <p>Locate pharmacies in your area quickly and easily. Get directions, contact numbers, and operating hours.</p>
        </div>
        <div class="service-card">
            <img src="images/price check.png" alt="Medicine Price Check">
            <h4>Medicine Price Check</h4>
            <p>Check the prices of medications across local pharmacies to find the best deals.</p>
            <form id="priceCheckForm">
                <input type="text" id="medicineInput" placeholder="Enter medicine name" required>
                <button type="submit">Check Price</button>
            </form>
            <div class="price-results-container" id="priceResultsContainer">
                <!-- Fake price results will be displayed here -->
            </div>
        </div>
        <div class="service-card">
            <img src="images/health consult.jpg" alt="Health Consultations">
            <h4>Health Consultation</h4>
            <p>Schedule consultations with healthcare professionals for personalized advice and guidance regarding your health.</p>
            <form id="consultationForm" class="consultation-form">
                <input type="text" id="nameInput" placeholder="Your Name" required><br><br>
                <input type="email" id="emailInput" placeholder="Your Email" required><br><br>
                <textarea id="messageInput" placeholder="Describe your health concern" required></textarea><br><br>
                <button type="submit">Request Consultation</button>
            </form>
            <div id="consultationMessage"></div>
        </div>
    </div>
    
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

    <script>
        const hospitalPharmacyData = {
            "Quezon City": [
        { name: "St. Luke's Medical Center", type: "Hospital", address: "279 E Rodriguez Sr. Ave, Quezon City, 1112 Metro Manila" },
        { name: "Quezon City General Hospital", type: "Hospital", address: "M269+F78, Seminary Rd, Project 8, Quezon City, Metro Manila" },
        { name: "Commonwealth Hospital and Medical Center", type: "Hospital", address: "Regalado Hwy, Novaliches, Quezon City, Metro Manila" },
        { name: "Diliman Doctors Hospital", type: "Hospital", address: "251 Commonwealth Ave, Quezon City, 1119 Metro Manila" },
        { name: "Metro North Medical Center Hospital", type: "Hospital", address: "1001 Mindanao Ave Ext, Brgy, Quezon City, 1106 Metro Manila" },
        { name: "Mercury Drug Quezon City Novaliches Nova Square", type: "Pharmacy", address: "Nova Square Quirino Highway, Cor Pablo Dela Cruz, Quezon City, 1116 Metro Manila" },
        { name: "Delcis Pharmacy", type: "Pharmacy", address: "Carmine Place 1 Jaguar Street, Corner Dahlia Ave, West Fairview, Quezon City, 1118 Metro Manila" },
        { name: "Genericsking Trading Inc (Genericsking Pharmacy) - Quezon City", type: "Pharmacy", address: "930-G Del Monte Ave, San Francisco del Monte, Quezon City, 1100 Metro Manila" },
        { name: "The Generics Pharmacy - Roosevelt Ave., Quezon City", type: "Pharmacy", address: "155 C Fernando Poe Jr. Ave, Quezon City, 1105 Metro Manila" },
        { name: "OXYMED Pharmacy & Medical Supplies", type: "Pharmacy", address: "1 Sto Tomas St., Sampaloc, Lungsod Quezon, 1113 Kalakhang Maynila" }
    ],
    "Makati": [
        { name: "Makati Medical Center", type: "Hospital", address: "2 Amorsolo Street, Legazpi Village, Makati, 1229 Kalakhang Maynila" },
        { name: "Makati Life Medical Center", type: "Hospital", address: "Metropolitan Avenue, Malugay, Makati, 1209 Kalakhang Maynila" },
        { name: "Centuria Medical Makati", type: "Hospital", address: "Brgy, Century City Kalayaan Ave, cor Salamanca, Makati, Metro Manila" },
        { name: "St. Clare's Medical Center", type: "Hospital", address: "1838 Dian St, corner Boyle Street, Makati, 1235 Metro Manila" },
        { name: "Makati Life 24/7 OPD (Outpatient Department)", type: "Hospital", address: "2261 Metropolitan Ave, Makati, Metro Manila" },
        { name: "Mercury Drug", type: "Pharmacy", address: "H28H+3QH, Makati Ave, Makati, Metro Manila" },
        { name: "Apotheca Integrative Pharmacy", type: "Pharmacy", address: "GF, Eurovilla 4, 853 Antonio Arnaiz Ave, Legazpi Village, Makati, 1229 Metro Manila" },
        { name: "Planet Drugstore", type: "Pharmacy", address: "RCBC Plaza Tower 2, Mezzanine, 6819 Ayala Ave, Makati, 0727 Metro Manila" },
        { name: "Med Express MMC", type: "Pharmacy", address: "2 Amorsolo Street, Legazpi Village, Makati, 1229 Kalakhang Maynila" },
        { name: "Marcelo'S Pharmacy And General Merchandise", type: "Pharmacy", address: "314 J. P. Rizal St, Makati, Metro Manila" }
    ],
    "Manila": [
        { name: "De Ocampo Memorial Medical Center", type: "Hospital", address: "2921 Nagtahan St, Santa Mesa, Manila, 1016 Metro Manila" },
        { name: "Mary Chiles General Hospital", type: "Hospital", address: "667 Dalupan St, Sampaloc, Manila, 1008 Metro Manila" },
        { name: "Manila Doctors Hospital", type: "Hospital", address: "HXHP+469, Taft Ave, Ermita, Manila, 1000 Metro Manila" },
        { name: "Philippine General Hospital", type: "Hospital", address: "University of the Philippines, Taft Ave, Ermita, Manila, 1000 Metro Manila" },
        { name: "Ospital ng Maynila Medical Center", type: "Hospital", address: "HXJQ+9R8, Roxas Blvd, Malate, Manila, 1004 Metro Manila" },
        { name: "Watsons Pharmacy", type: "Pharmacy", address: "Outlet 1 SM City Manila, Concepcion corner Arroceros and San Marcelino Street, Ermita, Manila, 1000 Metro Manila" },
        { name: "Mercury Drug Bambang", type: "Pharmacy", address: "1580-82 Bambang St, Santa Cruz, Manila, 1003 Metro Manila" },
        { name: "Alfamedix Pharmacy - San Miguel", type: "Pharmacy", address: "1646 Jose P Laurel St, San Miguel, Manila, 1008 Metro Manila" },
        { name: "St. Lazarus Drug", type: "Pharmacy", address: "JX7M+P46, Santa Cruz, Manila, Metro Manila" },
        { name: "Mercury Drug Earnshaw", type: "Pharmacy", address: "1008 Earnshaw St, Sampaloc, Manila, 1008 Metro Manila" }
		],
	"Caloocan": [
        { name: "Caloocan City Medical Center", type: "Hospital", address: "831 A. Mabini St, Caloocan, Metro Manila" },
        { name: "San Lorenzo Ruiz Women's Hospital", type: "Hospital", address: "General Luna Street, Caloocan, Metro Manila" },
        { name: "Dr. Jose N. Rodriguez Memorial Hospital", type: "Hospital", address: "Research Institute for Tropical Medicine Compound, Tala, Caloocan, Metro Manila" },
        { name: "Our Lady of Grace Hospital", type: "Hospital", address: "12th Avenue, Caloocan, Metro Manila" },
        { name: "MCU Hospital", type: "Hospital", address: "Caloocan, Metro Manila" },
        { name: "Mercury Drug - Monumento", type: "Pharmacy", address: "Rizal Avenue, Monumento, Caloocan, Metro Manila" },
        { name: "South Star Drug - Zabarte", type: "Pharmacy", address: "Zabarte Road, Camarin, Caloocan, Metro Manila" },
        { name: "The Generics Pharmacy - Caloocan", type: "Pharmacy", address: "#87 Samson Rd, Sangandaan, Caloocan, Metro Manila" },
        { name: "St. Joseph Drugstore", type: "Pharmacy", address: "7th Avenue, Caloocan, Metro Manila" },
        { name: "Watsons Pharmacy - Victory Mall", type: "Pharmacy", address: "Rizal Avenue Extension, Caloocan, Metro Manila" }
    ],
    "San Juan": [
        { name: "San Juan Medical Center", type: "Hospital", address: "71 N. Domingo, San Juan, 1500 Metro Manila" },
		{ name: "Cardinal Santos Medical Center", type: "Hospital", address: "10 Wilson, Greenhills West, San Juan, 1502 Metro Manila" },
		{ name: "Healthhub Diagnostic Medical San Juan Greenhills", type: "Hospital", address: "J23W+845, Ortigas Ave, Antipolo, Metro Manila" },
		{ name: "Maligaya Diagnostic Center", type: "Hospital", address: "159 F. Manalo, San Juan, 1500 Metro Manila" },
        { name: "DRMed Clinic and Laboratory", type: "Hospital", address: "4th Floor Northridge Plaza, Congressional Avenue, Quezon City, 1100 Metro Manila" },
		{ name: "Jeanypeas", type: "Pharmacy", address: "150 F. Manalo, San Juan, 1500 Metro Manila" },
		{ name: "Herbs & Nature PureGold - San Juan", type: "Pharmacy", address: "J24F+577, Ground Level Puregold, N. Domingo Street, Corner F. Blumentritt, Philippines, San Juan, 1500 Metro Manila" },
		{ name: "TGP The Generics Pharmacy", type: "Pharmacy", address: "2 G.B Santos, San Juan, 1500 Metro Manila" },
		{ name: "Planet Drug Store Corporation", type: "Pharmacy", address: "Unit B Em Building, 226 N. Domingo Corazon, San Juan, 1500 Metro Manila" },
        { name: "Macev’s Drugstore and General Merchandise", type: "Pharmacy", address: "Rd 7, San Juan, Metro Manila" }
    ],
	"Navotas": [
        { name: "Navotas City Hospital", type: "Hospital", address: "MW6W+5C4, M. Naval St, Navotas, Metro Manila" },
		{ name: "SmartMed Pharmacy", type: "Pharmacy", address: "56 Gov. A. Pascual St, Navotas, 1489 Metro Manila" },
		{ name: "Mercury Drug - Navotas Poblacion (153)", type: "Pharmacy", address: "MW5W+5W8, M. Naval St, Navotas, 1485 Metro Manila" },
		{ name: "Watson's Navotas Branch", type: "Pharmacy", address: "MW5W+FRV, Navotas, Metro Manila" },
		{ name: "Mercury Drug Corporation.- Navotas Agora center Branch (1009)", type: "Pharmacy", address: "JXV3+MJX, N Bay Blvd, Navotas, Metro Manila" },
        { name: "Mercury Drug Bacog, Navotas", type: "Pharmacy", address: "1218 M. Naval St, Navotas, Metro Manila" }
    ],
    "Mandaluyong": [
        { name: "VRP Medical Center", type: "Hospital", address: "163 Epifanio de los Santos Ave, Mandaluyong, 1501 Metro Manila" },
        { name: "Mandaluyong City Medical Center", type: "Hospital", address: "F. Martinez Ave, Mandaluyong, 1550 Metro Manila" },
		{ name: "ACE Medical Center Mandaluyong", type: "Hospital", address: "145 Haig, Mandaluyong, 1550 Metro Manila" },
		{ name: "Pasig City General Hospital", type: "Hospital", address: "Pasig City, Metro Manila" },
		{ name: "Mauway Health Center", type: "Hospital", address: "Dr Jose Fabella Rd, Mandaluyong, Metro Manila" },
		{ name: "MMR Pharmacy", type: "Pharmacy", address: "Brgy, Blk. 19B F. Martinez Ave, Mandaluyong, 1552 Metro Manila" },
		{ name: "Mercury Drug Mandaluyong City Kalentong General", type: "Pharmacy", address: "3180 New Panaderos, Mandaluyong, 1550 Metro Manila" },
		{ name: "Mercury Drug Libertad Mandaluyong", type: "Pharmacy", address: "8 Domingo M. Guevara, Mandaluyong, Metro Manila" },
		{ name: "Med Global Pharmacy-Mandaluyong Branch (Mauway)", type: "Pharmacy", address: "58 Correctional Rd, Mandaluyong, 1550 Metro Manila" },
        { name: "Mercury Drug Maysilo Mandaluyong", type: "Pharmacy", address: "H2GM+J77, San Francisco, Mandaluyong, 1550 Metro Manila" }
    ],
    "Malabon": [
        { name: "Malabon Hospital and Medical Center", type: "Hospital", address: "264 Gov. Pascual Ave, Malabon, Metro Manila" },
        { name: "Ospital ng Malabon", type: "Hospital", address: "MX42+W65, Malabon, Metro Manila" },
		{ name: "San Lorenzo Ruiz General Hospital", type: "Hospital", address: "MXV4+MG9, o. reyes St, Malabon, 1478 Metro Manila" },
		{ name: "Tito Oreta Memorial Hospital", type: "Hospital", address: "MX42+W75, F. Sevilla Blvd, Malabon, Metro Manila" },
		{ name: "Hospital", type: "Hospital", address: "116 Marcelo H. Del Pilar St, Malabon, 1478 Metro Manila" },
		{ name: "St.Pierre Pharmacy", type: "Pharmacy", address: "137, P. Aquino Ave, Malabon, 1470 Metro Manila" },
		{ name: "TRIPLE R PHARMACY", type: "Pharmacy", address: "363 Gen. Luna St, Malabon, 1470 Metro Manila" },
		{ name: "Double 88 Pharmacy", type: "Pharmacy", address: "Block 49B, Lot 5 Pampano St, Malabon, 1472 Metro Manila" },
		{ name: "Alianna's Pharmacy", type: "Pharmacy", address: "Block 223, Lot 10 1st St, Malabon, 1472 Metro Manila" },
        { name: "Tumagan Pharmacy", type: "Pharmacy", address: "309 Gov. Pascual Ave, Malabon, 1470 Metro Manila" }
    ],
	"Las Pinas": [
        { name: "Las Pinas Doctors Hospital", type: "Hospital", address: "#8009 CAA Rd, Pulanglupa II, Las Pinas, Metro Manila" },
		{ name: "Las Pinas General Hospital and Satellite Trauma Center", type: "Hospital", address: "Bernabe Compound, Diego Cera Ave, Pulanglupa I, Las Pinas, Metro Manila" },
		{ name: "Unihealth Las Pinas Christ the King Medical Center", type: "Hospital", address: "130 Alabang–Zapote Rd, Pamplona 1, Las Pinas, 1740 Metro Manila" },
		{ name: "Las Pinas City Medical Center", type: "Hospital", address: "1314 Marcos Alvarez Ave, Las Pinas, 1747 Metro Manila" },
        { name: "Perpetual Help Medical Center - Las Pinas Hospital", type: "Hospital", address: "Alabang–Zapote Rd, Las Pinas, 1740 Metro Manila" },
		{ name: "Eshelle Pharmacy", type: "Pharmacy", address: "Blk 16 Lot 1 Bernabe Compound, Las Pinas, 1742 Metro Manila" },
		{ name: "The Generics Pharmacy", type: "Pharmacy", address: "FX9J+593, Naga Rd, 1, Las Pinas, 1742 Metro Manila" },
		{ name: "Hlbl Pharmacy", type: "Pharmacy", address: "1339 Fruto Santos Ave, Las Pinas, 1742 Metro Manila" },
		{ name: "4Eas Pharmacy", type: "Pharmacy", address: "F252+4J5, Malunggay St, Las Pinas, Metro Manila" },
        { name: "T. Celis Pharmacy", type: "Pharmacy", address: "22 Gov.A Licaros, Talon 2, Las Pinas, 1747 Metro Manila" }
    ],
        };

        const searchForm = document.getElementById('searchForm');
        const locationInput = document.getElementById('locationInput');
        const resultsContainer = document.getElementById('resultsContainer');

        // Function to perform search and display results
        function performSearch() {
            const location = locationInput.value.trim().toLowerCase();
            
            // Clear previous results
            resultsContainer.innerHTML = '';

            // Check if the input is empty, then clear results and return
            if (location === '') {
                return;
            }

            const normalizedData = Object.keys(hospitalPharmacyData).reduce((acc, key) => {
                acc[key.toLowerCase()] = hospitalPharmacyData[key];
                return acc;
            }, {});

            const results = [];
            for (const key in normalizedData) {
                normalizedData[key].forEach(item => {
                    if (item.name.toLowerCase().includes(location) || item.address.toLowerCase().includes(location)) {
                        results.push(item);
                    }
                });
            }

            if (results.length > 0) {
                results.forEach(item => {
                    resultsContainer.innerHTML += `<div class="result-card"><h4>${item.name}</h4><p>${item.type}: ${item.address}</p></div>`;
                });
            } else {
                resultsContainer.innerHTML = `<p>No results found for "${location.charAt(0).toUpperCase() + location.slice(1)}".</p>`;
            }
        }

        // Event listener for the search form submit
        searchForm.addEventListener('submit', function(event) {
            event.preventDefault();
            performSearch();
        });

        // Event listener to clear results when the input field is cleared
        locationInput.addEventListener('input', function() {
            if (locationInput.value.trim() === '') {
                resultsContainer.innerHTML = '';
            }
        });
    </script>
    <script type="importmap">
        {
            "imports": {
                "@google/generative-ai": "https://esm.run/@google/generative-ai"
            }
        }
    </script>
    <script>
        // JavaScript for auto-sliding feature
        let currentIndex = 0; // Start with the first slide
        const slides = document.querySelector('.slides');
        const totalSlides = document.querySelectorAll('.slide').length;

        function showNextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides; // Move to the next slide
            const offset = -currentIndex * 100; // Calculate the offset for sliding
            slides.style.transform = `translateX(${offset}%)`; // Apply the offset
        }

        // Change slide every 5 seconds
        setInterval(showNextSlide, 5000);
        
        function toggleMedicines(category) {
            const medicineList = document.getElementById(category);
            if (medicineList.style.display === "none" || medicineList.style.display === "") {
                medicineList.style.display = "block"; // Show the medicine list
            } else {
                medicineList.style.display = "none"; // Hide the medicine list
            }
        }
    </script>
    <script type="module">
        import { GoogleGenerativeAI } from "@google/generative-ai";
        const API_KEY = "AIzaSyCpOVj3nxihduy1rjIRwKDB0unDeKHyFOY";

        const chatbotToggler = document.querySelector(".chatbot-toggler");
        const closeBtn = document.querySelector(".close-btn");
        const chatbox = document.querySelector(".chatbox");
        const chatInput = document.querySelector(".chat-input textarea");
        const sendChatBtn = document.querySelector(".chat-input span");

        let userMessage = null;
        const inputInitHeight = chatInput.scrollHeight;

        async function runModel(prompt) {
            const genAI = new GoogleGenerativeAI(API_KEY);
            const model = await genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
            const result = await model.generateContent(prompt);
            const response = await result.response.text();
            return response;
        }

        const createChatLi = (message, className) => {
            const chatLi = document.createElement("li");
            chatLi.classList.add("chat", `${className}`);
            let chatContent = className === "outgoing" ? `<p></p>` : `<span class="material-symbols-outlined">smart_toy</span><p></p>`;
            chatLi.innerHTML = chatContent;
            chatLi.querySelector("p").textContent = message;
            return chatLi;
        }

        const generateResponse = async (chatElement, userMessage) => {
            const messageElement = chatElement.querySelector("p");
            try {
                const answer = await runModel(userMessage);
                messageElement.textContent = answer;
            } catch (error) {
                console.error("Failed to generate response:", error);
                messageElement.textContent = "Sorry, something went wrong.";
            }

            chatbox.scrollTo(0, chatbox.scrollHeight);
        }

        const handleChat = () => {
            userMessage = chatInput.value.trim();
            if (!userMessage) return;

            // Clear the input textarea and set its height to default
            chatInput.value = "";
            chatInput.style.height = `${inputInitHeight}px`;

            // Append the user's message to the chatbox
            chatbox.appendChild(createChatLi(userMessage, "outgoing"));
            chatbox.scrollTo(0, chatbox.scrollHeight);

            setTimeout(() => {
                // Display "Thinking..." message while waiting for the response
                const incomingChatLi = createChatLi("Thinking...", "incoming");
                chatbox.appendChild(incomingChatLi);
                chatbox.scrollTo(0, chatbox.scrollHeight);
                generateResponse(incomingChatLi, userMessage);
            }, 600);
        }

        chatInput.addEventListener("input", () => {
            // Adjust the height of the input textarea based on its content
            chatInput.style.height = `${inputInitHeight}px`;
            chatInput.style.height = `${chatInput.scrollHeight}px`;
        });

        chatInput.addEventListener("keydown", (e) => {
            // If Enter key is pressed without Shift key and the window width is greater than 800px, handle the chat
            if (e.key === "Enter" && !e.shiftKey && window.innerWidth > 800) {
                e.preventDefault();
                handleChat();
            }
        });

        sendChatBtn.addEventListener("click", handleChat);
        closeBtn.addEventListener("click", () => document.body.classList.remove("show-chatbot"));
        chatbotToggler.addEventListener("click", () => document.body.classList.toggle("show-chatbot"));
    </script>
</body>
</html>